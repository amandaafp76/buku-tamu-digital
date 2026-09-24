<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/admin/bukutamu-dashboard');
        }

        return view('auth/login');
    }

    public function authenticate()
    {
        $rules = [
            'username' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required'    => 'Email wajib diisi.',
                    'valid_email' => 'Email harus berupa alamat email yang valid.',
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password wajib diisi.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        $userModel = new UserModel();

        $user = $userModel
            ->where('username', $username)
            ->where('active', true)
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

        return redirect()->to('/admin/bukutamu-dashboard');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/bukutamu-masuk');
    }
}
