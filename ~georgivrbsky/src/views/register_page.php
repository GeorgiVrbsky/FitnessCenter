<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
</head>
<body>

<div class="container" style="max-width: 500px; margin-top: 70px;">
    <div class="form-container">
        <h2>Registrace uživatele</h2>

        <form method="post" action="/~georgivrbsky/src/controllers/RegisterController.php" class="register-form">
            <!-- Jméno -->
            <div class="input-group">
                <label for="jmeno">Jméno:</label>
                <input type="text" id="jmeno" name="jmeno" required>
            </div>

            <!-- Příjmení -->
            <div class="input-group">
                <label for="prijmeni">Příjmení:</label>
                <input type="text" id="prijmeni" name="prijmeni" required>
            </div>

            <!-- Email -->
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <!-- Telefon -->
            <div class="input-group">
                <label for="telefon">Telefon:</label>
                <input type="number" id="telefon" name="telefon" required>
            </div>

            <!-- Datum narození -->
            <div class="input-group">
                <label for="datum_narozeni">Datum narození:</label>
                <input type="date" id="datum_narozeni" name="datum_narozeni" required>
            </div>

            <!-- Pohlaví -->
            <div class="input-group">
                <label for="pohlavi">Pohlaví:</label>
                <select id="pohlavi" name="pohlavi" required>
                    <option value="">-- Vyberte --</option>
                    <option value="muz">Muž</option>
                    <option value="zena">Žena</option>
                    <option value="jine">Jiné</option>
                </select>
            </div>

            <!-- Heslo -->
            <div class="input-group">
                <label for="heslo">Heslo:</label>
                <input type="password" id="heslo" name="heslo" required>
            </div>

            <!-- Potvrzení hesla -->
            <div class="input-group">
                <label for="confirm_heslo">Potvrzení hesla:</label>
                <input type="password" id="confirm_heslo" name="confirm_heslo" required>
            </div>

            <!-- Tlačítko pro odeslání -->
            <button type="submit" class="submit-button">Odeslat</button>
        </form>
    </div>
</div>

</body>
</html>
