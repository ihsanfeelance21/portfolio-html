<?php

class CertificatesController extends Controller
{
    public function index(): void
    {
        $this->view('pages/certificates/index', [
            'layout'       => 'public',
            'title'        => 'Sertifikat Pelatihan',
            'certificates' => (new CertificateModel())->published(),
        ]);
    }
}
