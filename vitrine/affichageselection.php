<?php
// 1. CONNEXION ET CONFIGURATION
$mysqli = new mysqli('localhost', 'e22408872sql', '#VS2TxpP', 'e22408872_db1');

if ($mysqli->connect_errno) {
    echo "Error: Problème de connexion à la BDD \n";
    exit();
}

$mysqli->set_charset("utf8");
mysqli_report(MYSQLI_REPORT_OFF);

// 2. RÉCUPÉRATION DES INFOS DE PRÉSENTATION (FOOTER)
$requete = "SELECT pres_texte, pres_nomstruct, pres_logo, pres_adresse, pres_tel, pres_email, pres_horaire FROM t_presentation_pres LIMIT 1;";
$result_pres = $mysqli->query($requete);
$presentation = $result_pres->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Compass STEAM - Détails</title>
    <link rel="icon" type="image/png" href="../assets/Page 11.png" />
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background:#4513DD;">
        <div class="container px-5">
            <a class="navbar-brand" href="../index.php">
                <img src="../assets/Page 11.png" alt="Logo" style="width: 30px; height: 30px; object-fit: cover;"> Compass
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../inscription/inscription.php">Inscription</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="selection.php" id="navDrop" role="button" data-bs-toggle="dropdown">Sélections</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="selection.php">Selection</a></li>
                            <li><a class="dropdown-item" href="select.php">Select</a></li>
                            <li><a class="dropdown-item" href="sel.php">Sel</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 overflow-hidden">
                    <div class="card-header border-0 py-3" style="background: linear-gradient(45deg, #4513DD, #6f42c1);">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-white fw-light">Détails de l'élément</h5>

                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">

                        <?php
                        if (isset($_GET['elm_id']) && isset($_GET['sel_id'])) {

                            if (!ctype_digit($_GET['elm_id']) || !ctype_digit($_GET['sel_id'])) {
                                echo "
                                <div style='text-align:center; margin-top:50px;'>
                                    <h2>Paramètres invalides </h2>
                                    <img src='../assets/pirate.png' alt='Pirate' style='max-width:300px; display:block; margin:auto;'>
                                    <br>
                                    <a href='selection.php' class='btn btn-primary'>
                                        Retour aux sélections
                                    </a>
                                </div>
                                ";
                                exit();
                            } else {
                                $sid = $_GET['sel_id'];
                                $eid = $_GET['elm_id'];
                            }
                            $sql_sel = "SELECT select_intitule FROM t_selection_slect WHERE select_id = $sid";
                            $res_sel = $mysqli->query($sql_sel);

                            $nom_selection = "";
                            if ($res_sel == false) {
                                echo "Error: La requête a echoué \n";
                                echo "Errno: " . $mysqli->errno . "\n";
                                echo "Error: " . $mysqli->error . "\n";
                                exit();
                            } else {
                                if ($row_sel = $res_sel->fetch_assoc()) {
                                    $nom_selection = $row_sel['select_intitule'];
                                } else {
                                    $nom_selection = "Il n’y a pas de sélection pour le moment.";
                                }
                            }


                            $sql1 = "SELECT elm_intitule, elm_descrition, elm_dateajout, elm_fichierimg 
                            FROM t_element_elm 
                            JOIN t_rassemblemnt_rasmbl USING (elm_id) 
                            WHERE elm_etat='A' AND select_id = '$sid' AND elm_id = '$eid' ";

                            $result1 = $mysqli->query($sql1);
                            if ($result1 == false) {
                                echo "Error: La requête a echoué\n";
                                echo "Errno: " . $mysqli->errno . "\n";
                                echo "Error: " . $mysqli->error . "\n";
                                exit();
                            } else {
                                if ($result1->num_rows > 0) {
                                    $elm = $result1->fetch_assoc();
                        ?>
                                    <div class="row g-5 align-items-start">
                                        <div class="col-md-5">
                                            <div class="position-relative overflow-hidden rounded-4 shadow" ;">
                                                <img src="../ressource/<?php echo $elm['elm_fichierimg']; ?>"
                                                    class="img-fluid w-100 img-hover-zoom"
                                                    style="max-height: 500px; object-fit: cover;"
                                                    alt="<?php echo $elm['elm_intitule']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-7">
                                            <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb mb-2">
                                                    <li class="breadcrumb-item small text-uppercase"><a href="selction.php" class="text-decoration-none"><?php echo ($nom_selection) ?></a></li>

                                                </ol>
                                            </nav>

                                            <h1 class="display-6 fw-bold text-dark mb-3"><?php echo $elm['elm_intitule']; ?></h1>

                                            <div class="d-flex align-items-center mb-4">
                                                <div class="vr me-3" style="width: 4px; background-color: #4513DD; opacity: 1; border-radius: 2px;"></div>
                                                <div class="text-muted small">
                                                    <i class="bi bi-clock-history me-1"></i> Publié le <strong><?php echo $elm['elm_dateajout']; ?></strong>
                                                </div>
                                            </div>

                                            <div class="description-container mb-5">
                                                <h6 class="fw-bold text-uppercase small text-primary letter-spacing-1 mb-3">À propos de cet élément</h6>
                                                <p class="text-secondary lh-lg" style="text-align: justify; font-size: 1.05rem;">
                                                    <?php echo $elm['elm_descrition']; ?>
                                                </p>
                                            </div>

                                            <div class="d-flex gap-2 pt-3 border-top mt-auto">
                                                <?php
                                                // Précédent
                                                $sql_prec = "SELECT elm_id FROM t_rassemblemnt_rasmbl WHERE select_id=$sid AND elm_id < $eid ORDER BY elm_id DESC LIMIT 1";
                                                $res_prec = $mysqli->query($sql_prec);
                                                if ($res_prec == false) {
                                                    echo "Error: La requête a echoué\n";
                                                    echo "Errno: " . $mysqli->errno . "\n";
                                                    echo "Error: " . $mysqli->error . "\n";
                                                    exit();
                                                } else {
                                                    if ($res_prec->num_rows == 1) {
                                                        $prev = $res_prec->fetch_assoc();
                                                        echo '<a href="affichageselection.php?sel_id=' . $sid . '&elm_id=' . $prev['elm_id'] . '" class="btn btn-primary px-4 rounded-pill" style="background:#4513DD; border-color:#4513DD;">';
                                                        echo '<i class="bi bi-arrow-left-circle-fill me-2"></i> Précédent';
                                                        echo '</a>';
                                                    } else {
                                                        echo '<button class="btn btn-primary px-4 rounded-pill" style="background:#4513DD; border-color:#4513DD; opacity: 0.5;" disabled>';
                                                        echo '<i class="bi bi-arrow-left-circle me-2"></i> Précédent';
                                                        echo '</button>';
                                                    }
                                                }

                                                // Suivant
                                                $sql_suiv = "SELECT elm_id FROM t_rassemblemnt_rasmbl WHERE select_id=$sid AND elm_id > $eid ORDER BY elm_id ASC LIMIT 1";
                                                $res_suiv = $mysqli->query($sql_suiv);
                                                if ($res_suiv == false) {
                                                    echo "Error: La requête a echoué\n";
                                                    echo "Errno: " . $mysqli->errno . "\n";
                                                    echo "Error: " . $mysqli->error . "\n";
                                                    exit();
                                                } else {
                                                    if ($res_suiv->num_rows == 1) {
                                                        $next = $res_suiv->fetch_assoc();
                                                        echo '<a href="affichageselection.php?sel_id=' . $sid . '&elm_id=' . $next['elm_id'] . '" class="btn btn-primary px-4 rounded-pill" style="background:#4513DD; border-color:#4513DD;">';
                                                        echo 'Suivant <i class="bi bi-arrow-right-circle-fill ms-2"></i>';
                                                        echo '</a>';
                                                    } else {
                                                        echo '<button class="btn btn-primary px-4 rounded-pill" style="background:#4513DD; border-color:#4513DD; opacity: 0.5;" disabled>';
                                                        echo 'Suivant <i class="bi bi-arrow-right-circle ms-2"></i>';
                                                        echo '</button>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                } else {
                                    echo "
                                <div style='text-align:center; margin-top:50px;'>
                                    <h2>pas d'élement pour l'instant </h2>
                                    <img src='../assets/desole.png' alt='Pirate' style='max-width:300px; display:block; margin:auto;'>
                                    <br>
                                    <a href='selection.php' class='btn btn-primary'>
                                        Retour aux sélections
                                    </a>
                                </div>
                                ";
                                    exit();
                                }
                            }
                        }else{
                            echo "
                                <div style='text-align:center; margin-top:50px;'>
                                    <h2>url invalide </h2>
                                    <img src='../assets/pirate.png' alt='Pirate' style='max-width:300px; display:block; margin:auto;'>
                                    <br>
                                    <a href='selection.php' class='btn btn-primary'>
                                        Retour aux sélections
                                    </a>
                                </div>
                                ";

                        }
                        ?>
                    </div>

                    <div class="card-footer bg-light border-0 text-center py-3">
                        <a href="selection.php" class="text-muted small text-decoration-none hover-link">
                            <i class="bi bi-grid-3x3-gap-fill me-1"></i> Explorer toute la collection
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>
    <br>

    <footer class="py-5 bg-violet text-white mt-5">
        <div class="container text-center">
            <h5><?php echo $presentation['pres_nomstruct']; ?></h5>
            <p class="small mb-1"><?php echo $presentation['pres_email']; ?> | <?php echo $presentation['pres_tel']; ?></p>
            <p class="small text-muted"><?php echo $presentation['pres_adresse']; ?></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php $mysqli->close(); ?>