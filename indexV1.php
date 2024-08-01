<div class="container pt-4 pb-4">
    <form action="#" method="get">
        <div class="mb-3">
            <label class="form-label" for="montantDu">Montant dû :</label>
            <input class="form-control" type="number" id="montantDu" name="montantDu" step="0.01" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="montantDonne">Montant donnée :</label>
            <input class="form-control" type="number" id="montantDonne" name="montantDonne" step="0.01" required>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Calculer</button>
        </div>
    </form>
</div>

<?php
    const VALEURs = [50000, 20000, 10000, 5000, 2000, 1000, 500, 200, 100, 50, 20, 10, 5, 2, 1];

    $renduMonnaie = [];

if (isset($_GET['montantDu']) && isset($_GET['montantDonne'])) {
    $renduMonnaie = calculRendu($_GET['montantDu'], $_GET['montantDonne']);
}

// Switch de float a int a cause de la précision
function toCentimes(float $argentEnEuro) : int {
    return (int) ($argentEnEuro * 100);
}
//
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
    
        $monnaie = VALEURs[$index];
    
        if ($montantARendre >= $monnaie) {
    
            $montantARendre -= $monnaie;
    
            if (false === isset($rendu[$monnaie]) ) {
                $rendu[$monnaie] = 1;
            } else {
                $rendu[$monnaie]++;
            }
            // Permet de faire une deuxième passage
            continue;
        }
    
        $index ++;
    }
    
    return $rendu;
}

?>    
<div class="container">
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>Pièce/Billet (en €)</th>
                <th>Nb</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //                        key     =>     value
                foreach($renduMonnaie as $monnaie => $nombreDeMonnaieUtilise) {
                    echo "<tr><td>".toEuros($monnaie)."</td><td>$nombreDeMonnaieUtilise</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">