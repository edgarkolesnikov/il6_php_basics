<?php $ad = $this->data['ad']; ?>

<div class="wrapper">
    <div class="post-content">
        <h1><?= $ad->getTitle(); ?></h1>
        <div class="image-wrapper">
            <img src="<?= $ad->getImage() ?>">
        </div>
        <div id="price" class="price">
            <h2>Price: <?= $ad->getPrice(); ?></h2>
        </div>
        <div class="details">
            <p>
                Description: <?= $ad->getDescription() ?>
                <br>
                <br>
                Year: <?= $ad->getYear(); ?> <br>
                Vin: <?= $ad->getVinCode(); ?> <br>
            </p>
            <a href="<?php echo $this->url('catalog/edit', $ad->getId()); ?>"> Edit </a>
        </div>
    </div>
    <br>
    <div class="type-comment">
        <h4>Palikti komentara</h4>
        <?= $this->data['comment']; ?>
    </div>

    <div class="Comments">
        <h3>Komentarai</h3>
    </div>
    <?php foreach ($this->data['comments'] as $comment): ?>
        <div class="single-comment">
            <div class="comment-credentials">
                <?php
                    $id = $comment->getUserId();
                    $user = new \Model\User();
                    $user->load($id);
                    echo $user->getName() . ' ';
                     echo $user->getEmail() . ' ';
                ?>
                <?= $comment->getDate(); ?>
        </div>
            <div class="comment-itself">
            <?= $comment->getMessage(); ?>
            </div>
        </div>
    <?php endforeach; ?>

</div>
</div>
