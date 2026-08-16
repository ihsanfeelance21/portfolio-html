<?php

// Ringkas: METHOD => [ 'pattern' => [Controller, method] ]
// Pola bisa berisi regex capture group, contoh: '/proyek/([0-9]+)'

return [
    'GET' => [
        '/'                        => ['HomeController', 'index'],
        '/proyek'                  => ['ProjectsController', 'index'],
        '/proyek/([a-z0-9-]+)'     => ['ProjectsController', 'show'],
        '/sertifikat'              => ['CertificatesController', 'index'],
        '/kontak'                  => ['ContactController', 'index'],

        '/admin/login'             => ['AuthController', 'login'],
        '/admin/logout'            => ['AuthController', 'logout'],
        '/admin'                   => ['DashboardController', 'index'],
        '/admin/proyek'            => ['ProjectsAdminController', 'index'],
        '/admin/proyek/create'     => ['ProjectsAdminController', 'create'],
        '/admin/proyek/edit/([0-9]+)' => ['ProjectsAdminController', 'edit'],
        '/admin/sertifikat'        => ['CertificatesAdminController', 'index'],
        '/admin/sertifikat/create' => ['CertificatesAdminController', 'create'],
        '/admin/sertifikat/edit/([0-9]+)' => ['CertificatesAdminController', 'edit'],
        '/admin/skill'             => ['SkillsAdminController', 'index'],
        '/admin/skill/create'      => ['SkillsAdminController', 'create'],
        '/admin/skill/edit/([0-9]+)' => ['SkillsAdminController', 'edit'],
        '/admin/settings'          => ['SettingsController', 'index'],
        '/admin/pesan'             => ['MessagesController', 'index'],
    ],

    'POST' => [
        '/kontak'                  => ['ContactController', 'submit'],
        '/admin/login'             => ['AuthController', 'login'],

        '/admin/proyek/store'      => ['ProjectsAdminController', 'store'],
        '/admin/proyek/update'     => ['ProjectsAdminController', 'update'],
        '/admin/proyek/delete'     => ['ProjectsAdminController', 'delete'],
        '/admin/sertifikat/store'  => ['CertificatesAdminController', 'store'],
        '/admin/sertifikat/update' => ['CertificatesAdminController', 'update'],
        '/admin/sertifikat/delete' => ['CertificatesAdminController', 'delete'],
        '/admin/skill/store'       => ['SkillsAdminController', 'store'],
        '/admin/skill/update'      => ['SkillsAdminController', 'update'],
        '/admin/skill/delete'      => ['SkillsAdminController', 'delete'],
        '/admin/settings/update'   => ['SettingsController', 'update'],
        '/admin/settings/password' => ['SettingsController', 'password'],
        '/admin/settings/roadmap'  => ['SettingsController', 'roadmap'],
        '/admin/pesan/read'        => ['MessagesController', 'markRead'],
        '/admin/pesan/delete'      => ['MessagesController', 'delete'],
    ],
];
