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
        <div class="kontejner">
            <div class="nutrition-calculator">
                <h1>Kompletní nutriční kalkulačka</h1>
                <p class="intro">Zadejte své údaje a zjistěte optimální příjem kalorií, makroživin, BMI a doporučený příjem vody</p>
                
                <form class="calculator-form" id="nutrition-calculator">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="pohlavi">Pohlaví</label>
                            <select id="pohlavi">
                                <option value="muz">Muž</option>
                                <option value="zena">Žena</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="vek">Věk (roky)</label>
                            <input type="number" id="vek" min="10" max="100" value="22">
                        </div>
                        
                        <div class="form-group">
                            <label for="vyska">Výška (cm)</label>
                            <input type="number" id="vyska" min="100" max="250" value="170">
                        </div>
                        
                        <div class="form-group">
                            <label for="hmotnost">Váha (kg)</label>
                            <input type="number" id="hmotnost" min="30" max="200" value="70">
                        </div>
                        
                        <div class="form-group">
                            <label for="aktivita">Úroveň aktivity</label>
                            <select id="aktivita">
                                <option value="1.2">Sedavý způsob života</option>
                                <option value="1.375">Lehká aktivita</option>
                                <option value="1.55" selected>Střední aktivita</option>
                                <option value="1.725">Vysoká aktivita</option>
                                <option value="1.9">Extrémní aktivita</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="cil">Cíl</label>
                            <select id="cil">
                                <option value="hubnuti">Hubnutí</option>
                                <option value="udrzeni" selected>Udržení váhy</option>
                                <option value="svaly">Nabírání svalů</option>
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
    </div>