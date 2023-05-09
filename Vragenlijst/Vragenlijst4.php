<?php
$voornamen = array("Ali1", "Ali2", "Ali3", "Ali4", "Ali5");

function Naam_search($naam, $namen_array) {
    $index = array_search(strtolower($naam), array_map('strtolower', $namen_array));
    return $index !== false ? $index : -1;
}

$naam = "Ali1";
$index = Naam_search($naam, $voornamen);
echo "De naam $naam staat op positie $index in de array.\n";

$naam = "Ali2";
$index = Naam_search($naam, $voornamen);
echo "De naam $naam staat op positie $index in de array.\n";

$naam = "Ali3";
$index = Naam_search($naam, $voornamen);
echo "De naam $naam staat op positie $index in de array.\n";

$naam = "Ali4";
$index = Naam_search($naam, $voornamen);
echo "De naam $naam staat op positie $index in de array.\n";

?>