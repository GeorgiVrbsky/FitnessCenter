<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výživové Kalkulačky</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            background-color: #007BFF;
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
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
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
        <!-- Kalkulačka pro BMI -->
        <div class="calculator">
            <h2>BMI Kalkulačka</h2>
            <form id="bmi-form">
                <label for="height">Výška (cm):</label>
                <input type="number" id="height" required>
                <label for="weight">Hmotnost (kg):</label>
                <input type="number" id="weight" required>
                <button type="submit">Vypočítat BMI</button>
            </form>
            <p id="bmi-result"></p>
        </div>

        <!-- Kalkulačka pro kalorie -->
        <div class="calculator">
            <h2>Kalkulačka pro kalorie</h2>
            <form id="calories-form">
                <label for="age">Věk:</label>
                <input type="number" id="age" required>
                <label for="gender">Pohlaví:</label>
                <select id="gender">
                    <option value="male">Muž</option>
                    <option value="female">Žena</option>
                </select>
                <label for="weight_calories">Hmotnost (kg):</label>
                <input type="number" id="weight_calories" required>
                <label for="height_calories">Výška (cm):</label>
                <input type="number" id="height_calories" required>
                <label for="activity_level">Úroveň aktivity:</label>
                <select id="activity_level">
                    <option value="1.2">Sedavý způsob života</option>
                    <option value="1.375">Lehká aktivita</option>
                    <option value="1.55">Střední aktivita</option>
                    <option value="1.725">Vysoká aktivita</option>
                </select>
                <button type="submit">Vypočítat kalorie</button>
            </form>
            <p id="calories-result"></p>
        </div>

        <!-- Kalkulačka pro procento tuku -->
        <div class="calculator">
            <h2>Kalkulačka pro procento tuku</h2>
            <form id="fat-form">
                <label for="waist">Obvod pasu (cm):</label>
                <input type="number" id="waist" required>
                <label for="neck">Obvod krku (cm):</label>
                <input type="number" id="neck" required>
                <label for="hip">Obvod boků (cm, pro ženy):</label>
                <input type="number" id="hip">
                <label for="gender_fat">Pohlaví:</label>
                <select id="gender_fat">
                    <option value="male">Muž</option>
                    <option value="female">Žena</option>
                </select>
                <button type="submit">Vypočítat procento tuku</button>
            </form>
            <p id="fat-result"></p>
        </div>

        <!-- Kalkulačka pro ideální váhu -->
        <div class="calculator">
            <h2>Kalkulačka pro ideální váhu</h2>
            <form id="ideal-weight-form">
                <label for="height_ideal">Výška (cm):</label>
                <input type="number" id="height_ideal" required>
                <label for="gender_ideal">Pohlaví:</label>
                <select id="gender_ideal">
                    <option value="male">Muž</option>
                    <option value="female">Žena</option>
                </select>
                <button type="submit">Vypočítat ideální váhu</button>
            </form>
            <p id="ideal-weight-result"></p>
        </div>
    </div>

    <!-- Tlačítko pro návrat na jinou stránku -->
    <button class="back-button" onclick="window.location.href='dashboard_page.php';">Zpět</button>

    <script>
        // Kalkulačka pro BMI
        document.getElementById('bmi-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const height = parseFloat(document.getElementById('height').value);
            const weight = parseFloat(document.getElementById('weight').value);
            const bmi = weight / Math.pow(height / 100, 2);
            document.getElementById('bmi-result').innerText = `Vaše BMI: ${bmi.toFixed(2)}`;
        });

        // Kalkulačka pro kalorie
        document.getElementById('calories-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const age = parseInt(document.getElementById('age').value);
            const gender = document.getElementById('gender').value;
            const weight_calories = parseFloat(document.getElementById('weight_calories').value);
            const height_calories = parseFloat(document.getElementById('height_calories').value);
            const activity_level = parseFloat(document.getElementById('activity_level').value);
            
            let bmr;
            if (gender === 'male') {
                bmr = 10 * weight_calories + 6.25 * height_calories - 5 * age + 5;
            } else {
                bmr = 10 * weight_calories + 6.25 * height_calories - 5 * age - 161;
            }

            const calories = bmr * activity_level;
            document.getElementById('calories-result').innerText = `Vaše denní potřeba kalorií: ${calories.toFixed(2)} kcal`;
        });

        // Kalkulačka pro procento tuku
        document.getElementById('fat-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const waist = parseFloat(document.getElementById('waist').value);
            const neck = parseFloat(document.getElementById('neck').value);
            const hip = parseFloat(document.getElementById('hip').value) || 0;
            const gender_fat = document.getElementById('gender_fat').value;
            let fat_percentage;

            if (gender_fat === 'male') {
                fat_percentage = 86.010 * Math.log10(waist - neck) - 70.041 * Math.log10(height) + 36.76;
            } else {
                fat_percentage = 163.205 * Math.log10(waist + hip - neck) - 97.684 * Math.log10(height) - 78.387;
            }
            document.getElementById('fat-result').innerText = `Procento tělesného tuku: ${fat_percentage.toFixed(2)}%`;
        });

        // Kalkulačka pro ideální váhu
        document.getElementById('ideal-weight-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const height_ideal = parseFloat(document.getElementById('height_ideal').value);
            const gender_ideal = document.getElementById('gender_ideal').value;
            let ideal_weight;

            if (gender_ideal === 'male') {
                ideal_weight = 50 + 0.91 * (height_ideal - 152.4);
            } else {
                ideal_weight = 45.5 + 0.91 * (height_ideal - 152.4);
            }

            document.getElementById('ideal-weight-result').innerText = `Vaše ideální váha: ${ideal_weight.toFixed(2)} kg`;
        });
    </script>
</body>
</html>
