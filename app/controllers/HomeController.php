<?php

class HomeController extends Controller
{
    public function index(): void
    {
        $settings = (new SettingModel())->all();
        $defaults = [
            'site_name'  => 'Muhamad Ihsan Kurniawan',
            'site_title' => 'Muhamad Ihsan Kurniawan — Backend & Infrastructure Engineer',
            'tagline'    => 'Career Switcher → Backend & Infrastructure Engineer',
            'hero_sub'   => 'Berpengalaman di IT Operations & Network Infrastructure untuk institusi pendidikan. Sedang membangun ekosistem infrastruktur pribadi berbasis Ubuntu Server, sambil bertransisi menjadi Backend & Infrastructure Engineer.',
            'about_text' => "Halo, saya Muhamad Ihsan Kurniawan — sedang menempuh pendidikan Informatika di SiberMu. Perjalanan saya dimulai dari dunia IT Operations & Network Infrastructure, mendukung kebutuhan teknologi institusi pendidikan.\n\nPengalaman itu membuka mata saya: dunia teknologi tidak hanya soal kode, tapi juga infrastruktur yang menopangnya. Karena itu saya memutuskan switch career — membangun ulang fondasi dari Linux, Networking, dan Backend Development, lalu mendokumentasikan semuanya secara terbuka lewat Project Ascend.\n\nPrinsip saya sederhana: build, deploy, document, improve — setiap proyek dikerjakan, di-deploy, dan terus diperbaiki di homelab saya sendiri.",
            'location'   => 'Banyuwangi, Jawa Timur',
            'education'  => 'Mahasiswa Informatika @ SiberMu',
            'email'      => 'ihsanfreelance21@gmail.com',
            'github'     => 'ihsanfeelance21',
            'instagram'  => 'kakrantau',
        ];
        $settings = array_merge($defaults, $settings);

        $this->view('pages/home', [
            'layout'            => 'public',
            'title'             => $settings['site_title'],
            'settings'          => $settings,
            'skills'            => (new SkillModel())->grouped(),
            'projects'          => (new ProjectModel())->featured(6),
            'allProjects'       => (new ProjectModel())->published(),
            'certificates'      => (new CertificateModel())->published(),
            'roadmap'           => (new RoadmapItemModel())->ordered(),
            'roadmapProgress'   => (new RoadmapItemModel())->progress(),
            'errors'            => flash_get('errors'),
            'success'           => flash_get('success'),
        ]);
    }

    public function notFound(): void
    {
        http_response_code(404);
        echo View::render('pages/404');
    }
}
