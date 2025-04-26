<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">


</head>
<body>

<form method="post" action="/~georgivrbsky/src/controllers/RegisterController.php">

    <label for="jmeno">Jmeno: </label><br>
    <input type="text" id="jmeno" name="jmeno" required><br>

    <label for="prijmeni">Prijmeni: </label><br>
    <input type="text" id="prijmeni" name="prijmeni" required><br>

    <label for="email">email: </label><br>
    <input type="email" id="email" name="email" required><br>

    <label for="telefon">Telefon:</label><br>
    <input type="number" id="telefon" name="telefon" required><br>

    <label for="datum_narozeni">Datum narozeni:</label><br>
    <input type="date" id="datum_narozeni" name="datum_narozeni" required><br><br>

    <label for="pohlavi">Pohlaví:</label>
    <select id="pohlavi" name="pohlavi" required>
        <option value="">-- Vyberte --</option>
        <option value="muz">Muž</option>
        <option value="zena">Žena</option>
        <option value="jine">Jiné</option>
    </select><br>

    <label for="heslo">Heslo: </label><br>
    <input type="password" id="heslo" name="heslo" required><br>

    <label for="confirm_heslo">Potvrzeni hesla: </label><br>
    <input type="password" id="confirm_heslo" name="confirm_heslo" required><br>

    <input type="submit" value="Odeslat">


</form>

</body>
</html>