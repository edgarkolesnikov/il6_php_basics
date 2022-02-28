<div class="list-wrapper">
    <ol>
        <?php foreach ($this->data['users'] as $user): ?>
        <li>
            <a href="<?php echo BASE_URL.'/user/show'.$user->getId() ?>">
               <?php echo $user->getName(). ' '.$user->getLastName() ?>
            </a>
        </li>
        <a href="<?php echo BASE_URL.'/user/edit'.$user->getId() ?>" </a>
        <?php endforeach; ?>
    </ol>
</div>