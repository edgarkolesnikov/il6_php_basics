<html>
    <head>
        <title name="Registracija"></title>
    </head>
        <body>
        <h1>Registracija</h1>
        <form action="functions.php" method="post">

            <li><input type="text" name="name" placeholder="Vardas" required="required" pattern="[A-Za-z0-9]{1,20}"></li>
            <li><input type="text" name="surname" placeholder="Pavarde" required="required" pattern="[A-Za-z0-9]{1,20}"></li>
            <li><input type="text" name="email" placeholder="El.pastas"></li>
            <li><input type="password" name="password" placeholder="Slaptazodis" minlength="6"></li>
            <li><input type="password" name="confirmPassword" placeholder="Pakartokite Slaptazodi" minlength="6"></li>
            <li><input type="submit" value="Registruotis"></li>

        </form>
        </body>
</html>