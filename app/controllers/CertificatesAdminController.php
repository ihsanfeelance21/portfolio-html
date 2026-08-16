<?php

class CertificatesAdminController extends Controller
{
    private CertificateModel $model;

    public function __construct()
    {
        $this->model = new CertificateModel();
    }

    public function index(): void
    {
        $this->view('admin/certificates/list', [
            'layout'       => 'admin',
            'title'        => 'Sertifikat',
            'active'       => 'certificates',
            'certificates' => $this->model->all('sort_order ASC, id DESC'),
            'flash'        => flash_get('flash'),
        ]);
    }

    public function create(): void
    {
        $this->view('admin/certificates/form', [
            'layout' => 'admin',
            'title'  => 'Tambah Sertifikat',
            'active' => 'certificates',
            'item'   => null,
            'errors' => flash_get('errors'),
        ]);
    }

    public function store(): void
    {
        if (!$this->verifyCsrf()) {
            http_response_code(419);
            echo View::render('pages/404');
            return;
        }

        $data = $this->collect();
        $errors = $this->validate($data);

        $image = Upload::image($_FILES['image'] ?? []);
        if (!$image['ok'] && $image['error']) {
            $errors['image'] = [$image['error']];
        }

        if ($errors) {
            old_set($data);
            flash_set('errors', $errors);
            $this->redirect('/admin/sertifikat/create');
        }

        $this->model->create([
            'title'         => $data['title'],
            'issuer'        => $data['issuer'],
            'year'          => $data['year'],
            'credential_url' => $data['credential_url'] ?: null,
            'image'         => $image['path'],
            'is_active'     => $data['is_active'],
            'sort_order'    => $data['sort_order'],
        ]);

        flash_set('flash', 'Sertifikat berhasil ditambahkan.');
        $this->redirect('/admin/sertifikat');
    }

    public function edit(int $id): void
    {
        $item = $this->model->find($id);
        if (!$item) {
            $this->redirect('/admin/sertifikat');
        }
        $this->view('admin/certificates/form', [
            'layout' => 'admin',
            'title'  => 'Edit Sertifikat',
            'active' => 'certificates',
            'item'   => $item,
            'errors' => flash_get('errors'),
        ]);
    }

    public function update(): void
    {
        if (!$this->verifyCsrf()) {
            http_response_code(419);
            echo View::render('pages/404');
            return;
        }

        $id = $this->int('id');
        $item = $this->model->find($id);
        if (!$item) {
            $this->redirect('/admin/sertifikat');
        }

        $data = $this->collect();
        $errors = $this->validate($data);

        $image = Upload::image($_FILES['image'] ?? []);
        if (!$image['ok'] && $image['error']) {
            $errors['image'] = [$image['error']];
        }

        if ($errors) {
            old_set($data);
            flash_set('errors', $errors);
            $this->redirect('/admin/sertifikat/edit/' . $id);
        }

        $fields = [
            'title'          => $data['title'],
            'issuer'         => $data['issuer'],
            'year'           => $data['year'],
            'credential_url' => $data['credential_url'] ?: null,
            'is_active'      => $data['is_active'],
            'sort_order'     => $data['sort_order'],
        ];
        if ($image['ok']) {
            Upload::remove($item['image']);
            $fields['image'] = $image['path'];
        }

        $this->model->update($id, $fields);

        flash_set('flash', 'Sertifikat berhasil diperbarui.');
        $this->redirect('/admin/sertifikat');
    }

    public function delete(): void
    {
        if (!$this->verifyCsrf()) {
            http_response_code(419);
            echo View::render('pages/404');
            return;
        }
        $id = $this->int('id');
        $item = $this->model->find($id);
        if ($item) {
            Upload::remove($item['image']);
            $this->model->delete($id);
            flash_set('flash', 'Sertifikat berhasil dihapus.');
        }
        $this->redirect('/admin/sertifikat');
    }

    private function collect(): array
    {
        return [
            'title'          => $this->input('title'),
            'issuer'         => $this->input('issuer'),
            'year'           => $this->input('year'),
            'credential_url' => $this->input('credential_url'),
            'is_active'      => $this->int('is_active'),
            'sort_order'     => $this->int('sort_order'),
        ];
    }

    private function validate(array $data): array
    {
        $v = new Validator();
        if (!$v->validate($data, [
            'title'  => ['required', 'min:2', 'max:150'],
            'issuer' => ['required', 'min:2', 'max:150'],
            'year'   => ['required', 'max:10'],
        ])) {
            return $v->errors();
        }
        return [];
    }
}
