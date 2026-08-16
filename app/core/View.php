<?php

class View
{
    public static function render(string $view, array $data = []): string
    {
        $layout = $data['layout'] ?? 'public';
        unset($data['layout']);
        extract($data, EXTR_SKIP);

        ob_start();
        require VIEWS_DIR . '/' . $view . '.php';
        $content = ob_get_clean();

        ob_start();
        require VIEWS_DIR . '/layouts/' . $layout . '.php';
        return ob_get_clean();
    }
}
