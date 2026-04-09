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
    <link rel="icon" type="image/png" sizes="48x48" href="../assets/Page 11.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
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
            <!-- Call to Action-->

            <div class="card text-white bg-light my-5 py-4 text-center">
                <div class="card-body">
                <h3 style='background:black; color:white; padding:10px;'><b>selection</b></h3>
                <p class="text-white m-0">
                    <?php
                    $requete = "SELECT select_id,select_intitule, select_texte,cpt_pseudo 
            from t_selection_slect where select_etat='A' ";

                    $result1 = $mysqli->query($requete);

                    if ($result1 == false) {
                        echo "Error: La requête a echoué\n";
                        echo "Errno: " . $mysqli->errno . "\n";
                        echo "Error: " . $mysqli->error . "\n";
                        exit();
                    } else {
                        if($result1->num_rows == 0){
                            echo "<div style='padding:10px; background-color:#fff3cd; color:#856404; border:1px solidrgb(255, 32, 132); border-radius:5px;'>
                                    ⚠️ Pas d'actualité pour l'instant
                                  </div>";
                            exit();
                        }
                        echo "<div class='table-responsive'>";

                        echo "<table class='table table-hover align-middle shadow-sm'>";

                        echo "<thead class='table-dark'>";
                        echo "<tr>";
                        echo "<th>Intitulé</th>";
                        echo "<th>Description</th>";
                        echo "<th>Créé par</th>";
                        echo "<th>Action</th>";
                        echo "</tr>";
                        echo "</thead>";

                        echo "<tbody>";
                        while ($select = $result1->fetch_assoc()) {

                            $sql = "SELECT elm_id FROM t_rassemblemnt_rasmbl join t_element_elm using (elm_id)
                                    WHERE select_id=" . $select['select_id'] . " AND elm_id>0 AND elm_etat='A'";

                            $result3 = $mysqli->query($sql);

                            if ($result3 == false) {
                                echo "Error: La requête a echoué\n";
                                echo "Errno: " . $mysqli->errno . "\n";
                                echo "Error: " . $mysqli->error . "\n";
                            } else {
                                  echo "<tr>";

                                    echo "<td><strong>" . $select['select_intitule'] . "</strong></td>";

                                    echo "<td class='text-muted'>" . $select['select_texte'] . "</td>";

                                    echo "<td><span class='badge bg-secondary'>" . $select['cpt_pseudo'] . "</span></td>";

                                    echo "<td>";

                                if ($result3->num_rows > 0) {
                                    $row = $result3->fetch_assoc();
                                    $numero = $row['elm_id'];

                                    echo "<a href='affichageselection.php?sel_id=" . $select['select_id'] . "&elm_id=" . $numero . "' 
                                class='btn btn-sm btn-outline-primary'>
                                <i class='bi bi-arrow-right'></i>
                                </a>";
                                    } else {
                                    echo " <span class='text-muted'>Aucun élément</span>";
                                }

                                echo "</tr>";
                            }
                        }

                        echo "</table>";
                        echo "</div>";
                    }
                    ?>
                    </p>
                </div>
            </div>

        </div>
</div>
        <!-- Footer-->
        <footer class="py-5 bg-violet text-white">
            <div class="container text-center">

                <?php
                $requete = "SELECT pres_texte,pres_nomstruct,pres_logo ,pres_adresse,pres_tel,pres_email,pres_horaire  FROM t_presentation_pres;";                                                 //la requette
                $result1 = $mysqli->query($requete);
                if ($result1 == false) {
                    echo "Error: La requête a echoué \n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                    exit();
                } else {
                    $presentation = $result1->fetch_assoc();
                }
                ?>

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