<?php
const VALEURS = [50000, 20000, 10000, 5000, 2000, 1000, 500, 200, 100, 50, 20, 10, 5, 2, 1];

$renduMonnaie = [];
$erreur = '';
$montantEgal = '';

if (isset($_POST['montantDu']) && isset($_POST['montantDonne'])) {
        $montantDu = (float)$_POST['montantDu'];
        $montantDonne = (float)$_POST['montantDonne'];

        // Message d'erreur si le montant donné est inférieur au montant dû
        if ($montantDonne < $montantDu) {
            $erreur = 'Le montant donné ne peut pas être inférieur au montant dû.';
        }
        
        // Vérif si montant donné = montant dû
        if ($montantDonne == $montantDu) {
            $montantEgal = 'Le montant donné est juste, rien à rendre.';
        } else {
            $renduMonnaie = calculRendu($montantDu, $montantDonne);
        }
}

// Switch de float a int a cause de la précision
function toCentimes(float $argentEnEuro) : int {
    return (int) ($argentEnEuro * 100);
}

function toEuros(int $argentEnCentimes) : float {
    return round($argentEnCentimes / 100, 2);
}

function calculRendu(float $prix, float $monnaieDonnee): array {

    // Initialisation de l'index pour le tableau de monnaies
    $index = 0;

    // Calcule du montant à rendre
    $montantARendre = toCentimes($monnaieDonnee) - toCentimes($prix);
    
    // Tableau de la monnaie a rendre
    $rendu = [];
    
    while ($montantARendre > 0) {
    
        $monnaie = VALEURS[$index];
    
        if ($montantARendre >= $monnaie) {
    
            $montantARendre -= $monnaie;
    
            if (false === isset($rendu[$monnaie]) ) {
                $rendu[$monnaie] = 1;
            } else {
                $rendu[$monnaie]++;
            }
            // Permet de faire une deuxième passage si la monnaie est sortie une fois
            continue;
        }
        $index ++;
    }
    return $rendu;
}
?>