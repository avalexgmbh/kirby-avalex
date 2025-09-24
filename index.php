<?php

/**
 * Kirby plugin for using the avalex disclaimer service (https://avalex.de/)
 */

\Kirby\Filesystem\F::loadClasses([
    'Avalex\\Avalex\\Avalex'          => 'src/Avalex.php',
    'Avalex\\Avalex\\AvalexCache'     => 'src/AvalexCache.php',
    'Avalex\\Avalex\\AvalexException' => 'src/AvalexException.php',

    'AvalexPage'                      => 'models/avalex.php',
], __DIR__);

Kirby::plugin('avalex/avalex', [
    'options' => [
        // default language
        'language' => 'de',

        // If false, no API request will be made! This may be useful for testing
        // or if the API is (temporarily) unreachable
        'active' => true,

        // in a resource's HTML: replace references to avalex.de in order to
        // avoid external cookies
        'replace-references' => true,

        // log certain events
        'log' => false,

        // caching is required!
        'cache' => [
            'resources' => [
                'active' => true,
                'type' => 'avalex',
            ],
        ],
    ],

    'blueprints' => [
        'fields/avx_select_resource'          => __DIR__ . '/blueprints/fields/avx_select_resource.yml',
        'fields/avx_select_resource_multiple' => __DIR__ . '/blueprints/fields/avx_select_resource_multiple.yml',
        'fields/avx_preview'                  => __DIR__ . '/blueprints/fields/avx_preview.yml',
        'sections/avx_stats'                  => __DIR__ . '/blueprints/sections/avx_stats.yml',
        'pages/avalex'                        => __DIR__ . '/blueprints/pages/avalex.yml',
    ],

    'pageModels' => [
        'avalex' => AvalexPage::class,
    ],

    'templates' => [
        'avalex' => __DIR__ . '/templates/avalex.php',
    ],

    'translations' => include __DIR__ . '/include/translations.php',

    'cacheTypes' => [
        'avalex' => \Avalex\Avalex\AvalexCache::class
    ],

    'siteMethods' => [
        /**
         * Return instance of the avalex base class
         *
         * @return \Avalex\Avalex\Avalex
         */
        'avalex' => function (): \Avalex\Avalex\Avalex {
            return new \Avalex\Avalex\Avalex();
        },
    ]
]);

if (\Kirby\Cms\Helpers::hasOverride('avalex') === false) {
    /**
     * Load resource from avalex.de
     *
     * @param mixed $resource string or Field
     * @param array|scalar|null $options
     * @return string
     * @throws \Kirby\Exception\InvalidArgumentException
     */
    function avalex($resource, $options = null): string {
        return (new \Avalex\Avalex\Avalex())->resource((string) $resource, $options);
    }
}
