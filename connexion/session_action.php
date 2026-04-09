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
                    <li class="nav-item"><a class="nav-link" href="../inscription/inscription.php">inscription</a></li>

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

                </div>

                <?php
                //Ouverture d'une session
                session_start();
                $mysqli = new mysqli('localhost', 'e22408872sql', '#VS2TxpP', 'e22408872_db1');
                if ($mysqli->connect_errno) {
                    // Affichage d'un message d'erreur
                    echo "Error: Problème de connexion à la BDD \n";
                    // Arrêt du chargement de la page
                    exit();
                }
                // Instruction à rajouter depuis PHP 8.1
                mysqli_report(MYSQLI_REPORT_OFF);
                /*Affectation dans des variables du pseudo/mot de passe s'ils existent,
affichage d'un message sinon*/
                if (!empty($_POST["pseudo"]) && !empty($_POST["mdp"])) {
                    $id = htmlspecialchars(($_POST['pseudo']));;
                    $motdepasse = htmlspecialchars(($_POST['mdp']));
                    // A COMPLETER...
                    // Connexion à la base MariaDB


                    $requete = "SELECT pres_logo FROM t_presentation_pres;";
                    $result = $mysqli->query($requete);
                    
                     

                    $sql = "SELECT * FROM  t_compt_cpt Left JOIN t_profil_pro USING (cpt_pseudo)  WHERE cpt_pseudo='" . $id . "' AND cpt_password=MD5('" . $motdepasse . "') 
   and (pro_valide='A' or cpt_pseudo='gEstionnaire1@gmail.com');";
                    //echo ($sql);

                    $resultat = $mysqli->query($sql);
                    if ($resultat == false) {
                        // La requête a echoué
                        echo "Error: Problème d'accès à la base \n";
                        exit();
                    } else {
                        $ligne = $resultat->fetch_assoc();
                        if ($resultat->num_rows == 1) {
                            echo "le compte il existe bien";

                            $_SESSION['login'] = $id;



                            $_SESSION['role'] = $ligne['pro_statut'];
                            header("Location:admin_accueil.php");
                        } else {
                            echo "<div class='alert alert-danger text-center'>
                  Pseudo ou mot de passe incorrect !
                  </div>";

                            echo "<div class='text-center'>
                  <a href='session.php' class='btn btn-primary'>Réessayer</a>
                  </div>";
                        }
                    }
                } else {
                    echo "remplire les champs !";
                    echo "<a href='session.php' class='btn btn-primary'>Réessayer</a>";
                    
                }
                ?>

                <!-- début du code HTML de la page -->

                <!-- suite du code HTML de la page -->



            </div>
        </div>
    </div>

    <footer class="py-5 bg-violet text-white">
        <div class="container text-center">

            <h5><?php $sql6 = "SELECT pres_texte,pres_nomstruct,pres_logo ,pres_adresse,pres_tel,pres_email,pres_horaire  FROM t_presentation_pres;";                                                 //la requette
                $result1 = $mysqli->query($sql6);
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