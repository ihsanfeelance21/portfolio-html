<?php

class Validator
{
    private array $errors = [];

    public function validate(array $data, array $rules): bool
    {
        $this->errors = [];
        foreach ($rules as $field => $fieldRules) {
            $value = $data[$field] ?? '';
            foreach ($fieldRules as $rule) {
                if ($rule === 'required' && trim((string) $value) === '') {
                    $this->errors[$field][] = 'wajib diisi.';
                } elseif ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field][] = 'format email tidak valid.';
                } elseif (str_starts_with($rule, 'min:') && mb_strlen((string) $value) < (int) substr($rule, 4)) {
                    $this->errors[$field][] = 'minimal ' . substr($rule, 4) . ' karakter.';
                } elseif (str_starts_with($rule, 'max:') && mb_strlen((string) $value) > (int) substr($rule, 4)) {
                    $this->errors[$field][] = 'maksimal ' . substr($rule, 4) . ' karakter.';
                }
            }
        }
        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
