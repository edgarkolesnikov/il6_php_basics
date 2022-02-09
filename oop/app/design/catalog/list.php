<div class="list-wrapper">
    <ol>

        <?php foreach ($this->data['ads'] as $ad): ?>

            <?php if($ad->getActive == 1){ ?>
            <li>

                <a href="<?php echo BASE_URL.'/catalog/show/'.$ad->getId() ?>">

                    <img width="200" height="200" src="<?php echo $ad->getImage(); ?>">

                    <?php echo $ad->getTitle(). ' '.$ad->getYear() ?>
                    <?php } ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ol>
</div>