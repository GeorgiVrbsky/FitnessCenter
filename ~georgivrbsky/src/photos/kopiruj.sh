#!/bin/bash

source_file_muzi="petr_novak.jpg"
source_file_zeny="lucie_kovarova.jpg"

# Pole pro muže (jméno_příjmení)
muzi=(
  "martin_dvorak"
  "jan_kral"
  "roman_vlcek"
  "david_pokorny"
  "tomas_sedlak"
  "radek_jelinek"
  "jakub_holy"
  "michal_prochazka"
  "ondrej_maly"
  "adam_burian"
  "milan_simek"
  "filip_bartos"
  "vaclav_navratil"
)

# Pole pro ženy (jméno_příjmení)
zeny=(
  "eva_svobodova"
  "tereza_benesova"
  "alena_urbanova"
  "simona_hruba"
  "klara_zelena"
  "veronika_maresova"
  "barbora_nemcova"
  "katerina_blahova"
  "nikola_vitkova"
  "irena_vankova"
  "lenka_korinkova"
  "hana_ruzickova"
  "zuzana_janouskova"
)

# Kopírování pro muže
echo "Kopíruji soubor pro muže..."
for name in "${muzi[@]}"; do
  cp "$source_file_muzi" "${name}.jpg"
done

# Kopírování pro ženy
echo "Kopíruji soubor pro ženy..."
for name in "${zeny[@]}"; do
  cp "$source_file_zeny" "${name}.jpg"
done

echo "Hotovo!"
