<?php

namespace App\Controllers;

use App\Models\NotificationTemplateModel;
use App\Validation\NotificationTemplateValidation;

class NotificationTemplateController extends BaseController
{
    protected NotificationTemplateModel $notificationTemplateModel;

    public function __construct()
    {
        $this->notificationTemplateModel =
            new NotificationTemplateModel();
    }

    public function index()
    {
        $templates = $this->notificationTemplateModel
            ->orderBy('recipient_type', 'ASC')
            ->orderBy('notification_type', 'ASC')
            ->findAll();

        return view('admin/notification-template/index', [
            'title'     => 'Template Pesan',
            'pageTitle' => 'Template Pesan',
            'templates' => $templates,
        ]);
    }

    public function create(): string
    {
        return view('admin/notification-template/edit', [
            'title'     => 'Tambah Template Pesan',
            'pageTitle' => 'Tambah Template Pesan',
            'template'  => null,
            'errors'    => [],
            'formData'  => [],
        ]);
    }

    public function edit(int $id): string
    {
        $template = $this->notificationTemplateModel->find($id);

        if ($template === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Template pesan tidak ditemukan.'
            );
        }

        return view('admin/notification-template/edit', [
            'title'     => 'Edit Template Pesan',
            'pageTitle' => 'Edit Template Pesan',
            'template'  => $template,
            'errors'    => [],
            'formData'  => [],
        ]);
    }

    public function store()
    {

        $rules = NotificationTemplateValidation::rules();

        if (! $this->validate($rules)) {

            if ($this->request->isAJAX()) {

                return view(
                    'admin/notification-template/edit',
                    [
                        'title'     => 'Tambah Template Pesan',
                        'pageTitle' => 'Tambah Template Pesan',
                        'template'  => null,
                        'errors'    => $this->validator->getErrors(),
                        'formData'  => $this->request->getPost(),
                    ]
                );
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->notificationTemplateModel->insert([
            'recipient_type' =>
            $this->request->getPost('recipient_type'),

            'notification_type' =>
            $this->request->getPost('notification_type'),

            'template_message' =>
            trim(
                (string) $this->request->getPost('template_message')
            ),

            'active' =>
            (int) $this->request->getPost('active'),
        ]);

        $templateId = $this->notificationTemplateModel->getInsertID();

        $this->logActivity(
            'create',
            'notification_template',
            (int) $templateId,
            'Menambahkan template pesan "' .
                $this->request->getPost('notification_type') .
                '" untuk penerima "' .
                $this->request->getPost('recipient_type') .
                '".'
        );


        return redirect()
            ->to(base_url('admin/bukutamu-template-pesan'))
            ->with(
                'success',
                'Template pesan berhasil ditambahkan.'
            );
    }

    public function update(int $id)
    {
        $template = $this->notificationTemplateModel->find($id);

        if ($template === null) {

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(404)
                    ->setBody('Template pesan tidak ditemukan.');
            }

            return redirect()
                ->to(base_url('admin/bukutamu-template-pesan'))
                ->with(
                    'error',
                    'Template pesan tidak ditemukan.'
                );
        }

        $rules = NotificationTemplateValidation::rules(true);

        if (! $this->validate($rules)) {

            if ($this->request->isAJAX()) {

                return view(
                    'admin/notification-template/edit',
                    [
                        'title'     => 'Edit Template Pesan',
                        'pageTitle' => 'Edit Template Pesan',
                        'template'  => $template,
                        'errors'    => $this->validator->getErrors(),
                        'formData'  => $this->request->getPost(),
                    ]
                );
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->notificationTemplateModel->update(
            $id,
            [
                'recipient_type' =>
                $this->request->getPost('recipient_type'),

                'notification_type' =>
                $this->request->getPost('notification_type'),

                'template_message' =>
                trim(
                    (string) $this->request
                        ->getPost('template_message')
                ),

                'active' =>
                (int) $this->request->getPost('active'),
            ]
        );

        $this->logActivity(
            'update',
            'notification_template',
            $id,
            'Memperbarui template pesan "' .
                $this->request->getPost('notification_type') .
                '" untuk penerima "' .
                $this->request->getPost('recipient_type') .
                '".'
        );

        return redirect()
            ->to(base_url('admin/bukutamu-template-pesan'))
            ->with(
                'success',
                'Template pesan berhasil diperbarui.'
            );
    }
}
