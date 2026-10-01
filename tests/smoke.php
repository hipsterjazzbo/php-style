<?php

declare(strict_types=1);

use HipsterJazzbo\PhpStyle\PhpStyle;
use PhpCsFixer\Finder;

require_once __DIR__ . '/../vendor/autoload.php';

$rules = PhpStyle::rules();

$required = [
    '@PER-CS3x0',
    'declare_strict_types',
    'blank_line_before_statement',
    'phpdoc_line_span',
    'fully_qualified_strict_types',
    'global_namespace_import',
    'no_unused_imports',
    'ordered_imports',
    'single_import_per_statement',
    'single_line_after_imports',
];

foreach ($required as $rule) {
    if (!array_key_exists($rule, $rules)) {
        throw new RuntimeException(sprintf('Missing shared rule: %s', $rule));
    }
}

$config = PhpStyle::config(Finder::create()->in(__DIR__));

if ($config->getRules() !== $rules) {
    throw new RuntimeException('Config rules do not match the shared rules.');
}
