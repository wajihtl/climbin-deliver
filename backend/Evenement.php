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
                                <div class="page-header-icon"><i data-feather="home"></i></div>
                                <span>event</span>
                            </h1>
                            <a href="add-new-event.php" title="Add new Classes" class="btn btn-white">
                                <div class="page-header-icon"><i data-feather="plus"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">event</div>
                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                                    <a><label>Chercher: <input type="text" id="myInput" onkeyup="myFunction()" class="form-control form-control-sm" placeholder="chercher par nom.."></label></a>
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Content</th>
                                            <th>Picture</th>
                                            <th>Éditer</th>
                                            <th>Effacer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM event";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();
                                        while ($classes = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                            $id = $classes['id'];
                                            $Title = $classes['Title'];
                                            $Description = $classes['Description'];
                                            $Content = $classes['Content'];
                                            $Picture = $classes['Picture'];

                                        ?>
                                            <tr>


                                                <td>
                                                    <?php echo $Title; ?>
                                                </td>

                                                <td><?php echo $Description; ?>
                                                </td>
                                                <td>
                                                    <?php echo $Content; ?>
                                                </td>
                                                <td>
                                                    <img src="./assets/img/<?php echo $Picture; ?>" width="50" height="50" />
                                                </td>

                                                <td>
                                                    <form action="update-evenement.php" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                        <button name="edit-user" type="submit" class="btn btn-primary btn-icon"><i data-feather="edit"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (isset($_POST['delete'])) {
                                                        $id = $_POST['id'];
                                                        $sql = "DELETE FROM event WHERE id = :id";
                                                        $stmt = $pdo->prepare($sql);
                                                        $stmt->execute([':id' => $id]);
                                                        header("Location: Evenement.php");
                                                    }
                                                    ?>
                                                    <form action="evenement.php" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
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