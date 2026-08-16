<?php

class SettingsController extends Controller
{
    private SettingModel $model;

    public function __construct()
    {
        $this->model = new SettingModel();
    }

    public function index(): void
    {
        $defaults = [
            'site_name'  => 'Muhamad Ihsan Kurniawan',
            'site_title' => 'Muhamad Ihsan Kurniawan — Backend & Infrastructure Engineer',
            'tagline'    => 'Career Switcher → Backend & Infrastructure Engineer',
            'hero_sub'   => '',
            'about_text' => '',
            'location'   => 'Banyuwangi, Jawa Timur',
            'education'  => 'Mahasiswa Informatika @ SiberMu',
            'email'      => 'ihsanfreelance21@gmail.com',
            'github'     => 'ihsanfeelance21',
            'instagram'  => 'kakrantau',
        ];

        $this->view('admin/settings/index', [
            'layout'   => 'admin',
            'title'    => 'Pengaturan',
            'active'   => 'settings',
            'settings' => array_merge($defaults, $this->model->all()),
            'roadmap'  => (new RoadmapItemModel())->ordered(),
            'flash'    => flash_get('flash'),
            'errors'   => flash_get('errors'),
            'pwd_error' => flash_get('pwd_error'),
            'pwd_ok'   => flash_get('pwd_ok'),
        ]);
    }

    public function update(): void
    {
        if (!$this->verifyCsrf()) {
            http_response_code(419);
            echo View::render('pages/404');
            return;
        }

        $keys = [
            'site_name', 'site_title', 'tagline', 'hero_sub',
            'about_text', 'location', 'education', 'email', 'github', 'instagram',
        ];
        foreach ($keys as $key) {
            $this->model->set($key, $this->input($key));
        }

        flash_set('flash', 'Pengaturan berhasil disimpan.');
        $this->redirect('/admin/settings');
    }

    public function password(): void
    {
        if (!$this->verifyCsrf()) {
            http_response_code(419);
            echo View::render('pages/404');
            return;
        }

        $current = $this->input('current_password');
        $new     = $this->input('new_password');
        $confirm = $this->input('confirm_password');

        $user = (new UserModel())->find(Auth::id());

        if (!$user || !password_verify($current, $user['password_hash'])) {
            flash_set('pwd_error', 'Password saat ini salah.');
            $this->redirect('/admin/settings');
        }
        if (mb_strlen($new) < 8) {
            flash_set('pwd_error', 'Password baru minimal 8 karakter.');
            $this->redirect('/admin/settings');
        }
        if ($new !== $confirm) {
            flash_set('pwd_error', 'Konfirmasi password tidak cocok.');
            $this->redirect('/admin/settings');
        }

        (new UserModel())->updatePassword($user['id'], password_hash($new, PASSWORD_DEFAULT));
        flash_set('pwd_ok', 'Password berhasil diubah.');
        $this->redirect('/admin/settings');
    }

    public function roadmap(): void
    {
        if (!$this->verifyCsrf()) {
            http_response_code(419);
            echo View::render('pages/404');
            return;
        }

        $rm = new RoadmapItemModel();

        $newTitle = $this->input('new_title');
        $toggleId = $this->int('toggle_id');
        $deleteId = $this->int('delete_id');

        if ($newTitle !== '') {
            $rm->create(['title' => $newTitle, 'is_done' => 0, 'sort_order' => $rm->count() + 1]);
            flash_set('flash', 'Item roadmap ditambahkan.');
        } elseif ($toggleId > 0) {
            $item = $rm->find($toggleId);
            if ($item) {
                $rm->update($toggleId, ['is_done' => (int) !((int) $item['is_done'])]);
            }
            flash_set('flash', 'Status roadmap diperbarui.');
        } elseif ($deleteId > 0) {
            $rm->delete($deleteId);
            flash_set('flash', 'Item roadmap dihapus.');
        }

        $this->redirect('/admin/settings');
    }
}
