<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení</title>
    <link rel="stylesheet" href="../../public/stylesheet.css">
</head>
<body>
    
<?php include __DIR__ . '/../../public/components/navbar.html'; ?>

<div class="container">
    <div class="card">
        <h2>Přihlášení</h2>
        <form action="/~georgivrbsky/src/controllers/LoginController.php" method="post">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>

            <label for="heslo">Heslo:</label><br>
            <input type="password" id="heslo" name="heslo" required><br>

            <button type="submit">Odeslat</button>
        </form>
        <p>Nemáš účet? <a href="register_page.php">Registruj se zde</a></p>
    </div>
</div>

<?php include __DIR__ . '/../../public/components/footer.html'; ?>

</body>
</html>
