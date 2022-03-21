<h2>Naujausi skelbimai</h2>
<div class="container">
<?php foreach ($this->data['latest'] as $ad): ?>
    <div class="card" style="width: 18rem;">
        <img src="<?= $ad->getImage() ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= $ad->getTitle() ?></h5>
            <p class="card-text"><?= $ad->getPrice() ?></p>
            <a href="<?php echo $this->url('catalog/show', $ad->getSlug()); ?>" class="btn btn-primary">Daugiau</a>
        </div>
    </div>
<?php endforeach; ?>
</div>

<h2>Populiariausi skelbimai</h2>
<div class="container">
<?php foreach ($this->data['populars'] as $ad): ?>
    <div class="card" style="width: 18rem;">
        <img src="<?= $ad->getImage() ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= $ad->getTitle() ?></h5>
            <p class="card-text"><?= $ad->getPrice() ?></p>
            <a href="<?php echo $this->url('catalog/show', $ad->getSlug()); ?>" class="btn btn-primary">Daugiau</a>
        </div>
    </div>
<?php endforeach; ?>
</div>


