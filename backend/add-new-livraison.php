<?php require_once('./includes/header.php'); ?>
<script>
    function numb(inputtxt) {
        var numbers = /^[-+]?[0-9]+$/;
        if (inputtxt.value.match(numbers)) {
            return true;
        } else {
            alert('Prière de saisir uniquement des nombres');
            return false;
        }
    }

    function lett(inputtxt) {
        var letters = /^[A-Za-z\s]+$/;
        if (inputtxt.value.match(letters)) {
            return true;
        } else {
            alert('Prière de saisir uniquement des lettres');
            return false;
        }
    }
</script>

<body class="nav-fixed">
    <?php require_once('./includes/top-navbar.php'); ?>

    <!--Side Nav-->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php
            $curr_page = basename(__FILE__);
            require_once("./includes/left-sidebar.php");
            ?>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
                    <div class="container-fluid">
                        <div class="page-header-content">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="edit-3"></i></div>
                                <span>Ajouter Livraison</span>
                            </h1>
                        </div>
                    </div>
                </div>



                <?php
                if (isset($_POST['create'])) {
                    $liv_idCommande = $_POST['liv-idCommande'];
                    $liv_nomLivreur = $_POST['liv-nomLivreur'];
                    $liv_date = $_POST['liv-date'];
                    $liv_etat = $_POST['liv-etat'];


                    $sql = "INSERT INTO livraisons (idCommande,nomLivreur,date,etat) values (:idCommande, :nomLivreur,:date,:etat) ";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([

                        ':idCommande' => $liv_idCommande,
                        ':nomLivreur' => $liv_nomLivreur,
                        ':date' => $liv_date,
                        ':etat' => $liv_etat

                    ]);
                    header("Location: Livraison.php");
                }


                ?>



                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">Ajouter une Livraison</div>
                        <div class="card-body">

                            <?php
                            if (isset($_POST['update'])) {
                                $idLivraison = $_POST['liv-id'];

                                $idCommande = $liv['liv-idCommande'];
                                $nomLivreur = $liv['liv-nomLivreur'];
                                $date = $liv['liv-date'];
                                $etat = $liv['liv-etat'];
                                $sql = "UPDATE livraisons SET idCommande='$idCommande',nomLivreur='$nomLivreur',date='$date',etat='$etat' WHERE idLivraison='$idLivraison' ";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute();
                                header("Location: Livraison.php");
                            }

                            ?>
                            <form action="add-new-livraison.php" method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="restaurant-name">id Commande:</label>
                                    <?php
                                    $mysqli = new MySQLi('localhost', 'root', '', 'foodhaus');
                                    $resultSet = $mysqli->query("SELECT idCommande FROM commande");
                                    ?>
                                    <select class="form-control" name="liv-idCommande">
                                        <?php
                                        while ($rows = $resultSet->fetch_assoc()) {
                                            $idCommande = $rows['idCommande'];
                                            echo "<option value='$idCommande'>$idCommande</option>";
                                        }
                                        ?>
                                    </select> </br>
                                </div>
                                <div class="form-group">
                                    <label for="nickname">Nom de livreur</label>
                                    <input name="liv-nomLivreur" class="form-control" id="nickname" onblur="lett(this)" type="text" placeholder="" />
                                </div>
                                <div class="form-group">
                                    <label for="restaurant-email">Date</label>
                                    <input name="liv-date" class="form-control" id="restaurant-type" type="date" placeholder="date." />
                                </div>
                                <div class="form-group">
                                    <label for="restaurant-email">Etat</label>
                                    <select class="form-control" name="liv-etat">
                                        <option>Traitée</option>
                                        <option>Expédiée</option>
                                        <option>En Route</option>
                                        <option>Arrivée</option>
                                    </select>


                                </div>


                                <button name="create" class="btn btn-primary mr-2 my-1" type="submit">Create now!</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--End Table-->
            </main>

            <?php require_once('./includes/footer.php'); ?>