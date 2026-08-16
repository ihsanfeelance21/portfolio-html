<?php

class SkillsAdminController extends Controller
{
    private SkillModel $model;

    public function __construct()
    {
        $this->model = new SkillModel();
    }

    public function index(): void
    {
        $this->view('admin/skills/list', [
            'layout' => 'admin',
            'title'  => 'Skills',
            'active' => 'skills',
            'skills' => $this->model->all('group_name ASC, sort_order ASC, id ASC'),
            'flash'  => flash_get('flash'),
        ]);
    }

    public function create(): void
    {
        $this->view('admin/skills/form', [
            'layout' => 'admin',
            'title'  => 'Tambah Skill',
            'active' => 'skills',
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
        if ($errors) {
            old_set($data);
            flash_set('errors', $errors);
            $this->redirect('/admin/skill/create');
        }

        $this->model->create($data);
        flash_set('flash', 'Skill berhasil ditambahkan.');
        $this->redirect('/admin/skill');
    }

    public function edit(int $id): void
    {
        $item = $this->model->find($id);
        if (!$item) {
            $this->redirect('/admin/skill');
        }
        $this->view('admin/skills/form', [
            'layout' => 'admin',
            'title'  => 'Edit Skill',
            'active' => 'skills',
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
        $data = $this->collect();
        $errors = $this->validate($data);
        if ($errors) {
            old_set($data);
            flash_set('errors', $errors);
            $this->redirect('/admin/skill/edit/' . $id);
        }

        $this->model->update($id, $data);
        flash_set('flash', 'Skill berhasil diperbarui.');
        $this->redirect('/admin/skill');
    }

    public function delete(): void
    {
        if (!$this->verifyCsrf()) {
            http_response_code(419);
            echo View::render('pages/404');
            return;
        }
        $id = $this->int('id');
        $this->model->delete($id);
        flash_set('flash', 'Skill berhasil dihapus.');
        $this->redirect('/admin/skill');
    }

    private function collect(): array
    {
        return [
            'group_name' => $this->input('group_name'),
            'name'       => $this->input('name'),
            'is_active'  => $this->int('is_active'),
            'sort_order' => $this->int('sort_order'),
        ];
    }

    private function validate(array $data): array
    {
        $v = new Validator();
        if (!$v->validate($data, [
            'group_name' => ['required', 'min:2', 'max:60'],
            'name'       => ['required', 'min:1', 'max:60'],
        ])) {
            return $v->errors();
        }
        return [];
    }
}
