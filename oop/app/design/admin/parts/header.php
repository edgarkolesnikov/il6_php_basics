<html>
<head>
    <title> <?php echo $this->data['title'] ?></title>
    <meta name="description" content="<?= $this->data['meta_description'] ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL_WITHOUT_INDEX_PHP.'css/admin.css'; ?> ">
</head>
<body>
<header>
    <nav>
        <ul>
            <div class="header">
                <img class="logo" src="https://static.vecteezy.com/system/resources/previews/000/623/448/non_2x/auto-car-logo-template-vector-icon.jpg">
                    <div class="header-right">

                    <a href="<?php echo $this->url('') ?>">Home Page</a>

                    <a href="<?php echo $this->url('admin/ads') ?>">Ads</a>

                        <a href="<?php echo $this->url('admin/users') ?>">Users</a>

                    <a href="/oop/user/logout">logout</a>

                    </div>
            </div>

        </ul>
    </nav>

</header>
