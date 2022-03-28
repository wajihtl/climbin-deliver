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
                                <div class="page-header-icon"><i data-feather="shopping-cart"></i></div>
                                <span>Reservation</span>
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
                                    <a class="btn btn-primary mr-2 my-1" tabindex="0" aria-controls="datatable-buttons" href="reservation.php" onclick="CopyToClipboard('tblData')"><span>Copier</span></a>
                                    <a class="btn btn-primary mr-2 my-1" tabindex="0" aria-controls="datatable-buttons" href="./pdf_genrator/generate_pdfreservation.php"><span>PDF</span></a>
                                    <a class="btn btn-primary mr-2 my-1" tabindex="0" aria-controls="datatable-buttons" href="reservation.php" onclick="exportTableToExcel('tblData')"><span>Excel</span></a>
                                    &emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                    <a><label>Chercher: <input type="text" id="myInput" onkeyup="myFunction()" class="form-control form-control-sm" placeholder="Chercher par nom.."></label></a>

                                    <br>
                                    <br>
                                    <thead>
                                        <tr>

                                            <th onclick="sortTable(0)"><i data-feather="list"></i> idReservation</th>
                                            <th>resto</th>
                                            <th>date</th>
                                            <th>heure</th>
                                            <th>nombre de person</th>
                                            <th>nom et prenom</th>
                                            <th>telephone</th>
                                            <th>email</th>
                                            <th>Effacer</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM reservation";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();
                                        while ($reservation = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                            $idReservation = $reservation['idReservation'];
                                            $resto = $reservation['resto'];
                                            $date = $reservation['date'];
                                            $heure = $reservation['heure'];
                                            $person = $reservation['person'];
                                            $nom = $reservation['nom'];
                                            $telephone = $reservation['telephone'];
                                            $email = $reservation['email'];

                                        ?>
                                            <tr>
                                                <td><?php echo $idReservation; ?></td>
                                                <td>
                                                    <?php echo $resto; ?>
                                                </td>
                                                <td>
                                                    <?php echo $date; ?>
                                                </td>
                                                <td>
                                                    <?php echo $heure; ?>
                                                </td>
                                                <td>
                                                    <?php echo $person; ?>
                                                </td>
                                                <td>
                                                    <?php echo $nom; ?>
                                                </td>
                                                <td>
                                                    <?php echo $telephone; ?>
                                                </td>
                                                <td>
                                                    <?php echo $email; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (isset($_POST['delete'])) {
                                                        $idReservation = $_POST['reservation-id'];
                                                        $sql = "DELETE FROM reservation WHERE idReservation = :id";
                                                        $stmt = $pdo->prepare($sql);
                                                        $stmt->execute([':id' => $idReservation]);
                                                        header("Location: reservation.php");
                                                    }
                                                    ?>
                                                    <form action="reservation.php" method="POST">
                                                        <input type="hidden" name="reservation-id" value="<?php echo $idReservation; ?>">
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