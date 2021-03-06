<div class="classique">

    <div class="hidentitle">
        <?= $page->title ?>
    </div>
    <div class="row">
        <div class="columns small-12">
            <h1><?= $page->title ?></h1>
        </div>
        <?php if (!empty($page->image_gauche)) : ?>
        <div class="columns large-3 medium-3">

            <div class="img_container">
                <img src="<?=$page->image_gauche?>">
                <a class="zoom" href="<?= $page->image_gauche ?>" data-lightbox="<?= $page->image_gauche ?>"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="columns large-6 medium-6">
        <?php else : ?>
        <div class="columns large-9 medium-7">
        <?php endif; ?>
                <?= $page->content_gauche ?>
        </div>
        <div class="columns large-3 medium-5">
            <?php if (!empty($page->image_droit)) : ?>

                <div class="img_container">
                    <img src="<?= $page->image_droit ?>">
                    <a class="zoom" href="<?= $page->image_droit ?>" data-lightbox="<?= $page->image_droit ?>"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                </div>
            <?php else : ?>
                <?= $page->content_droit ?>
            <?php endif; ?>
        </div>
        </div>
    </div>