<?php

declare(strict_types=1);

use HipsterJazzbo\PhpStyle\PhpStyle;
use PhpCsFixer\Finder;

require_once __DIR__ . '/vendor/autoload.php';

return PhpStyle::config(
    Finder::create()->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]),
);
