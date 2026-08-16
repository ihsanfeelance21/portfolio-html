<?php

class ContactController extends Controller
{
    public function index(): void
    {
        $this->redirect('/#kontak');
    }

    public function submit(): void
    {
        if (!$this->verifyCsrf()) {
            http_response_code(419);
            echo View::render('pages/404');
            return;
        }

        $data = [
            'name'    => $this->input('name'),
            'email'   => $this->input('email'),
            'subject' => $this->input('subject'),
            'message' => $this->input('message'),
        ];

        $validator = new Validator();
        $valid = $validator->validate($data, [
            'name'    => ['required', 'min:2', 'max:100'],
            'email'   => ['required', 'email', 'max:150'],
            'subject' => ['required', 'max:200'],
            'message' => ['required', 'min:10', 'max:3000'],
        ]);

        if (!$valid) {
            old_set($data);
            flash_set('errors', $validator->errors());
            $this->redirect('/#kontak');
        }

        (new MessageModel())->create([
            'name'    => $data['name'],
            'email'   => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
        ]);

        flash_set('success', 'Pesan terkirim! Terima kasih, saya akan segera membalas.');
        $this->redirect('/#kontak');
    }
}
