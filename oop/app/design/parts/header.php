<html>
    <head>
        <title>Atupliusas</title>
        <link rel="stylesheet" href="<?php echo BASE_URL_WITHOUT_INDEX_PHP.'css/style.css'; ?> ">
    </head>
<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="<?php echo BASE_URL ?>">Home Page</a>
                </li>

                <li>
                    <a href="<?php echo BASE_URL ?>/catalog/all">All ads</a>
                </li>

                    <?php if($this->isUserLoged()): ?>



                <li>
                    <a href="<?php echo BASE_URL ?>/catalog/add">Add new</a>
                </li>


                <li>
                    <a href="<?php echo BASE_URL ?>/user/edit">User settings</a>
                </li>

                <li>
                    <a href="/oop/user/logout">logout</a>
                </li>


                <?php else: ?>
                <li>

                    <a href="/oop/user/login">Login</a>
                </li>

                <li>
                    <a href="/oop/user/register">Sign Up</a>
                </li>

            </ul>
            <?php  endif; ?>
        </nav>

    </header>
