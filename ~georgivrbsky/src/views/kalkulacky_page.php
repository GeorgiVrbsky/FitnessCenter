<?php
session_start();
$user_id = $_SESSION["user_id"] ?? null;
if (!$user_id) {
    header("Location: /~georgivrbsky/src/views/login_page.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výživové Kalkulačky</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(178, 178, 178);
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            background-color:rgb(148, 0, 202);
            color: white;
            padding: 20px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .calculator {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 10px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input, select, button {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color:rgb(152, 0, 198);
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color:rgb(65, 0, 105);
        }

        p {
            font-size: 1.2em;
            color: green;
        }
    </style>
</head>
<body>
    <h1>Výživové Kalkulačky</h1>

    <div class="container">

        <div class="calculator">
            <h2>BMI Kalkulačka</h2>
            <form id="bmi_form">
                <label for="vyska">Výška (cm):</label>
                <input type="number" id="vyska" required>

                <label for="hmotnost">Hmotnost (kg):</label>
                <input type="number" id="hmotnost" required>

                <button type="submit">Vypočítat BMI</button>
            </form>
            <p id="bmi_vypocet"></p>
        </div>

    <a href="/~georgivrbsky/src/views/dashboard_page.php">
        <button class="back-button">Zpět</button>
    </a>

    <script>
        // Kalkulačka pro BMI
        document.getElementById('bmi_form').addEventListener('submit', function(event) {
            event.preventDefault();
            const vyska = parseFloat(document.getElementById('vyska').value);
            const hmotnost = parseFloat(document.getElementById('hmotnost').value);
            const bmi = hmotnost / Math.pow(vyska / 100, 2);
            document.getElementById('bmi_vypocet').innerText = `Vaše BMI: ${bmi.toFixed(2)}`;
        });

        
    </script>
</body>
</html>
