<?php

function romanToInt($roman) {
    $result = 0;
    // Parcourt les chiffres romains de gauche à droite
    for ($i = 0; $i < strlen($roman); $i++) {
        $current = $roman[$i];
        // Vérifie si le chiffre courant est suivi d'un chiffre plus petit
        if ($i + 1 < strlen($roman)) {
            $next = $roman[$i + 1];
            // Si c'est le cas, on utilise la règle de soustraction
            if (($current == 'I' && ($next == 'V' || $next == 'X')) ||
                ($current == 'X' && ($next == 'L' || $next == 'C')) ||
                ($current == 'C' && ($next == 'D' || $next == 'M'))) {
                $result -= getValue($current);
            } else {
                $result += getValue($current);
            }
        } else {
            $result += getValue($current);
        }
    }
    return $result;
}

function getValue($chiffre) {
    // Retourne la valeur du chiffre en entier
    switch ($chiffre) {
        case 'I':
            return 1;
        case 'V':
            return 5;
        case 'X':
            return 10;
        case 'L':
            return 50;
        case 'C':
            return 100;
        case 'D':
            return 500;
        case 'M':
            return 1000;
        default:
            return 0;
    }
}

function intToRoman($int) {
    $result = '';
    // Parcourt les chiffres de la notation romaine de haut en bas
    $chiffres = array('M', 'D', 'C', 'L', 'X', 'V', 'I');
    $valeurs = array(1000, 500, 100, 50, 10, 5, 1);
    for ($i = 0; $i < count($chiffres); $i++) {
        // Ajoute le nombre de chiffres nécessaires
        while ($int >= $valeurs[$i]) {
            $result .= $chiffres[$i];
            $int -= $valeurs[$i];
        }
        // Vérifie si on peut utiliser la règle de soustraction
        if ($i % 2 == 0 && $int >= $valeurs[$i] - $valeurs[$i + 2]) {
            $result .= $chiffres[$i + 2] . $chiffres[$i];
            $int -= $valeurs[$i] - $valeurs[$i + 2];
        }
    }
    return $result;
}

function addRomanNumbers($a, $b) {
    // Convertit les nombres romains en entiers
    $intA = romanToInt($a);
    $intB = romanToInt($b);
    // Effectue l'addition
    $intResult = $intA + $intB;
    // Convertit le résultat en nombre romain
    $romanResult = intToRoman($intResult);
    return $romanResult;
}

echo addRomanNumbers('VII', 'XI'); // affiche : XVIII
