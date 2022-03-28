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
                            <span>Commandes</span>
                        </h1>

                    </div>
                </div>
            </div>
            <!--Start Table-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">Commandes</div>
                    <div class="card-body">
                        <div class="datatable table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <a class="btn btn-primary mr-2 my-1" tabindex="0" aria-controls="datatable-buttons" href="Commandes.php" onclick="CopyToClipboard('dataTable')"><span>Copier</span></a>
                                <a class="btn btn-primary mr-2 my-1" tabindex="0" aria-controls="datatable-buttons" href="./pdf_genrator/generate_pdfkarim.php"><span>PDF</span></a>
                                <a class="btn btn-primary mr-2 my-1" tabindex="0" aria-controls="datatable-buttons" href="Commandes.php" onclick="exportTableToExcel('dataTable')"><span>Excel</span></a> &emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                <a><label>Chercher: <input type="text" id="myInput" onkeyup="myFunction()" class="form-control form-control-sm" placeholder="Chercher par nom.."></label></a>

                                <br>
                                </br>
                                <thead>
                                    <tr>

                                        <th onclick="sortTable(0)"><i data-feather="list"></i> id</th>
                                        <th>Nom de commande</th>
                                        <th>Email</th>
                                        <th>Adresse</th>
                                        <th>Code Postal</th>
                                        <th>Pays</th>
                                        <th>Ville</th>
                                        <th>Nom sur Carte</th>
                                        <th>Numéro de carte</th>
                                        <th>Mois d'exp</th>
                                        <th>Année d'exp</th>
                                        <th>CVV</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM commande";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    while ($event = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                        $idCommande = $event['idCommande'];
                                        $nom = $event['nom'];
                                        $email = $event['email'];
                                        $adresse = $event['adresse'];
                                        $codePostal = $event['codePostal'];
                                        $pays = $event['pays'];
                                        $ville = $event['ville'];
                                        $nomCarte = $event['nomCarte'];
                                        $numCarte = $event['numCarte'];
                                        $moisExp = $event['moisExp'];
                                        $anneeExp = $event['anneeExp'];
                                        $cvv = $event['cvv'];

                                    ?>
                                        <tr>

                                            <td>
                                                <?php echo $idCommande; ?>
                                            </td>
                                            <td>
                                                <?php echo $nom; ?>
                                            </td>
                                            <td>
                                                <?php echo $email; ?>
                                            </td>
                                            <td>
                                                <?php echo $adresse; ?>
                                            </td>
                                            <td>
                                                <?php echo $codePostal; ?>
                                            </td>
                                            <td>
                                                <?php echo $pays; ?>
                                            </td>
                                            <td>
                                                <?php echo $ville; ?>
                                            </td>
                                            <td>
                                                <?php echo $nomCarte; ?>
                                            </td>
                                            <td>
                                                <?php echo $numCarte; ?>
                                            </td>
                                            <td>
                                                <?php echo $moisExp; ?>
                                            </td>
                                            <td>
                                                <?php echo $anneeExp; ?>
                                            </td>
                                            <td>
                                                <?php echo $cvv; ?>
                                            </td>
                                            <td>


                                                <form action="update-Commande.php" method="POST">
                                                    <input type="hidden" name="idCommande" value="<?php echo $idCommande; ?>">
                                                    <button name="edit-user" type="submit" class="btn btn-primary btn-icon"><i data-feather="edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <?php
                                                if (isset($_POST['delete'])) {
                                                    $idCommande = $_POST['com-id'];
                                                    $sql = "DELETE FROM commande WHERE idCommande = :idCommande";
                                                    $stmt = $pdo->prepare($sql);
                                                    $stmt->execute([':idCommande' => $idCommande]);
                                                    header("Location: Commandes.php");
                                                }
                                                ?>
                                                <form action="Commandes.php" method="POST">
                                                    <input type="hidden" name="com-id" value="<?php echo $idCommande; ?>">
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