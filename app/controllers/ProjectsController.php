<?php

class ProjectsController extends Controller
{
    public function index(): void
    {
        $this->view('pages/projects/index', [
            'layout'   => 'public',
            'title'    => 'Proyek & Dokumentasi',
            'projects' => (new ProjectModel())->published(),
        ]);
    }

    public function show(string $slug): void
    {
        $project = (new ProjectModel())->findBySlug($slug);
        if (!$project) {
            http_response_code(404);
            echo View::render('pages/404');
            return;
        }
        $this->view('pages/projects/show', [
            'layout'  => 'public',
            'title'   => $project['title'],
            'project' => $project,
        ]);
    }
}
