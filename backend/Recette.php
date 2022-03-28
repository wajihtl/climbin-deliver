<?php require_once('./includes/header.php'); ?>
<?php require_once('./includes/js.php'); ?>

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
                        <div class="page-header-content d-flex align-items-center justify-content-between text-white">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="star"></i></div>
                                <span>All recettes</span>
                            </h1>
                            <a href="Add-new-recette.php" title="Add new recettes" class="btn btn-white">
                                <div class="page-header-icon"><i data-feather="plus"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">All recettes</div>
                        <div class="card-body">
                            <a class="btn btn-primary mr-2 my-1" tabindex="0" aria-controls="datatable-buttons" href="Recette.php" onclick="CopyToClipboard('dataTable')"><span>copier</span></a>
                            <a class="btn btn-primary mr-2 my-1" tabindex="0" aria-controls="datatable-buttons" href="./pdf_genrator/generate_pdf_recette.php"><span>PDF</span></a>
                            &emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                            <a><label>Chercher: <input type="text" id="myInput" onkeyup="myFunction()" class="form-control form-control-sm" placeholder="chercher par nom.."></label></a>
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th onclick="sortTable(5)"><i data-feather="list"></i> IdRecettes </th>
                                            <th onclick="sortTable(1)"><i data-feather="list"></i> Image </th>
                                            <th onclick="sortTable(0)"><i data-feather="list"></i> Nom recette</th>
                                            <th onclick="sortTable(2)"><i data-feather="list"></i> Description</th>
                                            <th onclick="sortTable(3)"><i data-feather="list"></i> Durée</th>
                                            <th onclick="sortTable(4)"><i data-feather="list"></i> Type</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM recette";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();
                                        while ($ms = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $id_recette = $ms['id_recette'];
                                            $nom_recette = $ms['nom_recette'];
                                            $img_recette = $ms['img_recette'];
                                            $descprition_recette = $ms['descprition_recette'];
                                            $temp_recette = $ms['temp_recette'];
                                            $type_recette = $ms['type_recette'];
                                        ?>
                                            <tr>
                                            <td><?php echo $id_recette; ?></td>
                                          
                                            <td>
                                                    <img src="./assets/img/<?php echo $img_recette; ?>" width="50" height="50" />

                                                </td>
                                                <td><?php echo $nom_recette; ?></td>
                                          
                                                <td>
                                                    <?php echo $descprition_recette; ?>
                                                </td>
                                                <td><?php echo $temp_recette; ?>
                                                </td>
                                                <td><?php echo $type_recette; ?>
                                                </td>

                                                <td>
                                                    <form action="update-recette.php" method="POST">
                                                        <input type="hidden" name="id_recette" value="<?php echo $id_recette; ?>">
                                                        <button name="edit-recette" class="btn btn-info btn-icon"><i data-feather="edit"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (isset($_POST['delete'])) {
                                                        $id_recette = $_POST['id_recette'];
                                                        $sql = "DELETE FROM recette WHERE id_recette = :id_recette";
                                                        $stmt = $pdo->prepare($sql);
                                                        $stmt->execute([
                                                            ':id_recette' => $id_recette
                                                        ]);
                                                        header("Location: Recette.php");
                                                    }
                                                    ?>
                                                    <form action="Recette.php" method="POST">
                                                        <input type="hidden" name="id_recette" value="<?php echo $id_recette; ?>">
                                                        <button name="delete" type="submit" class="btn btn-red btn-icon"><i data-feather="trash"></i></button>
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