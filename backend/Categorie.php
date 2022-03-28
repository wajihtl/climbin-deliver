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
                                <div class="page-header-icon"><i data-feather="smile"></i></div>
                                <span>Categories</span>
                            </h1>
                            <a href="add-new-categorie.php" title="Add new categorie" class="btn btn-white">
                                <div class="page-header-icon"><i data-feather="plus"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">categorie</div>
                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <a class="btn btn-primary mr-2 my-1" tabindex="0" aria-controls="datatable-buttons" href="Categorie.php" onclick="CopyToClipboard('dataTable')"><span>Copier</span></a> &emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                    <a><label>chercher: <input type="text" id="myInput" onkeyup="myFunction()" class="form-control form-control-sm" placeholder="chercher par nom.."></label></a>
                                    <br>
                                    </br>
                                    <thead>
                                        <tr>
                                            <th onclick="sortTable(0)"><i data-feather="list"></i> id Categroie</th>
                                            <th onclick="sortTable(1)"><i data-feather="list"></i> nom</th>
                                            <th>Edit</th>
                                            <th>Effacer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM Categorie";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();
                                        while ($participant = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                            $id_categ = $participant['id_categ'];
                                            $name = $participant['name'];


                                        ?>
                                            <tr>

                                                <td>
                                                    <?php echo $id_categ; ?>
                                                </td>
                                                <td>
                                                    <?php echo $name; ?>
                                                </td>

                                                <td>
                                                    <form action="update-categorie.php" method="POST">
                                                        <input type="hidden" name="id_categ" value="<?php echo $id_categ; ?>">
                                                        <button name="edit-user" type="submit" class="btn btn-primary btn-icon"><i data-feather="edit"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (isset($_POST['delete'])) {
                                                        $id_categ = $_POST['id_categ'];
                                                        $sql = "DELETE FROM categorie WHERE id_categ = :id_categ";
                                                        $stmt = $pdo->prepare($sql);
                                                        $stmt->execute([':id_categ' => $id_categ]);
                                                        header("Location: Categorie.php");
                                                    }
                                                    ?>
                                                    <form action="Categorie.php" method="POST">
                                                        <input type="hidden" name="id_categ" value="<?php echo $id_categ; ?>">
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