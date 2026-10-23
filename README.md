# HipsterJazzbo PHP Style

Shared PHP-CS-Fixer rules for my PHP projects.

The package owns the common rules. Each project still owns its own `Finder`, so repositories can decide which directories should be formatted.

## Install

Once the package is available on Packagist:

```bash
composer require --dev hipsterjazzbo/php-style:^0.1
```

Before the first Packagist release is indexed, Composer can install directly from GitHub by adding this repository as a VCS source and requiring `dev-main`.

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

## Mago (one-tool alternative)

If your project uses Mago, use the standalone [`mago.toml`](mago.toml)
rules as the shared style reference. **You do not need PHP-CS-Fixer.**

Mago 1.25+ can inherit a local config with `extends`:

```toml
extends = "path/to/shared/mago.toml"

php-version = "8.5.0"

[source]
paths = ["app", "tests"]
```

The file must exist locally. You can copy this small profile into a project,
or place it at an inherited path through your normal dependency management.
Do not install this package as a Composer dependency **just for Mago**: its
Composer requirements still include PHP-CS-Fixer for existing consumers.

The translation keeps PER-CS, import ordering, a blank line before `return`,
and the linter rules for strict types, unnecessary imports and fully-qualified
global classes. Some PHP-CS-Fixer options have no exact Mago equivalent:
statement-specific blank lines, automatic import replacement, inserting strict
declarations, and automatic expansion or semantic checking of PHPDoc. Mago is
the only formatter for projects choosing this profile; enforce useful PHPDoc
through the project's documentation policy and checks.

Existing PHP-CS-Fixer consumers can continue using `PhpStyle::config()`.
Do not run both formatters over the same project.

## What this does not enforce

PHP-CS-Fixer can format declaration docblocks, but it does not prove that every declaration has a useful human-readable description.

Repositories that require descriptive PHPDoc should keep a separate parser/AST-based documentation check for that policy.
