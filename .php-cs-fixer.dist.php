<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

return (new Config())
    ->setRules(['@PSR12' => true])
    ->setRiskyAllowed(false)
    ->setCacheFile(__DIR__ . '/.cache/php-cs-fixer.cache')
    ->setFinder(Finder::create()->in([__DIR__ . '/src', __DIR__ . '/tests']));
