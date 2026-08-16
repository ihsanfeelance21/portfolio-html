<?php

class RoadmapItemModel extends Model
{
    protected string $table = 'roadmap_items';

    public function ordered(): array
    {
        return $this->query('SELECT * FROM roadmap_items ORDER BY sort_order ASC, id ASC');
    }

    public function progress(): int
    {
        $items = $this->query('SELECT is_done FROM roadmap_items');
        if (empty($items)) {
            return 0;
        }
        $done = count(array_filter($items, fn ($i) => (int) $i['is_done'] === 1));
        return (int) round(($done / count($items)) * 100);
    }
}
