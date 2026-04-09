<?php
$mysqli = new mysqli('localhost', 'e22408872sql', '#VS2TxpP', 'e22408872_db1');
if ($mysqli->connect_errno) {
    echo "Error: Problème de connexion à la BDD \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    exit();
}

if (!$mysqli->set_charset("utf8")) {
    printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
    exit();
}

$requete = "SELECT pres_texte,pres_nomstruct,pres_logo ,pres_adresse,pres_tel,pres_email,pres_horaire FROM t_presentation_pres;";
$result1 = $mysqli->query($requete);

if ($result1 == false) {
    echo "Error: La requête a echoué \n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit();
} else {
    $presentation = $result1->fetch_assoc();
}

mysqli_report(MYSQLI_REPORT_OFF);
session_start();
if (!isset($_SESSION['login']) ) { //A COMPLETER pour tester aussi le rôle...
    //Si la session n'est pas ouverte, redirection vers la page du formulaire
    if($_SESSION['login']!="gEstionnaire1@gmail.com"){
        if(!isset($_SESSION['role'])){
            header("Location:../connexion/session.php");
        }
    } 
}
if (!isset($_SESSION['navbarColor'])) {
    $_SESSION['navbarColor'] = "primary";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Compass STEAM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="icon" href="../assets/Page 11.png" />
    <link href="../css/styles.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f5f7fb;
        }

        /* Conteneur */
        .container {
            max-width: 1200px;
        }

        /* Card */
        .card {
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        /* Table */
        .table {
            margin-top: 20px;
            width: 100%;
            table-layout: fixed;
            border-radius: 10px;
            overflow: hidden;
        }

        /* Header */
        .table thead th {
            background-color: #0d6efd;
            color: white;
            text-align: center;
        }

        /* Cells */
        .table td {
            vertical-align: top;
            padding: 10px;
            word-wrap: break-word;
        }

        /* Columns sizing */
        .table td:nth-child(1) {
            width: 15%;
        }

        .table td:nth-child(2) {
            width: 25%;
        }

        .table td:nth-child(3) {
            width: 12%;
        }

        .table td:nth-child(4) {
            width: 15%;
        }

        .table td:nth-child(5) {
            width: 10%;
        }

        .table td:nth-child(6) {
            width: 23%;
        }

        /* Elements list */
        .table ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .table li {
            background: #0d6efd;
            color: white;
            padding: 4px 8px;
            margin: 2px;
            border-radius: 5px;
            display: inline-block;
            font-size: 12px;
        }

        /* Hover */
        .table tbody tr:hover {
            background-color: #eef3ff;
        }

        .desc-box {
            max-height: 120px;
            overflow: hidden;
            position: relative;
            padding: 12px 14px;
            border-radius: 12px;
            background: #ffffff;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            line-height: 1.5;
        }

        /* effet fade discret */
        .desc-box::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30px;

        }

        /* état ouvert */
        .desc-box.expanded {
            max-height: 500px;
        }

        /* bouton stylé */
        .read-more-btn {
            margin-top: 6px;
            font-size: 13px;
            font-weight: 500;
            color: #0d6efd;
            cursor: pointer;
            border: none;
            background: none;
            padding: 0;
            transition: 0.2s;
        }

        .read-more-btn:hover {
            color: #0a58ca;
            text-decoration: underline;
        }
    </style>

</head>
<script>
    function toggleDesc(id) {
        const box = document.getElementById("desc" + id);
        const btn = box.nextElementSibling;

        box.classList.toggle("expanded");

        if (box.classList.contains("expanded")) {
            btn.innerText = "Lire moins";
        } else {
            btn.innerText = "Lire plus";
        }
    }
</script>

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

    <div class="container my-5">
                        <div class="mb-3 text-end">
                    <a href="../connexion/deconnection.php" class="btn btn-dark">Déconnexion</a>
                    <a href="../connexion/admin_accueil.php" class="btn btn-dark">admin_accueil</a>
                </div>

