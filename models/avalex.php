<?php

/**
 * Class AvalexPage
 *
 */


class AvalexPage extends \Kirby\Cms\Page {
    /**
     * Get the URL and target for previewing the page in the panel, depending on
     * the Kirby version
     *
     * @return array|string[]
     * @throws \Kirby\Exception\LogicException
     */
    public function avalexPreview(): array {
        $version = \Kirby\Cms\App::version();

        if ($version >= '5.0.0') {
            return [
                'url'    => $this->panel()->url() . '/preview/changes',
                'target' => '_self'
            ];
        }

        return [
            'url'    => $this->previewUrl(),
            'target' => 'avx_preview',
        ];
    }
}
