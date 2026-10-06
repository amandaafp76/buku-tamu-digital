<?php

namespace App\Controllers;

use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Models\VisitPurposeModel;
use App\Models\SettingModel;
use App\Models\GuestModel;
use App\Models\VisitModel;
use App\Validation\GuestValidation;

class GuestController extends BaseController
{
    public function index(): string
    {
        return view('guest/kiosk');
    }

    public function register(): string
    {
        $sessionData = session()->get('bukutamu_kiosk') ?? [];

        return view('guest/register', [
            'guest' => $sessionData,
        ]);
    }

    public function storeIdentity()
    {
        if (! $this->validate(GuestValidation::identityRules())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_lengkap'    => trim((string) $this->request->getPost('nama_lengkap')),
            'nomor_hp'        => trim((string) $this->request->getPost('nomor_hp')),
            'alamat'          => trim((string) $this->request->getPost('alamat')),
            'asal_instansi'   => trim((string) $this->request->getPost('asal_instansi')),
            'jenis_identitas' => trim((string) $this->request->getPost('jenis_identitas')),
            'nomor_identitas' => trim((string) $this->request->getPost('nomor_identitas')),
            'group_size'      => (int) $this->request->getPost('group_size'),
        ];

        session()->set('bukutamu_kiosk', $data);

        return redirect()->to(
            site_url('bukutamu-kiosk/tujuan')
        );
    }

    public function purpose()
    {
        $guest = session()->get('bukutamu_kiosk');

        if (empty($guest)) {
            return redirect()->to(
                site_url('bukutamu-kiosk/registrasi')
            );
        }

        $departmentModel = new DepartmentModel();
        $purposeModel    = new VisitPurposeModel();

        return view('guest/purpose', [
            'guest' => $guest,

            'departments' => $departmentModel
                ->where('active', 1)
                ->orderBy('name', 'ASC')
                ->findAll(),

            'purposes' => $purposeModel
                ->where('active', 1)
                ->orderBy('purpose_name', 'ASC')
                ->findAll(),
        ]);
    }

