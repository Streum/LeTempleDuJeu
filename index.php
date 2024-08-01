<?php include 'monnayeur.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Temple du Jeu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container pt-4 pb-4">
        <h1 class="text-center pt-4">Calcul de rendu monnaie</h1>
        <form action="#" method="POST">
            <div class="mb-3">
                <label class="form-label" for="montantDu">Prix du jeu :</label>
                <input class="form-control" type="number" id="montantDu" name="montantDu" step="0.01" min="0" required
                    value="<?php echo isset($_POST['montantDu']) ? htmlspecialchars($_POST['montantDu']) : ''; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label" for="montantDonne">Montant reçu :</label>
                <input class="form-control" type="number" id="montantDonne" name="montantDonne" step="0.01" min="0" required
                    value="<?php echo isset($_POST['montantDonne']) ? htmlspecialchars($_POST['montantDonne']) : ''; ?>">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Calculer</button>
            </div>
        </form>
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Pièce/Billet (en €)</th>
                    <th>Nb</th>
                </tr>
            </thead>
            
            <tbody>
                <?php if ($erreur): ?>
                    <tr>
                        <td colspan="2" class="text-center"><?php echo $erreur; ?></td>
                    </tr>
                <?php elseif ($montantEgal): ?>
                    <tr>
                        <td colspan="2" class="text-center"><?php echo $montantEgal; ?></td>
                    </tr>  
                <?php else: ?> 
                    <?php foreach($renduMonnaie as $monnaie => $nombreDeMonnaieUtilise): ?>
                        <tr>
                            <td>
                                <?php echo toEuros($monnaie); ?>
                            </td>
                            <td>
                                <?php echo $nombreDeMonnaieUtilise; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

            <tfoot>
                <?php if (isset($_POST['montantDu']) && isset($_POST['montantDonne'])): ?>
                    <tr>
                        <th>Total : <?php echo $montantDonne - $montantDu ."€"; ?></th>
                    </tr>
                <?php endif; ?>
            </tfoot>
        </table>
    </div>
</body>
</html>