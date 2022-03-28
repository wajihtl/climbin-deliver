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
                                <span> Chefs</span>
                            </h1>
                            <a href="add-new-chef.php" title="Add new chef" class="btn btn-white">
                                <div class="page-header-icon"><i data-feather="plus"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header"> Chefs</div>
                        <div class="card-body">
                            <a class="btn btn-primary mr-2 my-1" tabindex="0" aria-controls="datatable-buttons" href="./pdf_genrator/generate_pdf_chef.php"><span>PDF</span></a>
                            &emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                            <a><label>Chercher: <input type="text" id="myInput" onkeyup="myFunction()" class="form-control form-control-sm" placeholder="Chercher par nom.."></label></a>
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th onclick="sortTable(0)"><i data-feather="list"></i> Chef Name </th>
                                            <th onclick="sortTable(1)"><i data-feather="list"></i> Description</th>
                                            <th onclick="sortTable(2)"><i data-feather="list"></i> Speciality 1</th>
                                            <th onclick="sortTable(3)"><i data-feather="list"></i> Speciality 2</th>
                                            <th onclick="sortTable(4)"><i data-feather="list"></i> Picture</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM chefs";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();
                                        while ($ms = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $id_chef = $ms['id_chef'];
                                            $nom = $ms['nom'];
                                            $descriptions = $ms['descriptions'];
                                            $nom_plat1_chef = $ms['nom_plat1_chef'];
                                            $nom_plat2_chef = $ms['nom_plat2_chef'];
                                            $img_chef = $ms['img_chef'];
                                        ?>
                                            <tr>
                                                <td><?php echo $nom; ?></td>
                                                <td>
                                                    <?php echo $descriptions; ?>
                                                </td>
                                                <td>
                                                    <?php echo $nom_plat1_chef; ?>
                                                </td>
                                                <td><?php echo $nom_plat2_chef; ?> </td>
                                                <td>
                                                    <img src="./assets/img/<?php echo $img_chef; ?>" width="50" height="50" />

                                                </td>
                                               
                                               

                                                <td>
                                                    <form action="update-chef.php" method="POST">
                                                        <input type="hidden" name="id_chef" value="<?php echo $id_chef; ?>">
                                                        <button name="edit-chef" class="btn btn-info btn-icon"><i data-feather="edit"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (isset($_POST['delete'])) {
                                                        $id = $_POST['id'];
                                                        $sql = "DELETE FROM chefs WHERE id_chef = :id";
                                                        $stmt = $pdo->prepare($sql);
                                                        $stmt->execute([
                                                            ':id' => $id
                                                        ]);
                                                        header("Location: chefs.php");
                                                    }
                                                    ?>
                                                    <form action="chefs.php" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $id_chef; ?>">
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