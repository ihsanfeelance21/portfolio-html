<?php

class MessagesController extends Controller
{
    private MessageModel $model;

    public function __construct()
    {
        $this->model = new MessageModel();
    }

    public function index(): void
    {
        $this->view('admin/messages/list', [
            'layout'   => 'admin',
            'title'    => 'Pesan Masuk',
            'active'   => 'messages',
            'messages' => $this->model->all('is_read ASC, id DESC'),
            'flash'    => flash_get('flash'),
        ]);
    }

    public function markRead(): void
    {
        if (!$this->verifyCsrf()) {
            http_response_code(419);
            echo View::render('pages/404');
            return;
        }
        $id = $this->int('id');
        $this->model->markRead($id);
        $this->redirect('/admin/pesan');
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
        flash_set('flash', 'Pesan dihapus.');
        $this->redirect('/admin/pesan');
    }
}
