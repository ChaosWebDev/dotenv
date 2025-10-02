<?php

namespace Chaos\Dotenv;

class Dotenv
{
    protected array $variables = [];

    public function __construct(?string $path = null)
    {
        $root = $path ?? dirname(getcwd());
        $envFile = $root . DIRECTORY_SEPARATOR . '.env';

        if (file_exists($envFile)) {
            $this->load($envFile);
        }
    }

    protected function load(string $file): void
    {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            // skip comments
            if (str_starts_with(trim($line), '#')) {
                continue;
            }

            [$name, $value] = array_map('trim', explode('=', $line, 2));

            $this->variables[$name] = $value;

            // Put into superglobals
            $_ENV[$name] = $value;
            putenv("$name=$value");
        }
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->variables[$key] ?? $_ENV[$key] ?? getenv($key) ?? $default;
    }
}
