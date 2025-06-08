<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <title>Nutriční kalkulačka | Fitness Center</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Kompletní nutriční kalkulačka, kde se dozvíte, kolik máte mít Váš denní příjem kaliríí a makroživin.">
  <meta name="keywords" content="kalkulačka, makroživiny, FitnessCenter"> 
  <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
  <link rel="icon" href="/~georgivrbsky/public/components/balloon-heart-fill.svg" type="image/svg">

</head>
<body>

<?php include __DIR__ . '/../../public/components/navbar.php'; ?>

<div class="kontejner">

<form id="nutricni-formular">

    <h1>Nutriční kalkulačka kalorií a makroživin</h1>

    <div class="input-skupina">
      <label for="vyska">Výška (cm)</label>
      <input type="number" id="vyska" required min="100" max="250">
    </div>

    <div class="input-skupina">
      <label for="hmotnost">Hmotnost (kg)</label>
      <input type="number" id="hmotnost" required min="30" max="300">
    </div>

    <div class="input-skupina">
      <label for="vek">Věk</label>
      <input type="number" id="vek" required min="10" max="100">
    </div>

    <div class="radek-selekty">

    <div class="input-skupina">
      <label for="pohlavi">Pohlaví</label>
      <select id="pohlavi" required>
        <option value="muz">Muž</option>
        <option value="zena">Žena</option>
      </select>
    </div>  

    <div class="input-skupina">
      <label for="cil">Cíl</label>
      <select id="cil" required>
        <option value="udrzeni">Udržení váhy</option>
        <option value="hubnuti">Hubnutí</option>
        <option value="nabirani">Nabírání svalů</option>
      </select>
    </div>

    <div class="input-skupina">
      <label for="aktivita">Životní styl</label>
      <select id="aktivita" required>
        <option value="sedavy">Sedavý</option>
        <option value="lehce">Lehce aktivní</option>
        <option value="stredne">Středně aktivní</option>
        <option value="velmi">Velmi aktivní</option>
      </select>
    </div>

    </div>



  <button type="submit" class="submit-tlacitko">Spočítat</button>

</form>

<div id="vysledky" style="display: none;">
  <h2>Výsledky</h2>
  <p><strong>Bazální metabolismus (BMR):</strong> <span id="bmr"></span> kcal</p>
  <p><strong>Celkový denní výdej (TDEE):</strong> <span id="tdee"></span> kcal</p>
  <p><strong>Doporučený kalorický příjem:</strong> <span id="kcal"></span> kcal</p>
  <p><strong>Bílkoviny:</strong> <span id="protein"></span> g</p>
  <p><strong>Tuky:</strong> <span id="tuk"></span> g</p>
  <p><strong>Sacharidy:</strong> <span id="sacharid"></span> g</p>
</div>

<a href="/~georgivrbsky/src/views/dashboard_page.php" class="back-link" style="margin-top: 50px;">
    <button class="back-button">Zpět</button>
</a>
</div>

<?php include __DIR__ . '/../../public/components/footer.html'; ?>

<script>
document.getElementById('nutricni-formular').addEventListener('submit', function(e) {
  e.preventDefault();

  const vyska = parseFloat(document.getElementById('vyska').value);
  const hmotnost = parseFloat(document.getElementById('hmotnost').value);
  const vek = parseInt(document.getElementById('vek').value);
  const pohlavi = document.getElementById('pohlavi').value;
  const cil = document.getElementById('cil').value;
  const aktivita = document.getElementById('aktivita').value;

  // BMR výpočet (Mifflin-St Jeor rovnice)
  let bmr;

  if (pohlavi === 'muz') {
    bmr = 10 * hmotnost + 6.25 * vyska - 5 * vek + 5;
  } else {
    bmr = 10 * hmotnost + 6.25 * vyska - 5 * vek - 161;
  }

  // Aktivita
  const aktivitaMap = {
    sedavy: 1.2,
    lehce: 1.375,
    stredne: 1.55,
    velmi: 1.725
  };

  //kalorie s bazalnim metabolizmem a aktivitou
  const tdee = bmr * aktivitaMap[aktivita];

  // Úprava podle cíle
  let cilFactor = 0;
  if (cil === 'hubnuti') cilFactor = -400;
  else if (cil === 'nabirani') cilFactor = +300;

  const kcal = Math.round(tdee + cilFactor);

  // Makra: 25% bílkoviny, 30% tuky, 40% sacharidy
  const protein = Math.round((kcal * 0.25) / 4);
  const tuk = Math.round((kcal * 0.30) / 9);
  const sacharid = Math.round((kcal * 0.40) / 4);

  // Výpis
  document.getElementById('bmr').textContent = Math.round(bmr);
  document.getElementById('tdee').textContent = Math.round(tdee);
  document.getElementById('kcal').textContent = kcal;
  document.getElementById('protein').textContent = protein;
  document.getElementById('tuk').textContent = tuk;
  document.getElementById('sacharid').textContent = sacharid;

  document.getElementById('vysledky').style.display = 'block';
});
</script>

</body>
</html>