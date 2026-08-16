<?php

class MessageModel extends Model
{
    protected string $table = 'messages';

    public function markRead(int $id): int
    {
        return $this->execute('UPDATE messages SET is_read = 1 WHERE id = ?', [$id]);
    }

    public function unreadCount(): int
    {
        return $this->count('is_read = 0');
    }
}
