<?php
$mysqli = new mysqli('localhost', 'e22408872sql', '#VS2TxpP', 'e22408872_db1');
if ($mysqli->connect_errno) {
    // Affichage d'un message d'erreur
    echo "Error: Problème de connexion à la BDD \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    // Arrêt du chargement de la page
    exit();
}
// Instructions PHP à ajouter pour l'encodage utf8 du jeu de caractères
if (!$mysqli->set_charset("utf8")) {
    printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
    exit();
}
// Instruction à rajouter depuis PHP 8.1
mysqli_report(MYSQLI_REPORT_OFF);
?>

<!DOCTYPE html>
<!--
Application : Compass Stream
Créé par : Lysa Belkacem
Date de création : 12/03/2026
Description :
- Plateforme web dédiée à la robotique éducative, à la programmation et à l’innovation
- Propose différentes sections de formation
- À l’intérieur de chaque formation, l’utilisateur trouvera des éléments pédagogiques
  comme des explications, des ressources et des exemples
- Présentation de projets réalisés dans le domaine de la robotique
- Vitrine pour la présentation et la vente de matériel de robotique éducative
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Compass STEAM</title>
    <!-- Favicon-->
    <link rel="icon" type="image/png" sizes="48x48" href="assets/Page 11.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
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
                    <li class="nav-item"><a class="nav-link" href="../inscription/inscription.php">Inscription</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="selection.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sélections
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="selection.php">Selection complète</a></li>
                            <li><a class="dropdown-item" href="select.php">Select</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="sel.php">Sel</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Content-->
    <div class="container px-4 px-lg-5">
        <!-- Heading Row-->
        <div class="row gx-4 gx-lg-5 align-items-center my-5">
            <div class="col-lg-7">
                <div class="position-relative">

                    <?php
                    //SELECT select_intitule FROM t_selection_slect WHERE select_id=3;
                    //select elm_intitule,elm_descrition,elm_dateajout,elm_fichierimg from t_element_elm WHERE elm_id=18;
                    $requete = "SELECT pres_texte,pres_nomstruct,pres_logo ,pres_adresse,pres_tel,pres_email,pres_horaire  FROM t_presentation_pres;";                                                 //la requette
                    $result1 = $mysqli->query($requete);
                    if ($result1 == false) {
                        echo "Error: La requête a echoué \n";
                        echo "Errno: " . $mysqli->errno . "\n";
                        echo "Error: " . $mysqli->error . "\n";
                        exit();
                    } else {
                        if ($presentation = $result1->fetch_assoc()) {
                        }
                    }
                    //Ferme la connexion avec la base MariaDB

                    ?></p>
                </div>
            </div>
            <!-- Call to Action-->

            <div class="card bg-light my-5 py-4 shadow border-0">
    <div class="card-body">

        <div class="container">

            <?php
            if (!isset($_GET['elm_id']) || !isset($_GET['sel_id']) ||!ctype_digit($_GET['elm_id']) || !ctype_digit($_GET['sel_id']))  {
                echo ("<div class='alert alert-danger'>Paramètre manquant ou invalide.</div>");
                exit();
            }

            $sid = $_GET['sel_id'];
            $eid = $_GET['elm_id'];

            $sql1 = "SELECT elm_intitule,elm_descrition,elm_dateajout,elm_fichierimg 
            FROM t_element_elm 
            JOIN t_rassemblemnt_rasmbl USING (elm_id) 
            WHERE select_id=" . $sid . " AND elm_id=" . $eid." AND elm_etat='A'";

            $result1 = $mysqli->query($sql1);

            if ($result1 == false) {
                echo "Error: La requête a echoué\n";
                     echo "Errno: " . $mysqli->errno . "\n";
                 echo "Error: " . $mysqli->error . "\n";
                exit();
            } else {
                if ($elm = $result1->fetch_assoc()) {

                    echo "<div class='row g-4 align-items-start'>";

                    // IMAGE
                    echo "<div class='col-md-5'>";
                    echo "<img src='../ressource/" . $elm['elm_fichierimg'] . "' 
                          class='img-fluid rounded shadow-sm w-100' 
                          style='max-height:400px; object-fit:contain; background:#f8f9fa;'>";
                    echo "</div>";

                    // TEXTE
                    echo "<div class='col-md-7'>";

                    echo "<h2 class='fw-bold text-primary mb-3'>" . $elm['elm_intitule'] . "</h2>";

                    echo "<p class='text-secondary' style='text-align:justify;'>" . $elm['elm_descrition'] . "</p>";

                    echo "<p class='small text-muted mt-3'> " . $elm['elm_dateajout'] . "</p>";

                    echo "</div>";

                    echo "</div>";
                }
            }

            // ELEMENT SUIVANT
            $sql2 = "SELECT elm_id 
            FROM t_rassemblemnt_rasmbl 
            JOIN t_element_elm USING (elm_id) 
            WHERE select_id=" . $sid . " AND elm_id >" . $eid . " 
            ORDER BY elm_id ASC LIMIT 1";

            $resultat_suiv = $mysqli->query($sql2);

            echo "<div class='mt-4 text-center'>";

            if ($resultat_suiv == false) {
                echo "Error: La requête a echoué\n";
                                echo "Errno: " . $mysqli->errno . "\n";
                                echo "Error: " . $mysqli->error . "\n";
                exit();
            } else {
                if ($resultat_suiv->num_rows ==1) {
                    $next = $resultat_suiv->fetch_assoc();
                    $id_suivant = $next['elm_id'];

                    echo '<a href="affichageselect.php?sel_id=' . $sid . '&elm_id=' . $id_suivant . '" 
                    class="btn btn-primary px-4">
                    Élément suivant
                    </a>';
                } else {
                      echo '<button class="btn btn-secondary px-4" disabled>
                        Élément suivant
                        </button>';

                        // Message en dessous
                        echo "<div class='text-muted mt-2 small'>
                        Aucun élément suivant disponible.
                        </div>";
                }
            }

            echo "</div>";
            ?>

        </div>

    </div>
</div>
            <!-- Content Row-->

        </div>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-violet text-white">
        <div class="container text-center">

            <h5><?php echo $presentation['pres_nomstruct']; ?></h5>

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
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>

<?php $mysqli->close(); ?>