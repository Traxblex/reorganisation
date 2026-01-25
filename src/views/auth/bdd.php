<?php
try {
       $bddPDO = new PDO(
  'mysql:host=localhost;port=3306;dbname=sport;charset=utf8',
  'root',
  ''
);
        $bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>