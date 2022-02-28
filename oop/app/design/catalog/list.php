<!--<div class="wrapper">-->
<!--    <ol>-->
<!--        --><?php //foreach ($this->data['ads'] as $ad): ?>
<!---->
<!--            <ul class="pagination">-->
<!--                <li><a href="?pageno=1">First</a></li>-->
<!--                <li class="--><?php //if($pageno <= 1){ echo 'disabled'; } ?><!--">-->
<!--                    <a href="--><?php //if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?><!--">Prev</a>-->
<!--                </li>-->
<!--                <li class="--><?php //if($pageno >= $total_pages){ echo 'disabled'; } ?><!--">-->
<!--                    <a href="--><?php //if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?><!--">Next</a>-->
<!--                </li>-->
<!--                <li><a href="?pageno=--><?php //echo $total_pages; ?><!--">Last</a></li>-->
<!--            </ul>-->
<!--            </tr>-->
<!--        --><?php //endforeach; ?>
<!--    </ol>-->
<!--</div>-->

<?php $pages = ceil($this->data['count'] / 3); ?>

<div class="wrapper">
    <div class="catalog">
        <?php foreach ($this->data['ads'] as $ad): ?>
            <div class="box">
                <div class="padding">
                    <a href="<?php echo $this->url('catalog/show', $ad->getSlug()) ?>">
                        <img src="<?php echo $ad->getImage() ?>">
                        <div class="title">
                            <?php echo $ad->getTitle() .'('.$ad->getYear().')'?>
                        </div>
                        <div class="price">
                            <span><?php echo $ad->getPrice().'€' ?></span>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="pagination">
        <ul>
            <?php for($i = 1; $i <= $pages; $i++): ?>

                <li>
                    <a href="<?= $this->url('catalog').'?p='.$i; ?>">
                        <?= $i; ?>
                    </a>
                </li>

            <?php endfor; ?>
        </ul>
    </div>
</div>