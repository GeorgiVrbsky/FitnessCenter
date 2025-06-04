<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace | Fitness Center</title>
    <meta name="description" content="Zaregistrujte se ke svému účtu na Fitness centrum. Rychlá, bezpečná a snadná registrace.">
    <meta name="keywords" content="registrace, registration, účet, FitnessCenter"> 
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
    <link rel="icon" href="/~georgivrbsky/public/components/balloon-heart-fill.svg" type="image/svg">
</head>
<body>

<div class="kontejner" style="max-width: 500px; margin-top: 30px;">
        <h2>Registrace uživatele</h2>

        <form class="login-formular" method="post" action="/~georgivrbsky/src/controllers/RegisterController.php">

            <div class="input-skupina">
                <label for="jmeno">Jméno:</label>
                <input type="text" id="jmeno" name="jmeno" required>
            </div>

            <div class="input-skupina">
                <label for="prijmeni">Příjmení:</label>
                <input type="text" id="prijmeni" name="prijmeni" required>
            </div>

            <div class="input-skupina">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-skupina">
            <label for="telefon">Telefon:</label>
            <input type="tel" id="telefon" name="telefon" required pattern="^\+?[0-9]{9,15}$" placeholder="+420123456789" required>
            </div>

            <div class="input-skupina">
            <label for="datum_narozeni">Datum narození:</label>
            <input type="date" id="datum_narozeni" name="datum_narozeni" required max="<?= date('Y-m-d') ?>">
            </div>

            <div class="input-skupina">
                <label for="pohlavi">Pohlaví:</label>
                <select id="pohlavi" name="pohlavi" required>
                    <option value="">Vyberte Pohlaví</option>
                    <option value="muz">Muž</option>
                    <option value="zena">Žena</option>
                    <option value="jine">Jiné</option>
                </select>
            </div>

            <div class="input-skupina">
                <label for="heslo">Heslo:</label>
                <input type="password" id="heslo" name="heslo" required>
            </div>

            <div class="input-skupina">
                <label for="confirm_heslo">Potvrzení hesla:</label>
                <input type="password" id="confirm_heslo" name="confirm_heslo" required>
            </div>

            <button type="submit" class="submit-tlacitko">Odeslat</button>
        </form>
</div>

</body>
</html>
