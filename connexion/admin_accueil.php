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
<?php
session_start();

if (!isset($_SESSION['login'])) { //A COMPLETER pour tester aussi le rôle...
    //Si la session n'est pas ouverte, redirection vers la page du formulaire*
    if( $_SESSION['login'] != "gEstionnaire1@gmail.com" ){
        if(!isset($_SESSION['role'])){
        header("Location:session.php");
    }

    }

    
}
?>
<?php
$sql = "SELECT * FROM  t_compt_cpt Left JOIN t_profil_pro USING (cpt_pseudo) where cpt_pseudo='" . $_SESSION['login'] . "'";
//echo ($sql);
$resultat = $mysqli->query($sql);
if ($resultat == false) {
    echo "Error: La requête a echoué \n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    echo "Error: Problème d'accès à la base \n";
    exit();
}

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
<?php

$navbarColor = "primary";

if (isset($_SESSION['role'])|| $_SESSION['login'] == "gEstionnaire1@gmail.com") {
    if ($_SESSION['role'] == 'A' || $_SESSION['login'] == "gEstionnaire1@gmail.com")  {
        $navbarColor = "danger";
          $_SESSION['navbarColor'] = "danger";

    } else {
        $navbarColor = "success";
        $_SESSION['navbarColor'] = "success";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="48x48" href="assets/Page 11.png" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-<?php echo $navbarColor; ?>">
        <div class="container px-5">
        <p class="navbar-brand" >
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

    <div class="flex-grow-1">
        <?php
        if ($_SESSION['role'] == 'A' || $_SESSION['login'] == "gEstionnaire1@gmail.com") {
        ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-9">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <!-- Header avec gradient -->
                <div class="card-header text-white text-center py-5 bg-<?php echo $navbarColor; ?>">

                    <div class="mb-3">
                        <i class="bi bi-person-circle" style="font-size: 60px;"></i>
                    </div>

                    <h2 class="fw-bold mb-1">
                        Bienvenue <?php echo $_SESSION['login']; ?>
                    </h2>

                    <p class="mb-0 opacity-75">Espace Administrateur</p>
                </div>

                <!-- Body -->
                <div class="card-body text-center py-5">

                    <h5 class="mb-3 text-secondary">
                        Vous avez accès à toutes les fonctionnalités de gestion.
                    </h5>

                    <p class="text-muted mb-4">
                        Gérez les utilisateurs, les contenus et les paramètres depuis votre tableau de bord.
                    </p>

                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        
                        <a href="../back/Gestion_des_comptes_profils.php" class="btn btn-outline-dark  px-4">
                           gestion des comptes et des profils
                        </a>
                        
                        <a href="../back/admin_selections.php" class="btn btn-outline-dark px-4">
                            Voir les sélections
                        </a>

                        <a href="../connexion/deconnection.php" class="btn btn-outline-danger px-4">
                            Déconnexion
                        </a>
                        
                     
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
        <?php

        } else {
        ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-9">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <!-- Header avec gradient -->
                <div class="card-header text-white text-center py-5 bg-<?php echo $navbarColor; ?>">

                    <div class="mb-3">
                        <i class="bi bi-person-circle" style="font-size: 60px;"></i>
                    </div>

                    <h2 class="fw-bold mb-1">
                        Bienvenue <?php echo $_SESSION['login']; ?>
                    </h2>

                    <p class="mb-0 opacity-75">Espace Administrateur</p>
                </div>

                <!-- Body -->
                <div class="card-body text-center py-5">

                    <h5 class="mb-3 text-secondary">
                        Vous avez accès à toutes les fonctionnalités de gestion.
                    </h5>

                    <p class="text-muted mb-4">
                        Gérez les utilisateurs, les contenus et les paramètres depuis votre tableau de bord.
                    </p>

                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        
                        
                        <a href="../back/admin_selections.php" class="btn btn-outline-dark px-4">
                            Gérez les sélections
                        </a>

                        <a href="../connexion/deconnection.php" class="btn btn-outline-danger px-4">
                            Déconnexion
                        </a>
                        
                     
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
        <?php


        }


        ?>
        <div class="container mt-5">
    <div class="card shadow-lg border-<?php echo $navbarColor; ?>">
        <div class="card-body position-relative">

            <!-- Bouton Déconnexion (haut droite) -->
            

            <?php $cpt = $resultat->fetch_assoc(); ?>

            <div class="row align-items-center mt-3">

                <!-- Photo (gauche) -->
                <div class="col-md-4 text-center">
                    <?php if ($cpt['pro_statut'] == 'A' || $cpt['cpt_pseudo']=="gEstionnaire1@gmail.com") { ?>
                        <img src="../assets/admin.png"
                            alt="Photo de profil"
                            class="img-fluid rounded-circle shadow"
                            style="width:150px; height:150px; object-fit:cover;">
                    <?php } else { ?>
                        <img src="../assets/responsable.png"
                            alt="Photo de profil"
                            class="img-fluid rounded-circle shadow"
                            style="width:150px; height:150px; object-fit:cover;">
                    <?php } ?>
                </div>

                <!-- Infos (droite) -->
                <div class="col-md-8">

                    <h4 class="mb-4 text-center text-md-start">Profil utilisateur</h4>

                    <p><strong>Pseudo :</strong> <?php echo $cpt['cpt_pseudo']; ?></p>
                    <p><strong>Nom :</strong> <?php if($cpt['cpt_pseudo']=="gEstionnaire1@gmail.com"){
                                                            echo "";
                                                        }else{   
                                                            echo $cpt['pro_nom'];
                                                        } ?></p>
                    <p><strong>Prénom :</strong> <?php if($cpt['cpt_pseudo']=="gEstionnaire1@gmail.com"){
                                                            echo "";
                                                        }else{echo $cpt['pro_prenom'];} ?></p>

                    <p>
                        <strong>Statut :</strong>
                        <span class="badge bg-<?php echo $navbarColor; ?>">
                            <?php if($cpt['cpt_pseudo']=="gEstionnaire1@gmail.com"){
                                                            echo "";
                                                        }else{echo $cpt['pro_statut'];} ?>
                        </span>
                    </p>

                    <p>
                        <strong>Validé :</strong>
                        <?php if ($cpt['pro_valide'] == 'A' || $cpt['cpt_pseudo']=="gEstionnaire1@gmail.com" ): ?>
                            <span class="badge bg-success">Activé</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Désactivé</span>
                        <?php endif; ?>
                    </p>

                </div>

            </div>

        </div>
    </div>
</div>
        <br>
        <!-- Footer-->
        <footer class="py-5 bg-<?php echo $navbarColor; ?> text-white">
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
            <br>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

</body>

</html>
<?php $mysqli->close(); ?>