<?php

class DashboardController extends Controller
{
    public function index(): void
    {
        $messageModel = new MessageModel();
        $this->view('admin/dashboard', [
            'layout'   => 'admin',
            'title'    => 'Dashboard',
            'active'   => 'dashboard',
            'stats'    => [
                'projects'    => (new ProjectModel())->count(),
                'certificates' => (new CertificateModel())->count(),
                'skills'      => (new SkillModel())->count(),
                'messages'    => $messageModel->count(),
                'unread'      => $messageModel->unreadCount(),
            ],
        ]);
    }
}
