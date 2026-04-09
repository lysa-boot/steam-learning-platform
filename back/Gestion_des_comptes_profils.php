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
// Instruction à rajouter depuis PHP 8.1
mysqli_report(MYSQLI_REPORT_OFF);
session_start();

if (!isset($_SESSION['login']) ) { //A COMPLETER pour tester aussi le rôle...
    //Si la session n'est pas ouverte, redirection vers la page du formulaire
    if($_SESSION['login']!="gEstionnaire1@gmail.com"){
        if(!isset($_SESSION['role']) ){
            header("Location:../connexion/session.php");
        }
        
    } 
    
}
if ($_SESSION['role']=='R'){
    header("Location:../connexion/admin_accueil.php");
}

if (!isset($_SESSION['navbarColor'])) {
    $_SESSION['navbarColor'] = "primary"; // couleur par défaut
}

?>
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
<?php
/* Vérification ci-dessous à faire sur toutes les pages dont l'accès est
autorisé à un utilisateur connecté. */

?>

<?php
if ($_SESSION['role'] == 'A' || $_SESSION['login'] == "gEstionnaire1@gmail.com") {


    $sql = "SELECT * FROM  t_compt_cpt Left JOIN t_profil_pro USING (cpt_pseudo)";
    //echo ($sql);
    $resultat = $mysqli->query($sql);
    if ($resultat == false) {
        // La requête a echoué
        echo "Error: Problème d'accès à la base \n";
        exit();
    }
}
/* Code PHP permettant de souhaiter la bienvenue à l’utilisateur connecté et
d’afficher le détail de son profil. */
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
<style>
table tr td {
    transition: 0.2s;
}

table tr:hover td {
    background-color: #f1f1f1;
}
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-<?php echo $_SESSION['navbarColor']; ?>">
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
    <!-- Page Content-->



    <!-- CONTENU -->
    <div class="container flex-grow-1 mt-5">

        <div class="card shadow-lg border-0 rounded-4">

            <!-- HEADER -->
            <div class="card-header bg-<?php echo $_SESSION['navbarColor']; ?> text-white d-flex justify-content-between">
                <h4 class="mb-0">Gestion des comptes</h4>
                <span> Hey<b> <?php echo $_SESSION['login']; ?></b></span>
            </div>

            <!-- BODY -->
            <div class="card-body">

                <div class="mb-3 text-end">
                    <a href="../connexion/deconnection.php" class="btn btn-dark">Déconnexion</a>
                    <a href="../connexion/admin_accueil.php" class="btn btn-dark">admin_accueil</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover text-center align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>Pseudo</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Statut</th>
                                <th>Validation</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php while ($cpt = $resultat->fetch_assoc()) { ?>
                                <tr>
                                    <td><strong><?php echo $cpt['cpt_pseudo']; ?></strong></td>
                                    <td><?php echo $cpt['pro_nom']; ?></td>
                                    <td><?php echo $cpt['pro_prenom']; ?></td>

                                    <td>
                                        <?php if ($cpt['pro_statut'] == 'A' || $cpt['cpt_pseudo'] == "gEstionnaire1@gmail.com" ) { ?>
                                            <span class="badge bg-danger">Admin</span>
                                        <?php } else { ?>
                                            <span class="badge bg-success">Responsable</span>
                                        <?php } ?>
                                    </td>

                                    <td> 
                                        <?php if ($cpt['pro_valide'] == 'A' || $cpt['cpt_pseudo'] == "gEstionnaire1@gmail.com") { ?>
                                            <span class="badge bg-primary">Activé</span>
                                        <?php } else { ?>
                                            <span class="badge bg-warning text-dark">Desactivé</span>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <?php echo $cpt['pro_date']; ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
<br>
    <footer class="py-5 bg-<?php echo $_SESSION['navbarColor'] ?> text-white">
        <div class="container-fluid text-center">

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
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>
<?php $mysqli->close(); ?>