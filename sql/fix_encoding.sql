-- Corrige le mojibake (UTF-8 lu en CP866/CP1251 à l’import)
SET NAMES utf8mb4;

UPDATE concerts SET
  title = 'Soirée Soul & Gospel',
  venue = 'Salle Pleyel'
WHERE id = 1;

UPDATE concerts SET
  title = 'Voix Classiques — Récital',
  venue = 'Opéra de Lyon'
WHERE id = 2;

UPDATE tracks SET
  album = 'Lumière Intérieure'
WHERE album LIKE 'Lumi%' OR album LIKE '%rieure';
