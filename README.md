# Chaos Dotenv

A lightweight `.env` loader for PHP projects.  
Provides simple environment variable management with support for defaults, type casting, and project root detection.  

---

## Installation

Require via Composer:

```
composer require chaoswd/dotenv
```

---

## Usage

Create a `.env` file in the root of your project:

```
APP_NAME=ChaosFramework
APP_ENV=development
APP_DEBUG=true
APP_TIMEZONE=America/Denver
```

Bootstrap it in your project:

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Chaos\Dotenv\Dotenv;

// Automatically loads variables from .env
new Dotenv();

// or use an alternate file location
// new Dotenv(__DIR__ . "/../config");

// Access values with the `env()` helper
echo env('APP_NAME');          // ChaosFramework
echo env('APP_DEBUG', false);  // true
```

---

## Features

- Load environment variables from a `.env` file
- Simple `env($key, $default = null, $type = null)` helper
- Supports defaults when a variable is missing
- Automatic trimming of quotes and whitespace
- Type casting support (`int`, `bool`, `string`)
- Compatible with PHP 8.2+

---

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for version history.

---

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).
