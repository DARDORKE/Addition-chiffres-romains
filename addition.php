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
                ($current == 'C' && ($next == 'D' || $next == 'M')) ||
                ($current == 'I' && $next == 'X') ||
                ($current == 'X' && $next == 'C') ||
                ($current == 'C' && $next == 'M') ||
                ($current == 'X' && $next == 'L') ||
                ($current == 'I' && $next == 'V')) {
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
        case 'CM':
            return 900;
        case 'CD':
            return 400;
        case 'XC':
            return 90;
        case 'XL':
            return 40;
        case 'IX':
            return 9;
        case 'IV':
            return 4;
        default:
            return 0;
    }
}

function intToRoman($int) {
    $result = '';
    // Parcourt les chiffres de la notation romaine de haut en bas
    $chiffres = array('M', 'CM', 'D', 'CD', 'C', 'XC', 'L', 'XL', 'X', 'IX', 'V', 'IV', 'I');
    $valeurs = array(1000, 900, 500, 400, 100, 90, 50, 40, 10, 9, 5, 4, 1);
    for ($i = 0; $i < count($chiffres); $i++) {
        // Ajoute le nombre de chiffres nécessaires
        while ($int >= $valeurs[$i]) {
            $result .= $chiffres[$i];
            $int -= $valeurs[$i];
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
