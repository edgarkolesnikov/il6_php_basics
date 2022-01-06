<html>
    <head><title>Our Website</title></head>
    <body>
    <h2>Prisijunti</h2>
    <form action="login.php">
        <input type="email" name="email" placeholder="john@gmail.com">
        <input type="password" name="password" placeholder="*******">
        <input type="submit" value="Prisijungti" >
    </form>
    <hr>
    <h2>Registracijos forma</h2>
        <form action="registration.php" method="post">
            <input type="text" name="first_name" placeholder="Vardas"><br>
            <input type="text" name="last_name" placeholder="Pavarde"><br>
            <input type="email" name="email" placeholder="Emailas"><br>
            <input type="password" name="password1" placeholder="Slaptazodis"><br>
            <input type="password" name="password2" placeholder="Pakartokite slaptazodi"><br>
            <label for="agree_terms">Sutinku su registracijos taisyklemis.</label>
            <input type="checkbox" name="agree_terms" id="agree_terms">
            <input type="submit" value="Registruotis">
        </form>

    </body>
</html>