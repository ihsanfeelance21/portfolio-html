<?php

class ProjectModel extends Model
{
    protected string $table = 'projects';

    public function published(string $orderBy = 'is_featured DESC, sort_order ASC, id DESC'): array
    {
        return $this->query(
            "SELECT * FROM projects WHERE is_active = 1 ORDER BY {$orderBy}"
        );
    }

    public function featured(int $limit = 4): array
    {
        return $this->query(
            "SELECT * FROM projects WHERE is_active = 1 AND is_featured = 1
             ORDER BY sort_order ASC, id DESC LIMIT " . (int) $limit
        );
    }

    public function findBySlug(string $slug): ?array
    {
        $rows = $this->query('SELECT * FROM projects WHERE slug = ? AND is_active = 1', [$slug]);
        return $rows[0] ?? null;
    }
}
