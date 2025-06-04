<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení | Fitness Center</title>
    <meta name="description" content="Přihlaste se ke svému účtu na Fitness centrum. Rychlé, bezpečné a snadné přihlášení.">
    <meta name="keywords" content="přihlášení, login, účet, FitnessCenter"> 
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
    <link rel="icon" href="/~georgivrbsky/public/components/balloon-heart-fill.svg" type="image/svg">
</head>
<body>
    
    <div class="kontejner" style="max-width: 500px;">
        <h1 style="border-bottom:none; font-size: 3rem;">Fitness Center</h1>
        <form class ="login-formular" action="/~georgivrbsky/src/controllers/LoginController.php" method="post">
            <h2>Vítejte zpět</h2>
            <p>Přihlašte se do svého účtu</p>

            <div class="input-skupina">
                <label for="email"> Email</label>
                <input type="email" id="email" name="email" placeholder="Ales@seznam.cz" required>
            </div>

            <div class="input-skupina">
                <label for="heslo">Heslo:</label>
                <input type="password" id="heslo" name="heslo" placeholder="********" required>
            </div>

            <button type="submit" class="submit-tlacitko">Přihlásit se</button>

            <div class="registrace-link">
                Nemáte ještě účet? <a href="/~georgivrbsky/src/views/register_page.php">Registrujte se</a>
            </div>
            
        </form>
    </div>
</body>
</html>