<div class="card p-4 mb-4 shadow-sm">

    <h5 class="mb-4 text-primary">+ Ajouter une sélection</h5>

    <form action="admin_selection_action.php" method="POST">
        <div class="row g-3 align-items-center">

            <div class="col-md-3">
                <input type="text" name="intitule" class="form-control" placeholder="Intitulé" >
            </div>

            <div class="col-md-4">
                <textarea name="Description" class="form-control" placeholder="Description" rows="2" ></textarea>
            </div>

            <div class="col-md-2 d-grid">
                <button type="submit" name="add" class="btn btn-success">
                    + Ajouter
                </button>
            </div>

        </div>
    </form>

    <hr class="my-4">

    <!-- SUPPRESSION -->
    <h6 class="text-danger mb-3"> Supprimer une sélection</h6>

    <form method="POST" action="admin_selection_action.php">
        <div class="row g-3 align-items-center">

            <div class="col-md-3">
                <input type="text" name="id_selection" class="form-control" placeholder="ID sélection" >
            </div>

            <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-sm btn-danger">
            Supprimer <i class="bi bi-trash"></i>
                            </button>
    
            </div>

        </div>
    </form>

</div>
        <br>
        <div class="card p-4">

            <h3 class="text-center mb-4"><b>Selection</b></h3>

            <?php
            $requete = "SELECT select_id,select_intitule, select_texte,cpt_pseudo ,selct_dateajout,select_etat
                        from t_selection_slect";

            $result1 = $mysqli->query($requete);
            if ($result1 == false) {
                echo "Error: Requête échouée <br>";
                echo "Query: " . $requete . "<br>";
                echo "Errno: " . $mysqli->errno . "<br>";
                echo "Error: " . $mysqli->error . "<br>";
            } else {
                echo "<table class='table table-striped table-hover text-center'>";
                echo "<thead class='table-".$_SESSION['navbarColor']."'>
        <tr>
            <th style='width:60px;'>ID</th>
            <th>Titre</th>
            <th style='width:300px;'>Description</th>
            <th>Auteur</th>
            <th>Date</th>
            <th>État</th>
            <th>Éléments</th>
            <th>Supprimer</th>
        </tr>
      </thead>";

                echo "<tbody>";

                while ($select = $result1->fetch_assoc()) {

                    $sql = "SELECT elm_id , elm_intitule FROM t_element_elm 
                            JOIN t_rassemblemnt_rasmbl USING (elm_id) 
                            WHERE select_id=" . $select['select_id'];

                    $result3 = $mysqli->query($sql);
                    if ($result3 == false) {
                        echo "Error: Requête échouée <br>";
                        echo "Query: " . $sql . "<br>";
                        echo "Errno: " . $mysqli->errno . "<br>";
                        echo "Error: " . $mysqli->error . "<br>";
                    }

                    echo "<tr>";

                    
                    echo "<td><span class='badge bg-secondary'>" . $select['select_id'] . "</span></td>";

                    echo "<td><b>" . $select['select_intitule'] . "</b></td>";

                    
                    echo "<td><div class='desc-box' id='desc" . $select['select_id'] . "'> " . $select['select_texte'] . "
                            </div><button class='btn btn-sm btn-outline-primary mt-1' onclick='toggleDesc(" . $select['select_id'] . ")'>
                            Lire plus </button></td>";

                    
                    echo "<td>" . $select['cpt_pseudo'] . "</td>";

                    echo "<td>" . $select['selct_dateajout'] . "</td>";

                    echo "<td>";
                    if ($select['select_etat'] == 'A') {
                        echo "<span class='badge bg-success'>Activée</span>";
                    } else {
                        echo "<span class='badge bg-warning text-dark'>Désactivée</span>";
                    }
                    echo "</td>";

                    echo "<td><ul class='mb-0 text-start'>";
                    while ($elm = $result3->fetch_assoc()) {
                        echo "<li>" . $elm['elm_intitule'] . "</li>";
                    }
                    echo "</ul></td>";?>
                    <td>
                        <form method="POST" action="admin_selection_action.php">
                            <input type="hidden" name="id_selection" value="<?php echo $select['select_id'] ?>">

                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                   <?php  echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            }
            ?>

        </div>

    </div>

    <footer class="py-5 bg-<?php echo $_SESSION['navbarColor']; ?> text-white text-center">
        <h5><?php echo $presentation['pres_nomstruct']; ?></h5>

        <p>
            <?php echo $presentation['pres_email']; ?> |
            <?php echo $presentation['pres_tel']; ?>
        </p>

        <p><?php echo $presentation['pres_horaire']; ?></p>
        <p><?php echo $presentation['pres_adresse']; ?></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php $mysqli->close(); ?>