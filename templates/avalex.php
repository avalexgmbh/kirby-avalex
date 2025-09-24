<?php

/**
 * avalex.php
 *
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 */

?>

<?php snippet('header') ?>

<article>
    <h1 class="h1"><?= $page->title()->esc() ?></h1>

    <div class="text">
        <?= avalex($page->avx_resource()) ?>
    </div>
</article>

<?php snippet('footer') ?>
