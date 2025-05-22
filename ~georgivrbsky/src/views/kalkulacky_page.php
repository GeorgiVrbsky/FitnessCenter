<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kompletní nutriční kalkulačka</title>
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
</head>
<body class="dashboard-body">
    <div class="wrapper">
    <header>
        <?php include __DIR__ . '/../../public/components/navbar.php'; ?>
    </header>

    <div class="container">
        <h1>Kompletní nutriční kalkulačka</h1>
        <p class="intro">Zadejte své údaje a zjistěte optimální příjem kalorií, makroživin, BMI a doporučený příjem vody</p>
        
        <form class="calculator-form" id="nutrition-calculator">
            <div class="form-grid">
                <div class="form-group">
                    <label for="gender">Pohlaví</label>
                    <select id="gender">
                        <option value="male">Muž</option>
                        <option value="female">Žena</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="age">Věk (roky)</label>
                    <input type="number" id="age" min="10" max="100" value="30">
                </div>
                
                <div class="form-group">
                    <label for="height">Výška (cm)</label>
                    <input type="number" id="height" min="100" max="250" value="170">
                </div>
                
                <div class="form-group">
                    <label for="weight">Váha (kg)</label>
                    <input type="number" id="weight" min="30" max="200" value="70">
                </div>
                
                <div class="form-group">
                    <label for="activity">Úroveň aktivity</label>
                    <select id="activity">
                        <option value="1.2">Sedavý způsob života</option>
                        <option value="1.375">Lehká aktivita</option>
                        <option value="1.55" selected>Střední aktivita</option>
                        <option value="1.725">Vysoká aktivita</option>
                        <option value="1.9">Extrémní aktivita</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="goal">Cíl</label>
                    <select id="goal">
                        <option value="weight-loss">Hubnutí</option>
                        <option value="maintenance" selected>Udržení váhy</option>
                        <option value="muscle-gain">Nabírání svalů</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="diet-type">Typ stravy</label>
                    <select id="diet-type">
                        <option value="balanced" selected>Vyrovnaná</option>
                        <option value="low-carb">Nízkosacharidová</option>
                        <option value="high-protein">Vysokoproteinová</option>
                        <option value="keto">Keto</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="water-activity">Aktivita pro výpočet vody</label>
                    <select id="water-activity">
                        <option value="low">Nízká</option>
                        <option value="medium" selected>Střední</option>
                        <option value="high">Vysoká</option>
                    </select>
                </div>
            </div>
            
            <button type="button" class="calculate-btn" onclick="calculateAll()">Spočítat vše</button>
        </form>
        
        <div class="results" id="results" style="display: none;">
            <div class="result-section">
                <h2>Kalorie</h2>
                <div class="result-item">
                    <span class="result-label">Bazální metabolismus (BMR):</span>
                    <span class="result-value"><span id="bmr">0</span> kcal</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Celkový denní výdej (TDEE):</span>
                    <span class="result-value"><span id="tdee">0</span> kcal</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Pro udržení váhy:</span>
                    <span class="result-value"><span id="maintenance">0</span> kcal</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Pro hubnutí:</span>
                    <span class="result-value"><span id="weight-loss">0</span> kcal</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Pro nabírání:</span>
                    <span class="result-value"><span id="weight-gain">0</span> kcal</span>
                </div>
            </div>
            
            <div class="result-section">
                <h2>Makroživiny</h2>
                <div class="result-item">
                    <span class="result-label">Bílkoviny:</span>
                    <span class="result-value"><span id="protein">0</span> g (<span id="protein-percent">0</span>%)</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Sacharidy:</span>
                    <span class="result-value"><span id="carbs">0</span> g (<span id="carbs-percent">0</span>%)</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Tuky:</span>
                    <span class="result-value"><span id="fats">0</span> g (<span id="fats-percent">0</span>%)</span>
                </div>
            </div>
            
            <div class="result-section">
                <h2>BMI a voda</h2>
                <div class="result-item">
                    <span class="result-label">BMI index:</span>
                    <span class="result-value"><span id="bmi-value">0</span> (<span id="bmi-category">-</span>)</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Minimální voda:</span>
                    <span class="result-value"><span id="water-min">0</span> l</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Doporučená voda:</span>
                    <span class="result-value"><span id="water-recommended">0</span> l</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Při aktivitě:</span>
                    <span class="result-value"><span id="water-active">0</span> l</span>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        // Hlavní výpočetní funkce
        function calculateAll() {
            calculateCalories();
            calculateMacros();
            calculateBMI();
            calculateWater();
            document.getElementById('results').style.display = 'grid';
        }
        
        // Kalorická kalkulačka
        function calculateCalories() {
            const gender = document.getElementById('gender').value;
            const age = parseInt(document.getElementById('age').value);
            const height = parseInt(document.getElementById('height').value);
            const weight = parseInt(document.getElementById('weight').value);
            const activity = parseFloat(document.getElementById('activity').value);

            // Výpočet BMR (Bazální metabolismus)
            let bmr;
            if (gender === 'male') {
                bmr = 88.362 + (13.397 * weight) + (4.799 * height) - (5.677 * age);
            } else {
                bmr = 447.593 + (9.247 * weight) + (3.098 * height) - (4.330 * age);
            }

            // Výpočet TDEE (Celkový denní výdej)
            const tdee = bmr * activity;

            // Výpočet cílů
            const maintenance = Math.round(tdee);
            const weightLoss = Math.round(tdee * 0.85); // 15% deficit
            const weightGain = Math.round(tdee * 1.15); // 15% surplus

            // Zobrazení výsledků
            document.getElementById('bmr').textContent = Math.round(bmr);
            document.getElementById('tdee').textContent = maintenance;
            document.getElementById('maintenance').textContent = maintenance;
            document.getElementById('weight-loss').textContent = weightLoss;
            document.getElementById('weight-gain').textContent = weightGain;
        }

        // Makroživiny kalkulačka
        function calculateMacros() {
            const goal = document.getElementById('goal').value;
            const calories = parseInt(document.getElementById('tdee').textContent);
            const dietType = document.getElementById('diet-type').value;

            // Výchozí poměry pro vyrovnanou stravu
            let proteinRatio = 0.3;
            let carbsRatio = 0.4;
            let fatsRatio = 0.3;

            // Úprava poměrů podle cíle
            if (goal === 'weight-loss') {
                proteinRatio = 0.35;
                carbsRatio = 0.35;
                fatsRatio = 0.3;
            } else if (goal === 'muscle-gain') {
                proteinRatio = 0.35;
                carbsRatio = 0.45;
                fatsRatio = 0.2;
            }

            // Úprava poměrů podle typu stravy
            if (dietType === 'low-carb') {
                carbsRatio = 0.2;
                fatsRatio = 0.5;
                proteinRatio = 0.3;
            } else if (dietType === 'high-protein') {
                proteinRatio = 0.4;
                carbsRatio = 0.3;
                fatsRatio = 0.3;
            } else if (dietType === 'keto') {
                proteinRatio = 0.25;
                carbsRatio = 0.05;
                fatsRatio = 0.7;
            }

            // Výpočet gramů
            const proteinGrams = Math.round((calories * proteinRatio) / 4);
            const carbsGrams = Math.round((calories * carbsRatio) / 4);
            const fatsGrams = Math.round((calories * fatsRatio) / 9);

            // Výpočet procent
            const proteinPercent = Math.round(proteinRatio * 100);
            const carbsPercent = Math.round(carbsRatio * 100);
            const fatsPercent = Math.round(fatsRatio * 100);

            // Zobrazení výsledků
            document.getElementById('protein').textContent = proteinGrams;
            document.getElementById('protein-percent').textContent = proteinPercent;
            document.getElementById('carbs').textContent = carbsGrams;
            document.getElementById('carbs-percent').textContent = carbsPercent;
            document.getElementById('fats').textContent = fatsGrams;
            document.getElementById('fats-percent').textContent = fatsPercent;
        }

        // BMI kalkulačka
        function calculateBMI() {
            const height = parseInt(document.getElementById('height').value) / 100; // převod na metry
            const weight = parseInt(document.getElementById('weight').value);

            const bmi = (weight / (height * height)).toFixed(1);

            let category;
            if (bmi < 18.5) {
                category = "Podváha";
            } else if (bmi >= 18.5 && bmi < 25) {
                category = "Normální váha";
            } else if (bmi >= 25 && bmi < 30) {
                category = "Nadváha";
            } else {
                category = "Obezita";
            }

            document.getElementById('bmi-value').textContent = bmi;
            document.getElementById('bmi-category').textContent = category;
        }

        // Vodní kalkulačka
        function calculateWater() {
            const weight = parseInt(document.getElementById('weight').value);
            const activity = document.getElementById('water-activity').value;

            // Základní výpočet (30-35 ml na kg)
            const minWater = (weight * 0.03).toFixed(1);
            const recommendedWater = (weight * 0.035).toFixed(1);

            // Úprava podle aktivity
            let activeWater;
            if (activity === 'low') {
                activeWater = recommendedWater;
            } else if (activity === 'medium') {
                activeWater = (parseFloat(recommendedWater) + 0.3).toFixed(1);
            } else {
                activeWater = (parseFloat(recommendedWater) + 0.7).toFixed(1);
            }

            document.getElementById('water-min').textContent = minWater;
            document.getElementById('water-recommended').textContent = recommendedWater;
            document.getElementById('water-active').textContent = activeWater;
        }

        // Inicializace - spočítat při načtení stránky
        window.onload = function() {
            calculateAll();
        };
    </script>
</body>
</html>