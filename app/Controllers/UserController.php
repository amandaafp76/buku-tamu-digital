<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Validation\UserValidation;

class UserController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index(): string
    {
        $search = trim((string) $this->request->getGet('search'));
        $role = (string) $this->request->getGet('role');
        $status = (string) $this->request->getGet('status');

        $query = $this->userModel
            ->select(
                'users.id, users.username, users.role, users.active, users.created_at, users.updated_at'
            );

        if ($search !== '') {
            $query->like('users.username', $search);
        }

        if ($role !== '') {
            $query->where('users.role', $role);
        }

        if ($status !== '') {
            $query->where(
                'users.active',
                $status === 'aktif' ? 1 : 0
            );
        }

        $users = $query
            ->orderBy('users.username', 'ASC')
            ->findAll();

        return view('admin/users/index', [
            'title' => 'Pengguna',
            'pageTitle' => 'Pengguna',
            'users' => $users,
            'search' => $search,
            'role' => $role,
            'status' => $status,
        ]);
    }

    public function create(): string
    {
        return view('admin/users/tambah', [
            'title' => 'Tambah Pengguna',
            'pageTitle' => 'Tambah Pengguna',
        ]);
    }

    public function store()
    {
        $rules = UserValidation::rules(true);

        if (! $this->validate($rules)) {
            return view('admin/users/tambah', [
                'title' => 'Tambah Pengguna',
                'pageTitle' => 'Tambah Pengguna',
                'errors' => $this->validator->getErrors(),
                'formData' => $this->request->getPost(),
            ]);
        }

        $username = strtolower(
            trim((string) $this->request->getPost('username'))
        );

        $existingUser = $this->userModel
            ->where('username', $username)
            ->first();

        if ($existingUser !== null) {
            return view('admin/users/tambah', [
                'title' => 'Tambah Pengguna',
                'pageTitle' => 'Tambah Pengguna',
                'errors' => [
                    'username' => 'Username sudah digunakan.',
                ],
                'formData' => $this->request->getPost(),
            ]);
        }

        $password = (string) $this->request->getPost('password');

        $this->userModel->insert([
            'username' => $username,
            'password_hash' => password_hash(
                $password,
                PASSWORD_DEFAULT
            ),
            'role' => (string) $this->request->getPost('role'),
            'active' => (int) $this->request->getPost('active'),
        ]);

        return redirect()
            ->to(base_url('admin/bukutamu-pengguna'))
            ->with(
                'success',
                'Pengguna "' . $username . '" berhasil ditambahkan.'
            );
    }

    public function edit(int $id): string
    {
        $user = $this->userModel->find($id);

        if ($user === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data pengguna tidak ditemukan.'
            );
        }

        return view('admin/users/edit', [
            'title' => 'Edit Pengguna',
            'pageTitle' => 'Edit Pengguna',
            'user' => $user,
        ]);
    }

    public function update(int $id)
    {
        $user = $this->userModel->find($id);

        if ($user === null) {
            return redirect()
                ->to(base_url('admin/bukutamu-pengguna'))
                ->with(
                    'error',
                    'Data pengguna tidak ditemukan.'
                );
        }

        $password = (string) $this->request->getPost('password');
        $passwordConfirm = (string) $this->request->getPost('password_confirm');

        $rules = UserValidation::rules(false);

        if ($password !== '' || $passwordConfirm !== '') {
            $rules = array_merge(
                $rules,
                UserValidation::passwordRules()
            );
        }

        if (! $this->validate($rules)) {
            return view('admin/users/edit', [
                'title' => 'Edit Pengguna',
                'pageTitle' => 'Edit Pengguna',
                'user' => $user,
                'errors' => $this->validator->getErrors(),
                'formData' => $this->request->getPost(),
            ]);
        }

        $username = strtolower(
            trim((string) $this->request->getPost('username'))
        );

        $newRole = (string) $this->request->getPost('role');
        $active = (int) $this->request->getPost('active');

        $existingUser = $this->userModel
            ->where('username', $username)
            ->where('id !=', $id)
            ->first();

        if ($existingUser !== null) {
            return view('admin/users/edit', [
                'title' => 'Edit Pengguna',
                'pageTitle' => 'Edit Pengguna',
                'user' => $user,
                'errors' => [
                    'username' => 'Username sudah digunakan.',
                ],
                'formData' => $this->request->getPost(),
            ]);
        }

        $currentUserId = (int) session()->get('user_id');

        if ($currentUserId === $id && $newRole !== 'administrator') {
            return view('admin/users/edit', [
                'title' => 'Edit Pengguna',
                'pageTitle' => 'Edit Pengguna',
                'user' => $user,
                'errors' => [
                    'role' => 'Role akun yang sedang digunakan tidak dapat diubah menjadi Petugas.',
                ],
                'formData' => $this->request->getPost(),
            ]);
        }

        if ($currentUserId === $id && $active === 0) {
            return view('admin/users/edit', [
                'title' => 'Edit Pengguna',
                'pageTitle' => 'Edit Pengguna',
                'user' => $user,
                'errors' => [
                    'active' => 'Akun yang sedang digunakan tidak dapat dinonaktifkan.',
                ],
                'formData' => $this->request->getPost(),
            ]);
        }

        if (
            $user['role'] === 'administrator' &&
            $user['active'] == 1 &&
            $newRole !== 'administrator'
        ) {
            if ($this->countActiveAdministrators() <= 1) {
                return view('admin/users/edit', [
                    'title' => 'Edit Pengguna',
                    'pageTitle' => 'Edit Pengguna',
                    'user' => $user,
                    'errors' => [
                        'role' => 'Minimal harus ada satu administrator aktif.',
                    ],
                    'formData' => $this->request->getPost(),
                ]);
            }
        }

        if (
            $user['role'] === 'administrator' &&
            $user['active'] == 1 &&
            $newRole === 'administrator' &&
            $active === 0
        ) {
            if ($this->countActiveAdministrators() <= 1) {
                return view('admin/users/edit', [
                    'title' => 'Edit Pengguna',
                    'pageTitle' => 'Edit Pengguna',
                    'user' => $user,
                    'errors' => [
                        'active' => 'Minimal harus ada satu administrator aktif.',
                    ],
                    'formData' => $this->request->getPost(),
                ]);
            }
        }

        $data = [
            'username' => $username,
            'role' => $newRole,
            'active' => $active,
        ];

        if ($password !== '') {
            $data['password_hash'] = password_hash(
                $password,
                PASSWORD_DEFAULT
            );
        }

        $this->userModel->update($id, $data);

        if ($currentUserId === $id) {
            session()->set([
                'username' => $username,
                'role' => $newRole,
            ]);
        }

        return redirect()
            ->to(base_url('admin/bukutamu-pengguna'))
            ->with(
                'success',
                'Data pengguna "' . $username . '" berhasil diperbarui.'
            );
    }

    public function resetPassword(int $id): string
    {
        $user = $this->userModel->find($id);

        if ($user === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data pengguna tidak ditemukan.'
            );
        }

        return view('admin/users/reset_password', [
            'title' => 'Reset Password',
            'pageTitle' => 'Reset Password',
            'user' => $user,
        ]);
    }

    public function updatePassword(int $id)
    {
        $user = $this->userModel->find($id);

        if ($user === null) {
            return redirect()
                ->to(base_url('admin/bukutamu-pengguna'))
                ->with(
                    'error',
                    'Data pengguna tidak ditemukan.'
                );
        }

        $rules = UserValidation::passwordRules();

        if (! $this->validate($rules)) {
            return view('admin/users/reset_password', [
                'title' => 'Reset Password',
                'pageTitle' => 'Reset Password',
                'user' => $user,
                'errors' => $this->validator->getErrors(),
                'formData' => $this->request->getPost(),
            ]);
        }

        $password = (string) $this->request->getPost('password');

        $this->userModel->update($id, [
            'password_hash' => password_hash(
                $password,
                PASSWORD_DEFAULT
            ),
        ]);

        return redirect()
            ->to(base_url('admin/bukutamu-pengguna'))
            ->with(
                'success',
                'Password pengguna "' . $user['username'] . '" berhasil direset.'
            );
    }

    public function toggleStatus(int $id)
    {
        $user = $this->userModel->find($id);

        if ($user === null) {
            return redirect()
                ->to(base_url('admin/bukutamu-pengguna'))
                ->with(
                    'error',
                    'Data pengguna tidak ditemukan.'
                );
        }

        $currentUserId = (int) session()->get('user_id');

        if ($currentUserId === $id) {
            return redirect()
                ->to(base_url('admin/bukutamu-pengguna'))
                ->with(
                    'error',
                    'Akun yang sedang digunakan tidak dapat dinonaktifkan.'
                );
        }

        $newStatus = (int) $user['active'] === 1 ? 0 : 1;

        if (
            $user['role'] === 'administrator' &&
            (int) $user['active'] === 1 &&
            $newStatus === 0 &&
            $this->countActiveAdministrators() <= 1
        ) {
            return redirect()
                ->to(base_url('admin/bukutamu-pengguna'))
                ->with(
                    'error',
                    'Minimal harus ada satu administrator aktif.'
                );
        }

        $this->userModel->update($id, [
            'active' => $newStatus,
        ]);

        return redirect()
            ->to(base_url('admin/bukutamu-pengguna'))
            ->with(
                'success',
                $newStatus === 1
                    ? 'Pengguna "' . $user['username'] . '" berhasil diaktifkan.'
                    : 'Pengguna "' . $user['username'] . '" berhasil dinonaktifkan.'
            );
    }

    public function confirmDelete(int $id): string
    {
        $user = $this->userModel->find($id);

        if ($user === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data pengguna tidak ditemukan.'
            );
        }

        return view('admin/users/hapus', [
            'title' => 'Hapus Pengguna',
            'pageTitle' => 'Hapus Pengguna',
            'user' => $user,
        ]);
    }

    public function delete(int $id)
    {
        $user = $this->userModel->find($id);

        if ($user === null) {
            return redirect()
                ->to(base_url('admin/bukutamu-pengguna'))
                ->with(
                    'error',
                    'Data pengguna tidak ditemukan.'
                );
        }

        $currentUserId = (int) session()->get('user_id');

        if ($currentUserId === $id) {
            return redirect()
                ->to(base_url('admin/bukutamu-pengguna'))
                ->with(
                    'error',
                    'Akun yang sedang digunakan tidak dapat dihapus.'
                );
        }

        if (
            $user['role'] === 'administrator' &&
            (int) $user['active'] === 1 &&
            $this->countActiveAdministrators() <= 1
        ) {
            return redirect()
                ->to(base_url('admin/bukutamu-pengguna'))
                ->with(
                    'error',
                    'Administrator aktif terakhir tidak dapat dihapus.'
                );
        }

        $this->userModel->delete($id);

        return redirect()
            ->to(base_url('admin/bukutamu-pengguna'))
            ->with(
                'success',
                'Pengguna "' . $user['username'] . '" berhasil dihapus.'
            );
    }

    protected function countActiveAdministrators(): int
    {
        return (int) $this->userModel
            ->where('role', 'administrator')
            ->where('active', 1)
            ->countAllResults();
    }
}
