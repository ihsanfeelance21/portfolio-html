<?php

class SkillModel extends Model
{
    protected string $table = 'skills';

    public function grouped(): array
    {
        $rows = $this->query(
            'SELECT * FROM skills WHERE is_active = 1 ORDER BY sort_order ASC, id ASC'
        );
        $groups = [];
        foreach ($rows as $row) {
            $groups[$row['group_name']][] = $row['name'];
        }
        return $groups;
    }
}
