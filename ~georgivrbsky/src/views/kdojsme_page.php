<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kdo jsme</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
      color: #333;
    }

    header {
      background-color: #1e1e1e;
      color: white;
      padding: 2rem 1rem;
      text-align: center;
    }

    header h1 {
      margin: 0;
      font-size: 2.5rem;
    }

    .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 2rem 1rem;
    }

    .section {
      margin-bottom: 2rem;
    }

    .section h2 {
      color: #444;
      font-size: 1.8rem;
      margin-bottom: 0.5rem;
    }

    .section p {
      font-size: 1.1rem;
      line-height: 1.6;
    }

    .team {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 1.5rem;
    }

    .member {
      background-color: white;
      padding: 1rem;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      text-align: center;
    }

    .member img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 0.5rem;
    }

    .member h3 {
      margin: 0.3rem 0;
    }

    .member p {
      font-size: 0.95rem;
      color: #666;
    }
  </style>
</head>
<body>


  <div class="container">

    <section class="section">
      <h2>Náš příběh</h2>
      <p>
        Jsme tým nadšenců, kteří milují to, co dělají. Naše cesta začala v roce 2020 s jednoduchým cílem: tvořit smysluplné projekty, které lidem pomáhají a inspirují.
      </p>
    </section>

    <section class="section">
      <h2>Naše hodnoty</h2>
      <p>
        Věříme v poctivost, kreativitu a otevřenou komunikaci. Každý projekt bereme jako výzvu a příležitost k růstu — pro nás i pro naše klienty.
      </p>
    </section>

    <section class="section">
      <h2>Náš tým</h2>
      <div class="team">
        <div class="member">
          <img src="https://via.placeholder.com/80" alt="Profil">
          <h3>Jana Nováková</h3>
          <p>Zakladatelka & CEO</p>
        </div>
        <div class="member">
          <img src="https://via.placeholder.com/80" alt="Profil">
          <h3>Petr Svoboda</h3>
          <p>Vývojář</p>
        </div>
        <div class="member">
          <img src="https://via.placeholder.com/80" alt="Profil">
          <h3>Lenka Dvořáková</h3>
          <p>Designérka</p>
        </div>
      </div>
    </section>

  </div>


</body>
</html>