<?php
$mysqli = new mysqli('localhost', 'e22408872sql', '#VS2TxpP', 'e22408872_db1');

if ($mysqli->connect_errno) {
    echo "Erreur connexion BDD";
    exit();
}

$mysqli->set_charset("utf8");
mysqli_report(MYSQLI_REPORT_OFF);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion - Compass</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ton CSS -->
    <link href="../css/styles.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background:#4513DD;">
    <div class="container px-5">
        <a class="navbar-brand" href="../index.php">
            <img class="img-fluid rounded mb-4 mb-lg-0" src="../assets/Page 11.png" alt="Fond" style="width: 30px; height: 30px; object-fit: cover;"> 
            Compass
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="../index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="inscription.php">inscription</a></li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="../vitrine/slection.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sélections
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../vitrine/selection.php">Selection complète</a></li>
                        <li><a class="dropdown-item" href="../vitrine/select.php">Select</a></li>
                        <li><a class="dropdown-item" href="../vitrine/sel.php">Sel</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <!-- LOGIN -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">

        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow p-4">

                <!-- LOGO -->
                <div class="text-center mb-4">
                    <?php
                    $requete = "SELECT pres_logo FROM t_presentation_pres;";
                    $result = $mysqli->query($requete);

                    if ($result && $presentation = $result->fetch_assoc()) {
                        echo "<img class='img-fluid rounded mb-4 mb-lg-0' src='../" . $presentation['pres_logo'] . "'alt='Fond'
                    style='width: 900px; height: 300px; object-fit: cover;'>";
                    }
                    ?>
                </div>

                <!-- FORMULAIRE -->
                <form action="action.php" method="POST">

                    <div class="row">

                        <!-- NOM / PRENOM -->
                        <div class="col-md-6 mb-2">
                            <input type="text" name="nom" class="form-control" placeholder="Nom" >
                        </div>

                        <div class="col-md-6 mb-2">
                            <input type="text" name="prenom" class="form-control" placeholder="Prénom" >
                        </div>

                        <!-- EMAIL -->
                        <div class="col-md-6 mb-2">
                            <input type="email" name="pseudo" class="form-control" placeholder="Email" >
                        </div>

                        <!-- CODE -->
                        <div class="col-md-6 mb-2">
                            <input type="password" name="code" class="form-control" placeholder="Code inscription" >
                        </div>

                        <!-- 
                        VALIDITE
                        <div class="col-md-6 mb-2">
                            <select name="pro_valide" class="form-select">
                                <option value="A">Actif</option>
                                <option value="I">Inactif</option>
                                <option value="S">Suspendu</option>
                            </select>
                        </div>

                        
                        

                        <div class="col-md-6 mb-2 d-flex align-items-center">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="statut" value="A" required>
                                <label class="form-check-label">Admin</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="statut" value="R">
                                <label class="form-check-label">Responsable</label>
                            </div>
                        </div>

                         PASSWORD -->
                        <div class="col-md-6 mb-2">
                            <input type="password" name="password" class="form-control" placeholder="Mot de passe" >
                        </div>

                        <div class="col-md-6 mb-2">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirmer le mot de passe" >
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3">
                        S'inscrire
                    </button>

                </form>
                <!-- LIENS -->
                <div class="text-center mt-3">
                    <p>Vous avez de compte ? <a href="../connexion/session.php">se connecter</a></p>
                    
                </div>

            </div>
        </div>
    </div>

    <footer class="py-5 bg-violet text-white">
        <div class="container text-center">

            <h5><?php $requete = "SELECT pres_texte,pres_nomstruct,pres_logo ,pres_adresse,pres_tel,pres_email,pres_horaire  FROM t_presentation_pres;";                                                 //la requette
                $result1 = $mysqli->query($requete);
                if ($result1 == false) {
                    echo "Error: La requête a echoué \n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                    exit();
                } else {
                    if ($presentation = $result1->fetch_assoc()) {
                        echo $presentation['pres_nomstruct'];
                    }
                } ?></h5>

            <p>
                <?php echo $presentation['pres_email']; ?> |
                <?php echo $presentation['pres_tel']; ?>
            </p>

            <p>
                <?php echo $presentation['pres_horaire']; ?>
            </p>

            <p>
                <?php echo $presentation['pres_adresse']; ?>
            </p>

        </div>
    </footer>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php $mysqli->close(); ?>