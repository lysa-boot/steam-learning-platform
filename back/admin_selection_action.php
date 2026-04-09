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
    <nav class="navbar navbar-expand-lg navbar-dark bg-<?php echo $navbarColor; ?>">
        <div class="container px-5">
            <p class="navbar-brand">
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
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <main class="d-flex justify-content-center align-items-center" style="min-height: 90vh;">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-8 col-lg-6">

                    <div class="card shadow p-4 text-center">
                        <?php
                        $mysqli = new mysqli('localhost', 'e22408872sql', '#VS2TxpP', 'e22408872_db1');
                        if ($mysqli->connect_errno) {
                            echo "Error: Problème de connexion à la BDD <br>";
                            echo "Errno: " . $mysqli->connect_errno . "<br>";
                            echo "Error: " . $mysqli->connect_error . "<br>";
                            exit();
                        }

                        mysqli_report(MYSQLI_REPORT_OFF);

                        if (!$mysqli->set_charset("utf8")) {
                            printf("Pb charset utf8 : %s \n", $mysqli->error);
                            exit();
                        }
                        session_start();

                        if (!isset($_SESSION['login']) ) { //A COMPLETER pour tester aussi le rôle...
                            //Si la session n'est pas ouverte, redirection vers la page du formulaire
                            if($_SESSION['login']!="gEstionnaire1@gmail.com"){
                                if(!isset($_SESSION['role'])){
                                    header("Location:../connexion/session.php");
                                }
                            } 
                        }

                        if (!empty($_POST["id_selection"])) {

                            if (!ctype_digit($_POST['id_selection'])) {
                                echo "veiller saisir un id qui existe dans la selection un entier";
                            } else {

                                $id = $_POST['id_selection'];

                                // Suppression dans t_rassemblemnt_rasmbl
                                $sql2 = "DELETE FROM t_rassemblemnt_rasmbl WHERE select_id=" . $id;
                                echo $sql2;

                                $result2 = $mysqli->query($sql2);

                                if ($result2 == false) {
                                    echo "Error: Requête échouée <br>";
                                    echo "Query: " . $sql2 . "<br>";
                                    echo "Errno: " . $mysqli->errno . "<br>";
                                    echo "Error: " . $mysqli->error . "<br>";
                                } else {
                                    echo "<br> suppression rassemblment réussit ! <br>";
                                }

                                // Suppression dans t_selection_slect
                                $sql3 = "DELETE FROM t_selection_slect WHERE select_id=" . $id . ";";
                                echo $sql3;

                                $result3 = $mysqli->query($sql3);

                                if ($result3 == false) {
                                    echo "Error: Requête échouée <br>";
                                    echo "Query: " . $sql3 . "<br>";
                                    echo "Errno: " . $mysqli->errno . "<br>";
                                    echo "Error: " . $mysqli->error . "<br>";
                                } else {
                                    echo "<br> suppression selection réussit ! <br>";
                                    echo "<a href='admin_selections.php' class='btn btn-primary'>Retour</a>";
                                    header("Location:admin_selections.php");

                                }
                            }
                        } else {
                            if (!empty($_POST["intitule"]) && !empty($_POST['Description'])) {

                                $pseudo = $_SESSION['login'];
                                $intitule = htmlspecialchars(addslashes($_POST['intitule']));
                                $description = htmlspecialchars(addslashes($_POST['Description']));
                            } else {
                                echo "il faut remplir tout les champs <br>";

                                if (empty($_POST["intitule"])) {
                                    echo "intitule <br>";
                                }
                                if (empty($_POST['Description'])) {
                                    echo "mot de passe <br>";
                                }

                                echo "<div class='mt-4'><a href='admin_selections.php' class='btn btn-primary'>Retour</a></div>";
                                exit();
                            }



                            $sql1 = "INSERT INTO t_selection_slect (cpt_pseudo ,select_intitule, select_texte,select_etat,selct_dateajout)
                         VALUES ('" . $pseudo . "' , '" . $intitule . "', '" . $description . "','D',NOW())";

                            echo $sql1;

                            $result4 = $mysqli->query($sql1);

                            if ($result4 == false) {
                                echo "Error: insertion échouée <br>";
                                echo "Query: " . $sql1 . "<br>";
                                echo "Errno: " . $mysqli->errno . "<br>";
                                echo "Error: " . $mysqli->error . "<br>";
                            } else {
                                echo "<br> insertion réussit ! <br>";
                                echo "<a href='admin_selections.php' class='btn btn-primary'>Retour pour visualiser la selection</a>";
                            }
                        } /* =========================
   FERMETURE
========================= */
                        $mysqli->close();
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </main>
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
</body>

</html>