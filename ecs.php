<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/config',
        __DIR__ . '/views',
        __DIR__ . '/public',
        __DIR__ . '/src',
    ])

    // add a single rule
    ->withRules([
        NoUnusedImportsFixer::class,
        SingleQuoteFixer::class
    ])

    // add sets - group of rules
    ->withPreparedSets(
        arrays: true,
        comments: true,
        docblocks: true,
        spaces: true,
        namespaces: true,
        cleanCode: true,
     )
     
     ;
