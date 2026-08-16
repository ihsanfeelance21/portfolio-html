<?php

class ProjectsAdminController extends Controller
{
    private ProjectModel $model;

    public function __construct()
    {
        $this->model = new ProjectModel();
    }

    public function index(): void
    {
        $this->view('admin/projects/list', [
            'layout'   => 'admin',
            'title'    => 'Proyek',
            'active'   => 'projects',
            'projects' => $this->model->all('sort_order ASC, id DESC'),
            'flash'    => flash_get('flash'),
        ]);
    }

    public function create(): void
    {
        $this->view('admin/projects/form', [
            'layout' => 'admin',
            'title'  => 'Tambah Proyek',
            'active' => 'projects',
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
            $this->redirect('/admin/proyek/create');
        }

        $this->model->create([
            'title'       => $data['title'],
            'slug'        => slugify($data['title']),
            'description' => $data['description'],
            'tech_stack'  => json_encode(array_values(array_filter(array_map('trim', explode(',', $data['tech_stack']))))),
            'github_url'  => $data['github_url'] ?: null,
            'live_url'    => $data['live_url'] ?: null,
            'image'       => $image['path'],
            'is_featured' => $data['is_featured'],
            'is_active'   => $data['is_active'],
            'sort_order'  => $data['sort_order'],
        ]);

        flash_set('flash', 'Proyek berhasil ditambahkan.');
        $this->redirect('/admin/proyek');
    }

    public function edit(int $id): void
    {
        $item = $this->model->find($id);
        if (!$item) {
            $this->redirect('/admin/proyek');
        }
        $item['tech_stack'] = json_decode($item['tech_stack'] ?: '[]', true) ?: [];

        $this->view('admin/projects/form', [
            'layout' => 'admin',
            'title'  => 'Edit Proyek',
            'active' => 'projects',
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
            $this->redirect('/admin/proyek');
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
            $this->redirect('/admin/proyek/edit/' . $id);
        }

        $fields = [
            'title'       => $data['title'],
            'slug'        => slugify($data['title']),
            'description' => $data['description'],
            'tech_stack'  => json_encode(array_values(array_filter(array_map('trim', explode(',', $data['tech_stack']))))),
            'github_url'  => $data['github_url'] ?: null,
            'live_url'    => $data['live_url'] ?: null,
            'is_featured' => $data['is_featured'],
            'is_active'   => $data['is_active'],
            'sort_order'  => $data['sort_order'],
        ];
        if ($image['ok']) {
            Upload::remove($item['image']);
            $fields['image'] = $image['path'];
        }

        $this->model->update($id, $fields);

        flash_set('flash', 'Proyek berhasil diperbarui.');
        $this->redirect('/admin/proyek');
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
            flash_set('flash', 'Proyek berhasil dihapus.');
        }
        $this->redirect('/admin/proyek');
    }

    private function collect(): array
    {
        return [
            'title'       => $this->input('title'),
            'description' => $this->input('description'),
            'tech_stack'  => $this->input('tech_stack'),
            'github_url'  => $this->input('github_url'),
            'live_url'    => $this->input('live_url'),
            'is_featured' => $this->int('is_featured'),
            'is_active'   => $this->int('is_active'),
            'sort_order'  => $this->int('sort_order'),
        ];
    }

    private function validate(array $data): array
    {
        $v = new Validator();
        if (!$v->validate($data, [
            'title'       => ['required', 'min:2', 'max:150'],
            'description' => ['required', 'min:10', 'max:3000'],
        ])) {
            return $v->errors();
        }
        return [];
    }
}
