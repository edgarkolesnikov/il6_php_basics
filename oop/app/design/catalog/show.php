<?php $ad = $this->data['ad']; ?>

<div class="wrapper">
    <div class="post-content">
        <h1><?= $ad->getTitle(); ?></h1>
        <div class="image-wrapper">
            <img src="<?= $ad->getImage() ?>">
        </div>
        <div class="avg-rating">
            <?php if ($this->isUserLoged()): ?>
            <a href="<?= $this->url('message/chat/' . $ad->getUserId()) ?>">
                Rasyti zinute savininkui
            </a>
            <?php $remember = \Model\Memorised::isItFavouriteAd($_SESSION['user_id'],$ad->getId()) ?>
            <?php if(!$remember): ?>
        <?php if ($_SESSION['user_id'] !== $ad->getUserId()): ?>

            <br><br>
            <div class="favourite">

                    <form action="<?= $this->url('catalog/memorise') ?>" method="POST">
                        <input type="hidden" name="ad_id" value="<?= $ad->getId() ?>">
                        <button class="button">Isiminti</button>
                    </form>
                <?php endif; ?>
                <?php else: ?>
                <form action ="<?= $this->url('catalog/forget') ?>" method="POST">
                    <input type="hidden" name="ad_id" value="<?= $ad->getId() ?>">
                    <button class="button">Nepatinka naxuj</button>
                </form>
                <?php endif; ?>
            </div>
            <span>Skelbimo ivertinimas(<?= $this->data['rating_count'] ?>):</span>
            <?= round($this->data['ad_rating'], 2) ?>


            <form action="<?= $this->url('catalog/rate') ?>" method="POST">
                <input type="hidden" name="ad_id" value="<?= $ad->getId(); ?>">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <input type="radio"
                        <?php if ($this->data['rated'] && $this->data['user_rate'] == $i): ?>
                            checked
                        <?php endif; ?>
                           value="<?= $i ?>" name="rate">
                <?php endfor; ?>
                <br>
                <input type="submit" value="Ragte this garbage!" name="rate_submit">
            </form>


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
                <a href="<?php echo $this->url('catalog/edit/', $ad->getId()); ?>"> Redaguoti </a>
            </div>
        </div>


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
        <?php endif; ?>

    </div>
</div>
