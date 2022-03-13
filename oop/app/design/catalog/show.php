<?php $ad = $this->data['ad']; ?>

<div class="wrapper">
    <div class="post-content">
        <h1><?= $ad->getTitle(); ?></h1>
        <div class="image-wrapper">
            <img src="<?= $ad->getImage() ?>">
        </div>
            <div class="avg-rating">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
        <?php
            $userId = $_SESSION['user_id'];
            $adId = $ad->getId();


        $data = \Model\Rating::checkIfUserVoted($userId, $adId);
        if(isset($data) == true ):

            $avg = \Model\Rating::countAverageRating($ad->getId());
            ?>
                <h3>Vidurkis <?= round($avg[0],1); ?></h3>
            </div>
            <?php else: ?>
        <div class="rating">
            <form action="<?= BASE_URL.'catalog/rateAd' ?>" method="POST">
                <p>Skelbimo ivertinimas</p>
                <input type="hidden" name="ad_id" value="<?= $ad->getId(); ?>"
                <input type="radio" id="html" name="rating" value="1">
                <label for="rating">1</label>
                <input type="radio" id="css" name="rating" value="2">
                <label for="rating">2</label>
                <input type="radio" id="javascript" name="rating" value="3">
                <label for="rating">3</label>
                <input type="radio" id="javascript" name="rating" value="4">
                <label for="rating">4</label>
                <input type="radio" id="javascript" name="rating" value="5">
                <label for="rating">5</label>
                <input type="submit" name="submit" value="Ok">

            </form>
        </div>

        <?php endif; ?>

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

    <?php if($this->isUserLoged() && $ad->getUserId() !== $_SESSION['user_id']): ?>
    <a href="<?=$this->url('message/chat/'.$ad->getUserId()) ?>">
        Rasyti zinute savininkui
    </a>
    <?php endif;  ?>
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
