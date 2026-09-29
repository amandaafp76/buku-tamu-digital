<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Validation\AuthValidation;

class AuthController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (session()->get('logged_in')) {
            $role = session()->get('role');

            if ($role === 'administrator') {
                return redirect()->to(
                    site_url('admin/bukutamu-dashboard')
                );
            }

            if ($role === 'petugas') {
                return redirect()->to(
                    site_url('petugas/bukutamu-dashboard')
                );
            }

            session()->destroy();

            return redirect()
                ->to(site_url('bukutamu-masuk'))
                ->with('error', 'Role pengguna tidak valid.');
        }

        return view('auth/login');
    }

    public function authenticate()
    {
        $rules = AuthValidation::loginRules();

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $username = strtolower(
            trim((string) $this->request->getPost('username'))
        );
        $password = (string) $this->request->getPost('password');

        $user = $this->userModel
            ->where('username', $username)
            ->where('active', 1)
            ->first();

        if ($user === null || ! password_verify($password, $user['password_hash'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username atau password salah.');
        }

        session()->regenerate();

        session()->set([
            'user_id'  => $user['id'],
            'username' => $user['username'],
            'role'     => $user['role'],
            'logged_in' => true,
        ]);

        $this->logActivity(
            'login',
            'auth',
            (int) $user['id'],
            'Pengguna "' . $user['username'] . '" berhasil login.'
        );

        if ($user['role'] === 'administrator') {
            return redirect()->to(
                site_url('admin/bukutamu-dashboard')
            );
        }

        if ($user['role'] === 'petugas') {
            return redirect()->to(
                site_url('petugas/bukutamu-dashboard')
            );
        }

        session()->destroy();

        return redirect()
            ->to(site_url('bukutamu-masuk'))
            ->with('error', 'Role pengguna tidak valid.');
    }

    public function logout()
    {
        $userId = (int) session()->get('user_id');
        $username = (string) session()->get('username');

        if ($userId > 0) {
            $this->logActivity(
                'logout',
                'auth',
                $userId,
                'Pengguna "' . $username . '" berhasil logout.'
            );
        }

        session()->destroy();

        return redirect()->to('/bukutamu-masuk');
    }
}
