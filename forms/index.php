<!DOCTYPE html>
<html>
        <head>
            <title>Puslapio title</title>
        </head>
    <body>
    <div clas="header">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Some pages</a></li>
            <li><a href="#">Login</a></li>
        </ul>
    </div>
        <div class ="content">
            <h1>Musu Title</h1>
            <p>Registracijos forma:
                laukeliai:
            <ul>
            <li>vardas</li>
            <li>pavarde</li>
            <li>emailas</li>
            <li>paswordas</li>
            <li>pakartotinis paswordas</li>
            </ul>
            Validacija:
                Emailas.
                Passwordas.

            Jei viskas teisingai,
            "uzregistruojame" vartotoja.
            tai isvedame sutvarkyta emaila,
            Varda, Pavarde, Nickname
            </p>
            <form action="functions.php" method="post">
<!--   222             <input type="email" name="email" placeholder="john@email.com"/>-->
<!--                <input type="submit" value="OK" name="submit" />-->



<!--                111          -->
                <input type="number" name="number" placeholder="pirmas skaicius">
                <select name="veiksmas">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
                </select>
                <input type="number" name="number2" placeholder="antras skaicius">
                <input type="submit" value="suskaiciuoti">

            </form>
        </div>
    </body>
</html>
<style>
    .header{background: #0000ff; color: #ccc; border-bottom: 1px solid #ff0000;}
    .header ul{display: flex; flex-wrap: wrap}
    .header li{margin-left: 20px}
    .header a{color: #ff0000;}
    .content{width: 800px; margin: 0 auto; background: beige;}
</style>