<?php

if (!function_exists('env')) {
    function env(string $key, mixed $default = null, ?string $type = null): mixed
    {
        $value = $_ENV[$key] ?? getenv($key) ?? $default;

        if ($value === false || $value === null) {
            return $default;
        }

        // infer type from default if not explicitly set
        if ($type === null && $default !== null) {
            $type = gettype($default);
        }

        return match ($type) {
            'integer' => (int) $value,
            'int' => (int) $value,
            'boolean' => filter_var($value, FILTER_VALIDATE_BOOL),
            'bool' => filter_var($value, FILTER_VALIDATE_BOOL),
            'double' => (float) $value,
            'float' => (float) $value,
            'string', null => (string) $value,
            default => $value,
        };
    }
}
