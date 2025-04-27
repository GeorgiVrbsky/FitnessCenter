<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášeníi</title>
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
    
</head>
<body>

    <div class="container">
        <form class ="login-form" action="/~georgivrbsky/src/controllers/LoginController.php" method="post">
            <h2>Vitejte zpet</h2>
            <p>Prihlaste se do sveho uctu</p>

            <div class="input-group">
                <label for="email"> Email</label>
                <input type="email" id="email" name="email" placeholder="Ales@seznam.cz" required>
            </div>

            <div class="input-group">
                <label for="heslo">Heslo:</label>
                <input type="password" id="heslo" name="heslo" placeholder="********" required>
            </div>

            <button type="submit" class="login-button">Prihlasit se</button>

            <div class="signup-link">
                Nemate jeste ucet? <a href="/~georgivrbsky/src/views/register_page.php">Registrovat se</a>
            </div>
            

        </form>



    </div>




</body>
</html>
