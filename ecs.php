<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Phpdoc\PhpdocToCommentFixer;
use PhpCsFixer\Fixer\Whitespace\LineEndingFixer;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/config',
        __DIR__ . '/views',
        __DIR__ . '/public',
        __DIR__ . '/src',
    ])
    ->withSkip([
        LineLengthFixer::class,
        PhpdocToCommentFixer::class,
        __DIR__ . '/composer',
        LineEndingFixer::class,
    ])
    ->withPreparedSets(
        psr12: true,
        common: true,
        symplify: true,
        cleanCode: true
     )
     ;
