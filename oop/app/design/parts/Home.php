
<div class="box">
    <div class="column-left">
        <h2>Naujausi skelbimai</h2>
        <?php foreach ($this->data['latest'] as $ad): ?>
        <a href="<?php echo $this->url('catalog/show', $ad->getSlug()); ?>">
            <div class="image-wrapper">
                <img src="<?php echo $ad->getImage(); ?>">
                    <?= '€'.$ad->getPrice().'.-'; ?>
            </div>
            <br>
            <?php endforeach; ?>
    </div>
    <div class="column-right">
        <h2>Populiariausi skelbimai</h2>
        <?php foreach ($this->data['populars'] as $ad): ?>
        <a href="<?php echo $this->url('catalog/show', $ad->getSlug()); ?>">
            <div class="image-wrapper">
                <img src="<?php echo $ad->getImage(); ?>">
                    <?= '€'.$ad->getPrice().'.-';?>
            </div>
            <br>
            <?php endforeach; ?>
    </div>
</div>