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
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background:#4513DD;">
        <div class="container px-5">
            <a class="navbar-brand" href="index.php">
                <img class="img-fluid rounded mb-4 mb-lg-0" src="assets/Page 11.png" alt="Fond" style="width: 30px; height: 30px; object-fit: cover;">
                Compass
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="inscription/inscription.php">inscription</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="vitrine/slection.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sélections
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="vitrine/selection.php">Selection complète</a></li>
                            <li><a class="dropdown-item" href="vitrine/select.php">Select</a></li>
                            <li><a class="dropdown-item" href="vitrine/sel.php">Sel</a></li>
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
                    $requete = "SELECT pres_texte,pres_nomstruct,pres_logo ,pres_adresse,pres_tel,pres_email,pres_horaire  FROM t_presentation_pres;";                                                 //la requette
                    $result1 = $mysqli->query($requete);
                    if ($result1 == false) {
                        echo "Error: La requête a echoué \n";
                        echo "Errno: " . $mysqli->errno . "\n";
                        echo "Error: " . $mysqli->error . "\n";
                        exit();
                    } else {
                        if ($presentation = $result1->fetch_assoc()) {
                            echo "<img class='img-fluid rounded mb-4 mb-lg-0' src='" . $presentation['pres_logo'] . "'alt='Fond'
                    style='width: 900px; height: 300px; object-fit: cover;'>

                            
                        </div>
                    </div>
                <div class='col-lg-5'>";
                            echo "<div class='bg-light p-4 rounded'>";
                            echo "<h1 class='font-weight-light'>" . $presentation['pres_nomstruct'] . "</h1> ";
                            //echo($result1->num_rows); //Donne le bon nombre de lignes récupérées
                            echo "<p>" . $presentation['pres_texte'] . "</p>";
                            echo "</div>";
                        }
                    }
                    //Ferme la connexion avec la base MariaDB

                    ?></p>
                </div>
            </div>
            <!-- Call to Action-->

            <div class="card text-white bg-light my-5 py-4 text-center">
                <div class="card-body">
                    <?php
                    $requete = "SELECT count(new_id) as nbacttotale ,(count(new_id)-5) as nbactcacher , (5) as nbactenligne FROM t_news_new;";                                                 //la requette
                    $result1 = $mysqli->query($requete);                                 //recuperer le resultaat de la requette
                    if ($result1 == false)  //Erreur lors de l’exécution de la requête
                    { // La requête a echoué
                        echo "Error: La requête a echoué \n";
                        echo "Errno: " . $mysqli->errno . "\n";
                        echo "Error: " . $mysqli->error . "\n";
                        exit();
                    } else {
                        echo "<h3 style='background:black; color:withe; padding:10px;'><b>Dernières actualités</b></h3>";
                        echo "<div class='d-flex justify-content-center gap-3'>";
                        echo "<div class='d-flex gap-3'>";
                        while ($nb_actualite = $result1->fetch_assoc()) {
                            echo "<button type='button' class='btn btn-dark btn-lg d-flex align-items-center gap-2'>
                    <img src='./assets/news.svg' width='24' height='24'> "
                                . $nb_actualite['nbacttotale'] . "</button>";
                            echo "<button type='button' class='btn btn-dark btn-lg d-flex align-items-center gap-2'>
                    <img src='./assets/notview.svg' width='24' height='24'> "
                                . $nb_actualite['nbactcacher'] . "</button>";
                            echo "<button type='button' class='btn btn-dark btn-lg d-flex align-items-center gap-2'>
                    <img src='./assets/showed.svg' width='24' height='24'> "
                                . $nb_actualite['nbactenligne'] . "</button>";
                        }
                        echo "</div>";
                        echo "</div>";
                    }
                    //Ferme la connexion avec la base MariaDB

                    ?>

                    <p class="text-white m-0">
                        <?php
                        $requete = "SELECT new_titre,cpt_pseudo,new_datepub,new_texte from t_news_new JOIN t_compt_cpt using(cpt_pseudo)Where new_etat='A' ORDER by new_datepub DESC limit 5;;";
                        //Affichage de la requête préparée
                        $result1 = $mysqli->query($requete);
                        if ($result1 == false) //Erreur lors de l’exécution de la requête
                        { // La requête a echoué
                            echo "Error: La requête a echoué \n";
                            echo "Errno: " . $mysqli->errno . "\n";
                            echo "Error: " . $mysqli->error . "\n";
                            exit();
                        } else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
                        {
                            if($result1->num_rows == 0){
                                echo "<div style='padding:10px; background-color:#fff3cd; color:#856404; border:1px solid #ffeeba; border-radius:5px;'>
                                        ⚠️ Pas d'actualité pour l'instant
                                      </div>";
                                exit();
                            }
                        
                            echo "<div class='table-responsive mt-3'>";
                            echo "<table class='table table-hover table-striped align-middle'>";
                            echo "<thead class='table-dark'>";
                            echo "<tr>";
                            echo "<th>Titre</th>";
                            echo "<th>Contenu</th>";
                            echo "<th>Auteur</th>";
                            echo "<th>Date</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            
                            
                            while ($actu = $result1->fetch_assoc()) {
                                
                                    echo "<tr>";

                                    echo "<td><strong>" . $actu['new_titre'] . "</strong></td>";
    
                                    echo "<td>" . substr($actu['new_texte'], 0, 80) . "...</td>";
    
                                    echo "<td><span class='badge bg-warning'>" . $actu['cpt_pseudo'] . "</span></td>";
    
                                    echo "<td><small class='text-muted'>" . $actu['new_datepub'] . "</small></td>";
    
                                    echo "</tr>";


                            }

                            echo "</tbody>";
                            echo "</table>";
                            echo "</div>";
                        }
                        ?>
                    </p>
                </div>
            </div>
            <!-- Content Row-->

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