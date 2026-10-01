# HipsterJazzbo PHP Style

Shared PHP-CS-Fixer rules for my PHP projects.

The package owns the common rules. Each project still owns its own `Finder`, so repositories can decide which directories should be formatted.

## Install

Until this package is published on Packagist, add the GitHub repository to the consuming project's `composer.json`:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/hipsterjazzbo/php-style"
        }
    ],
    "require-dev": {
        "hipsterjazzbo/php-style": "dev-main"
    }
}
```

Then run:

```bash
composer update hipsterjazzbo/php-style
```

## Use

Create `.php-cs-fixer.dist.php` in the consuming project:

```php
<?php

declare(strict_types=1);

use HipsterJazzbo\PhpStyle\PhpStyle;
use PhpCsFixer\Finder;

$finder = Finder::create()->in([
    __DIR__ . '/src',
    __DIR__ . '/tests',
    __DIR__ . '/examples',
]);

return PhpStyle::config($finder);
```

## Project-specific overrides

A project can replace individual shared rules without copying the whole configuration:

```php
return PhpStyle::config($finder, [
    'blank_line_before_statement' => [
        'statements' => ['return', 'throw'],
    ],
]);
```

Or use `PhpStyle::rules()` directly when a repository needs to build a more unusual `Config`.

## What this does not enforce

PHP-CS-Fixer can format declaration docblocks, but it does not prove that every declaration has a useful human-readable description.

Repositories that require descriptive PHPDoc should keep a separate parser/AST-based documentation check for that policy.
