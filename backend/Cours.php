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
                                <div class="page-header-icon"><i data-feather="book"></i></div>
                                <span>Cours</span>
                            </h1>
                            <a href="add-new-cours.php" nomc="Add new Cours" class="btn btn-white">
                                <div class="page-header-icon"><i data-feather="plus"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">Cours</div>
                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0"> 
                                
                                        <a class="btn btn-primary mr-2 my-1" tabindex="0" aria-controls="datatable-buttons" href="./pdf_genrator/generate_pdfomar.php"><span>PDF</span></a>                              &emsp; &emsp;&emsp;&emsp;&emsp;                   &emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;

                                   
                                    <a ><label>Chercher: <input type="text"  id="myInput" onkeyup="myFunction()" class="form-control form-control-sm" placeholder="chercher par nom.."></label></a>                                    
                                    <br>
                                    
                                    <thead>
                                        <tr>
                                            <th onclick="sortTable(0)"><i data-feather="list"></i> ID</th>
                                            <th onclick="sortTable(1)"><i data-feather="list"></i> COURS</th>
                                            <th onclick="sortTable(2)"><i data-feather="list"></i> IMAGE</th>
                                            <th onclick="sortTable(3)"><i data-feather="list"></i> FORMATEUR</th>
                                            <th onclick="sortTable(4)"><i data-feather="list"></i> LIEU</th>
                                            <th onclick="sortTable(5)"><i data-feather="list"></i> DATE</th>
                                            <th onclick="sortTable(6)"><i data-feather="list"></i> PRIX</th>

                                            <th>Éditer</th>
                                            <th>Effacer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM cours";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();
                                        while ($event = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                            $id = $event['id'];
                                            $nomc = $event['nomc'];
                                            $imgpath = $event['imgpath'];
                                            $nomf = $event['nomf'];
                                            $lieu = $event['lieu'];
                                            $date = $event['date'];
                                            $prix = $event['prix'];

                                        ?>
                                            <tr>

                                                <td>
                                                    <?php echo $id; ?>
                                                </td>
                                                <td>
                                                    <?php echo $nomc; ?>
                                                </td>
                                                <td>
                                                <img src="./assets/img/<?php echo $imgpath; ?>" width="50" height="50" />
                                                </td>
                                                <td>
                                                    <?php echo $nomf; ?>
                                                </td>
                                                <td>
                                                    <?php echo $lieu; ?>
                                                </td>

                                                <td>
                                                    <?php echo $date; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prix; ?>
                                                </td>



                                                <td>
                                                    <form action="update-cours.php" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                        <button name="edit-user" type="submit" class="btn btn-primary btn-icon"><i data-feather="edit"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (isset($_POST['delete'])) {
                                                        $id = $_POST['event-id'];
                                                        $sql = "DELETE FROM cours WHERE id = :id";
                                                        $stmt = $pdo->prepare($sql);
                                                        $stmt->execute([':id' => $id]);
                                                        header("Location: Cours.php");
                                                    }
                                                    ?>
                                                    <form action="Cours.php" method="POST">
                                                        <input type="hidden" name="event-id" value="<?php echo $id; ?>">
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