    public function employeesByDepartment(int $departmentId)
    {
        $departmentModel = new DepartmentModel();
        $employeeModel   = new EmployeeModel();

        $department = $departmentModel
            ->select('id')
            ->where('id', $departmentId)
            ->where('active', 1)
            ->first();

        if (! $department) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'message' => 'Departemen tidak ditemukan.'
                ]);
        }

        $employees = $employeeModel
            ->select('id, employee_name')
            ->where('department_id', $departmentId)
            ->where('active', 1)
            ->orderBy('employee_name', 'ASC')
            ->findAll();

        return $this->response
            ->setStatusCode(200)
            ->setJSON($employees);
    }

    public function storePurpose()
    {
        $guest = session()->get('bukutamu_kiosk');

        if (empty($guest)) {
            return redirect()->to(
                site_url('bukutamu-kiosk/registrasi')
            );
        }

        if (! $this->validate(GuestValidation::purposeRules())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $departmentId = (int) $this->request->getPost('department_id');
        $employeeId   = (int) $this->request->getPost('employee_id');
        $purposeId    = (int) $this->request->getPost('purpose_id');

        $departmentModel = new DepartmentModel();
        $employeeModel   = new EmployeeModel();
        $purposeModel    = new VisitPurposeModel();

        $department = $departmentModel
            ->where('id', $departmentId)
            ->where('active', 1)
            ->first();

        if (! $department) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    'department_id' => 'Bagian / Departemen yang dipilih tidak valid.'
                ]);
        }

        $employee = $employeeModel
            ->where('id', $employeeId)
            ->where('department_id', $departmentId)
            ->where('active', 1)
            ->first();

        if (! $employee) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    'employee_id' => 'Pegawai yang dipilih tidak sesuai dengan departemen.'
                ]);
        }

        $purpose = $purposeModel
            ->where('id', $purposeId)
            ->where('active', 1)
            ->first();

        if (! $purpose) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    'purpose_id' => 'Tujuan kunjungan yang dipilih tidak valid.'
                ]);
        }

        $purposeData = [
            'department_id' => $departmentId,
            'employee_id'   => $employeeId,
            'purpose_id'    => $purposeId,
        ];

        session()->set(
            'bukutamu_kiosk',
            array_merge($guest, $purposeData)
        );

        return redirect()->to(
            site_url('bukutamu-kiosk/foto')
        );
    }

    public function photo()
    {
        $guest = session()->get('bukutamu_kiosk');

        if (empty($guest)) {
            return redirect()->to(
                site_url('bukutamu-kiosk/registrasi')
            );
        }

        if (
            empty($guest['department_id']) ||
            empty($guest['employee_id']) ||
            empty($guest['purpose_id'])
        ) {
            return redirect()->to(
                site_url('bukutamu-kiosk/tujuan')
            );
        }

        $institutionModel = new \App\Models\InstitutionModel();
        $settingModel     = new SettingModel();

        $institution = $institutionModel
            ->where('active', true)
            ->first();

        $setting = $institution
            ? $settingModel
            ->where('institution_id', $institution['id'])
            ->first()
            : null;

        $requirePhoto = $setting
            ? (int) $setting['require_photo']
            : 1;

        $photoSize = $setting && !empty($setting['photo_size'])
            ? (int) $setting['photo_size']
            : 500;

        return view('guest/photo', [
            'guest'        => $guest,
            'requirePhoto' => $requirePhoto,
            'photoSize'    => $photoSize,
        ]);
    }

    public function storePhoto()
    {
        $guest = session()->get('bukutamu_kiosk');

        if (empty($guest)) {
            return redirect()->to(
                site_url('bukutamu-kiosk/registrasi')
            );
        }

        if (
            empty($guest['department_id']) ||
            empty($guest['employee_id']) ||
            empty($guest['purpose_id'])
        ) {
            return redirect()->to(
                site_url('bukutamu-kiosk/tujuan')
            );
        }

        $institutionModel = new \App\Models\InstitutionModel();
        $settingModel     = new SettingModel();

        $institution = $institutionModel
            ->where('active', true)
            ->first();

        $setting = $institution
            ? $settingModel
            ->where('institution_id', $institution['id'])
            ->first()
            : null;

        $requirePhoto = $setting
            ? (int) $setting['require_photo']
            : 1;

        $photoSize = $setting && !empty($setting['photo_size'])
            ? (int) $setting['photo_size']
            : 500;

        $photo = $this->request->getFile('photo');

        if (
            (!$photo || !$photo->isValid()) &&
            $requirePhoto === 0
        ) {
            return redirect()->to(
                site_url('bukutamu-kiosk/persetujuan')
            );
        }

        if (!$photo || !$photo->isValid()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    'photo' => 'Foto wajib diambil atau dipilih.'
                ]);
        }

        $maxPhotoSize = $photoSize * 1024;

        if ($photo->getSize() > $maxPhotoSize) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    'photo' => 'Ukuran foto maksimal ' . $photoSize . ' KB.'
                ]);
        }

        $allowedMimeTypes = [
            'image/jpeg',
            'image/png',
            'image/webp',
        ];

        if (!in_array($photo->getMimeType(), $allowedMimeTypes, true)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    'photo' => 'Format foto tidak didukung.'
                ]);
        }

        $uploadPath = FCPATH . 'uploads/guest_photos';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $fileName = $photo->getRandomName();

        $photo->move(
            $uploadPath,
            $fileName
        );

        session()->set(
            'bukutamu_kiosk',
            array_merge(
                $guest,
                [
                    'photo_path' => 'uploads/guest_photos/' . $fileName,
                ]
            )
        );

        return redirect()->to(
            site_url('bukutamu-kiosk/persetujuan')
        );
    }

    public function consent()
    {
        $guest = session()->get('bukutamu_kiosk');

        if (empty($guest)) {
            return redirect()->to(
                site_url('bukutamu-kiosk/registrasi')
            );
        }

        if (
            empty($guest['department_id']) ||
            empty($guest['employee_id']) ||
            empty($guest['purpose_id'])
        ) {
            return redirect()->to(
                site_url('bukutamu-kiosk/tujuan')
            );
        }

        $institutionModel = new \App\Models\InstitutionModel();
        $settingModel     = new SettingModel();

        $institution = $institutionModel
            ->where('active', true)
            ->first();

        $setting = $institution
            ? $settingModel
            ->where('institution_id', $institution['id'])
            ->first()
            : null;

        $requirePhoto = $setting
            ? (int) $setting['require_photo']
            : 1;

        if (
            $requirePhoto === 1 &&
            empty($guest['photo_path'])
        ) {
            return redirect()->to(
                site_url('bukutamu-kiosk/foto')
            );
        }

        $departmentModel = new DepartmentModel();
        $employeeModel   = new EmployeeModel();
        $purposeModel    = new VisitPurposeModel();

        $department = $departmentModel
            ->where('id', $guest['department_id'])
            ->where('active', 1)
            ->first();

        $employee = $employeeModel
            ->where('id', $guest['employee_id'])
            ->where('department_id', $guest['department_id'])
            ->where('active', 1)
            ->first();

        $purpose = $purposeModel
            ->where('id', $guest['purpose_id'])
            ->where('active', 1)
            ->first();

        return view('guest/consent', [
            'guest'      => $guest,
            'department' => $department,
            'employee'   => $employee,
            'purpose'    => $purpose,
        ]);
    }

    public function storeConsent()
    {
        $guest = session()->get('bukutamu_kiosk');

        if (empty($guest)) {
            return redirect()->to(
                site_url('bukutamu-kiosk/registrasi')
            );
        }

        if (
            empty($guest['department_id']) ||
            empty($guest['employee_id']) ||
            empty($guest['purpose_id'])
        ) {
            return redirect()->to(
                site_url('bukutamu-kiosk/tujuan')
            );
        }

        $signature = trim((string) $this->request->getPost('signature'));

        if ($signature === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    'signature' => 'Tanda tangan wajib diberikan.'
                ]);
        }

        $consent = $this->request->getPost('consent');

        if ($consent !== '1') {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    'consent' => 'Anda harus menyetujui penggunaan data.'
                ]);
        }

        $departmentModel = new DepartmentModel();
        $employeeModel   = new EmployeeModel();
        $purposeModel    = new VisitPurposeModel();

        $department = $departmentModel
            ->where('id', (int) $guest['department_id'])
            ->where('active', 1)
            ->first();

        if (! $department) {
            return redirect()
                ->to(site_url('bukutamu-kiosk/tujuan'))
                ->with('errors', [
                    'department_id' => 'Bagian / Departemen tidak ditemukan.'
                ]);
        }

        $employee = $employeeModel
            ->where('id', (int) $guest['employee_id'])
            ->where('department_id', (int) $guest['department_id'])
            ->where('active', 1)
            ->first();

        if (! $employee) {
            return redirect()
                ->to(site_url('bukutamu-kiosk/tujuan'))
                ->with('errors', [
                    'employee_id' => 'Pegawai yang dipilih tidak valid.'
                ]);
        }

        $purpose = $purposeModel
            ->where('id', (int) $guest['purpose_id'])
            ->where('active', 1)
            ->first();

        if (! $purpose) {
            return redirect()
                ->to(site_url('bukutamu-kiosk/tujuan'))
                ->with('errors', [
                    'purpose_id' => 'Tujuan kunjungan tidak valid.'
                ]);
        }

        $signaturePath = $this->saveSignature($signature);

        if (! $signaturePath) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    'signature' => 'Tanda tangan gagal disimpan.'
                ]);
        }

        $photoPath = $guest['photo_path'] ?? null;

        $visitCode = $this->generateVisitCode();
        $qrToken   = bin2hex(random_bytes(32));

        $guestModel = new GuestModel();

        $guestId = $guestModel->insert([
            'guest_name' => trim((string) ($guest['nama_lengkap'] ?? '')),
            'phone'      => trim((string) ($guest['nomor_hp'] ?? '')),
            'address'    => trim((string) ($guest['alamat'] ?? '')),
            'institution' => trim((string) ($guest['asal_instansi'] ?? '')),
        ]);

        if (! $guestId) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    'general' => 'Data pengunjung gagal disimpan.'
                ]);
        }

        $visitModel = new VisitModel();

        $visitId = $visitModel->insert([
            'visit_code'    => $visitCode,
            'guest_id'      => $guestId,
            'department_id' => (int) $guest['department_id'],
            'employee_id'   => (int) $guest['employee_id'],
            'purpose_id'    => (int) $guest['purpose_id'],
            'identity_type' => trim((string) ($guest['jenis_identitas'] ?? '')),
            'identity_no'   => trim((string) ($guest['nomor_identitas'] ?? '')),
            'group_size'    => (int) ($guest['group_size'] ?? 1),
            'arrival_time'  => date('Y-m-d H:i:s'),
            'status'        => 'Menunggu',
            'qr_token'      => $qrToken,
            'consent'       => true,
            'photo_path'    => $photoPath,
            'signature_path' => $signaturePath,
        ]);

        if (! $visitId) {
            $guestModel->delete($guestId);

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    'general' => 'Data kunjungan gagal disimpan.'
                ]);
        }

        session()->set('bukutamu_visit', [
            'visit_id'   => $visitId,
            'visit_code' => $visitCode,
            'qr_token'   => $qrToken,
        ]);

        session()->remove('bukutamu_kiosk');

        return redirect()->to(
            site_url('bukutamu-kiosk/konfirmasi')
        );
    }

    public function confirmation()
    {
        $visit = session()->get('bukutamu_visit');

        if (empty($visit)) {
            return redirect()->to(
                site_url('bukutamu-kiosk')
            );
        }

        $qrBuilder = new \Endroid\QrCode\Builder\Builder(
            writer: new \Endroid\QrCode\Writer\SvgWriter(),
            data: $visit['qr_token'],
            encoding: new \Endroid\QrCode\Encoding\Encoding('UTF-8'),
            errorCorrectionLevel: \Endroid\QrCode\ErrorCorrectionLevel::High,
            size: 280,
            margin: 10
        );

        $qrResult = $qrBuilder->build();

        return view('guest/confirmation', [
            'visit'  => $visit,
            'qrCode' => $qrResult->getDataUri(),
        ]);
    }

    private function saveSignature(string $signature): ?string
    {
        if (! str_contains($signature, 'base64,')) {
            return null;
        }

        [$header, $data] = explode('base64,', $signature, 2);

        $binary = base64_decode($data, true);

        if ($binary === false) {
            return null;
        }

        $uploadPath = FCPATH . 'uploads/guest_signatures';

        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $fileName = bin2hex(random_bytes(16)) . '.png';

        $filePath = $uploadPath . DIRECTORY_SEPARATOR . $fileName;

        if (file_put_contents($filePath, $binary) === false) {
            return null;
        }

        return 'uploads/guest_signatures/' . $fileName;
    }

    private function generateVisitCode(): string
    {
        do {
            $code = 'VIS-' . strtoupper(
                substr(bin2hex(random_bytes(5)), 0, 8)
            );

            $visitModel = new VisitModel();

            $exists = $visitModel
                ->where('visit_code', $code)
                ->first();
        } while ($exists);

        return $code;
    }
}
