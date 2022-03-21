<html>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<head>
    <title> <?php echo $this->data['title'] ?></title>
    <meta name="description" content="<?= $this->data['meta_description'] ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL_WITHOUT_INDEX_PHP . 'css/style.css'; ?> ">
</head>
<body>
<header>
    <div class="sliding-part">
        Auto 10% nuolaida su kodu madafaka10
    </div>
    <nav>
        <ul>
            <li>
                <a href="<?php echo $this->url('') ?>">Home Page</a>
            </li>

            <li>
                <a href="<?= $this->url('catalog') ?>">All ads</a>
            </li>

            <?php if ($this->isUserLoged()): ?>

                <li>
                    <a href="<?= $this->url('catalog/add') ?>">Add new</a>
                </li>

                <li>
                    <a href="<?= $this->url('user/edit') ?>">User settings</a>
                </li>

                <li>
                    <a href="<?= $this->url('Message'); ?>">Messages<?= $this->data['new_messages']; ?></a>
                </li>

                <li>
                    <a href="<?= $this->url('catalog/memorisedAds'); ?>">Favourite</a>
                </li>

                <li>
                    <a href="user/logout">logout</a>
                </li>

            <?php else: ?>
            <li>
                <a href="user/login">Login</a>
            </li>

            <li>
                <a href="user/register">Sign Up</a>
            </li>

        </ul>

        <?php endif; ?>

        <?php if ($this->isUserAdmin()): ?>
            <li>
                <a href="<?= $this->url('Admin') ?>">ADMIN</a>
            </li>
        <?php endif; ?>
    </nav>


</header>
