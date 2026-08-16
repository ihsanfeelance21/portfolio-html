<?php

class CertificateModel extends Model
{
    protected string $table = 'certificates';

    public function published(string $orderBy = 'sort_order ASC, id DESC'): array
    {
        return $this->query(
            "SELECT * FROM certificates WHERE is_active = 1 ORDER BY {$orderBy}"
        );
    }
}
