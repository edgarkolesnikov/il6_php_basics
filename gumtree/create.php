<html>
    <head>
        <title>Create add</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="title" placeholder="Title"><br>
            <textarea name="content" placeholder="Aprasymas"></textarea><br>
            <input type="number" name="price" placeholder="Kaina"><br>
            <select>
                <?php for($i = 1970; $i < date('Y');$i++){
                    echo '<option value="'.$i.'">'.$i.'</option>';
                }?>
            </select>
            <br>
        </form>
    </body>
</html>