<?php require_once('./includes/header.php'); ?>

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
                                <span>Modifier Livraison</span>
                            </h1>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_POST['update'])) {
                    $link = mysqli_connect("localhost", "root", "", "foodhaus");
                    $idLivraison = $_POST['idLivraison'];
                    $idCommande = $_POST['idCommande'];
                    $nomLivreur = $_POST['nomLivreur'];
                    $date = $_POST['date'];
                    $etat = $_POST['etat'];

                    $sql = "UPDATE livraisons SET idCommande='$idCommande',nomLivreur='$nomLivreur',date='$date',etat='$etat' WHERE idLivraison='$idLivraison'";
                    $sql2 = "DELETE FROM livraisons where etat='Livrée'";
                    if (mysqli_query($link, $sql)) {
                        mysqli_query($link, $sql2);
                        header('location:gb.php');
                    } else {
                        echo "ERROR: Could not able to execute $sql. "
                            . mysqli_error($link);
                    }

                    mysqli_close($link);



                    header("Location: Livraison.php");
                }


                ?>
                <?php
                if (isset($_POST['edit-user'])) {
                    $idLivraison = $_POST['liv-idLivraison'];
                    $url = "http://localhost/FoodHaus/backend/update-livraison.php?idLivraison=" . $idLivraison;
                    header("Location: {$url}");
                }

                ?>
                <?php
                if (isset($_GET['idLivraison'])) {
                    $idLivraison = $_GET['idLivraison'];
                    $sql = "SELECT * FROM livraisons WHERE idLivraison = :idLivraison";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([':idLivraison' => $idLivraison]);
                    $event = $stmt->fetch(PDO::FETCH_ASSOC);
                    $idLivraison = $event['idLivraison'];
                    $idCommande = $event['idCommande'];
                    $nomLivreur = $event['nomLivreur'];
                    $date = $event['date'];
                    $etat = $event['etat'];
                }
                ?>

                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">Modifier Livraison</div>
                        <div class="card-body">
                            <form action="update-livraison.php?idLivraison=<?php echo $_GET['idLivraison']; ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" value="<?php echo $idLivraison; ?>" name="idLivraison">

                                <div class="form-group">
                                    <label for="event-name">NUM DE COMMANDE:</label>

                                    <?php
                                    $mysqli = new MySQLi('localhost', 'root', '', 'foodhaus');
                                    $resultSet = $mysqli->query("SELECT idCommande FROM commande");
                                    ?>
                                    <select class="form-control" name="idCommande">
                                        <?php
                                        while ($rows = $resultSet->fetch_assoc()) {
                                            $idCommande = $rows['idCommande'];
                                            echo "<option value='$idCommande'>$idCommande</option>";
                                        }
                                        ?>
                                    </select> </br>
                                </div>
                                <div class="form-group">
                                    <label for="event-nickname">NOM DE LIVREUR :</label>
                                    <input value="<?php echo $nomLivreur; ?>" name="nomLivreur" class="form-control" id="event-nickname" type="text" placeholder="Enter nickname..." />
                                </div>
                                <div class="form-group">
                                    <label for="event-email"> DATE:</label>
                                    <input value="<?php echo $date; ?>" name="date" class="form-control" id="event-email" type="date" placeholder="event Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="event-email"> ETAT:</label>
                                    <select class="form-control" name="etat">
                                        <option>Traitée</option>
                                        <option>Expédiée</option>
                                        <option>En Route</option>
                                        <option>Arrivée</option>
                                    </select>

                                </div>

                        </div>
                        <button name="update" class="btn btn-primary mr-2 my-1" type="submit">Update now!</button>
                        </form>
                    </div>
                </div>
        </div>
        <!--End Table-->
        </main>

        <?php require_once('./includes/footer.php'); ?>