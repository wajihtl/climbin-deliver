<?php require_once('./includes/header.php'); ?>
<?php require_once('./includes/js.php'); ?>
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
                        <div class="page-header-content d-flex align-items-center justify-content-between text-white">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="shopping-cart"></i></div>
                                <span>Livraisons</span>
                            </h1>
                            <a href="add-new-livraison.php" title="Ajouter Livraison" class="btn btn-white">
                                <div class="page-header-icon"><i data-feather="plus"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">Livraisons</div>
                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <a class="btn btn-primary mr-2 my-1" tabindex="0" aria-controls="datatable-buttons" href="Livraison.php" onclick="CopyToClipboard('dataTable')"><span>Copier</span></a>
                                <a class="btn btn-primary mr-2 my-1" tabindex="0" aria-controls="datatable-buttons" href="Livraison.php" onclick="exportTableToExcel('dataTable')"><span>Excel</span></a> &emsp; &emsp;&emsp; &emsp; &emsp;&emsp; &emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                <a ><label>Chercher: <input type="text"  id="myInput" onkeyup="myFunction()" class="form-control form-control-sm" placeholder="Chercher par nom.."></label></a>                                    

                            <br>
                            </br>
                                    <thead>
                                        <tr>

                                        <th onclick="sortTable(0)"><i data-feather="list"></i> ID</th>
                                        <th onclick="sortTable(1)"><i data-feather="list"></i> NUM DE COMMANDE</th>
                                        <th onclick="sortTable(2)"><i data-feather="list"></i> LIVREUR</th>
                                        <th onclick="sortTable(3)"><i data-feather="list"></i> DATE</th>
                                        <th onclick="sortTable(4)"><i data-feather="list"></i> ETAT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM livraisons";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();
                                        while ($event = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                            $idLivraison = $event['idLivraison'];
                                            $idCommande = $event['idCommande'];
                                            $nomLivreur = $event['nomLivreur'];
                                            $date = $event['date'];
                                            $etat = $event['etat'];
                                           
                                        ?>
                                            <tr>

                                                <td>
                                                    <?php echo $idLivraison; ?>
                                                </td>
                                                <td>
                                                    <?php echo $idCommande; ?>
                                                </td>
                                                <td>
                                                    <?php echo $nomLivreur; ?>
                                                </td>
                                                <td>
                                                    <?php echo $date; ?>
                                                </td>
                                                <td>
                                                    <?php echo $etat; ?>
                                                </td>
                                                <td>

                                                
                                                    <form action="update-Livraison.php" method="POST">
                                                        <input type="hidden" name="liv-idLivraison" value="<?php echo $idLivraison; ?>">
                                                        <button name="edit-user" type="submit" class="btn btn-primary btn-icon"><i data-feather="edit"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (isset($_POST['delete'])) {
                                                        $idLivraison = $_POST['liv-id'];
                                                        $sql = "DELETE FROM livraisons WHERE idLivraison = :idLivraison";
                                                        $stmt = $pdo->prepare($sql);
                                                        $stmt->execute([':idLivraison' => $idLivraison]);
                                                        header("Location: Livraison.php");
                                                    }
                                                    ?>
                                                    <form action="Livraison.php" method="POST">
                                                        <input type="hidden" name="liv-id" value="<?php echo $idLivraison; ?>">
                                                        <button name="delete" type="submit" class="btn btn-red btn-icon"><i data-feather="trash-2"></i></button>
                                                    </form>
                                                </td>

                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Table-->
            </main>

            <?php require_once('./includes/footer.php'); ?>