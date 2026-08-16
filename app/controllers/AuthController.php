<?php

class AuthController extends Controller
{
    public function login(): void
    {
        if (Auth::check()) {
            $this->redirect('/admin');
        }

        if ($this->isPost()) {
            if (!$this->verifyCsrf()) {
                http_response_code(419);
                echo View::render('pages/404');
                return;
            }
            $username = $this->input('username');
            $password = $this->input('password');

            if (Auth::attempt($username, $password)) {
                $this->redirect('/admin');
            }

            flash_set('error', 'Username atau password salah.');
        }

        $this->view('admin/login', [
            'layout' => 'admin',
            'title'  => 'Login Admin',
            'error'  => flash_get('error'),
        ]);
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect('/admin/login');
    }
}
