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
                                <span>Updating chef </span>
                            </h1>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_POST['update'])) {
                    $id_chef = $_GET['id_chef'];
                    $img_chef = $_POST['img_chef'];
                    $nom = $_POST['nom'];
                    $descriptions = $_POST['descriptions'];
                    $lien_video_chef = $_POST['lien_video_chef'];
                    $img_video_chef = $_POST['img_video_chef'];
                    $nom_plat1_chef = $_POST['nom_plat1_chef'];
                    $nom_plat2_chef = $_POST['nom_plat2_chef'];
                    $citation_chef = $_POST['citation_chef'];
                    $img_plat1_chef = $_POST['img_plat1_chef'];
                    $img_plat2_chef = $_POST['img_plat2_chef'];
                    $id_recette = $_POST['id_recette'];

                    $sql =  "UPDATE chefs SET img_chef='$img_chef',nom='$nom',descriptions='$descriptions',lien_video_chef='$lien_video_chef',
                    img_video_chef='$img_video_chef',nom_plat1_chef='$nom_plat1_chef',nom_plat2_chef='$nom_plat2_chef',citation_chef='$citation_chef',img_plat1_chef='$img_plat1_chef'
                    ,img_plat2_chef='$img_plat2_chef',id_recette='$id_recette' WHERE id_chef='$id_chef' ";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':img_chef' => $img_chef,
                        ':nom' => $nom,
                        ':descriptions' => $descriptions,
                        ':lien_video_chef' => $lien_video_chef,
                        ':img_video_chef' => $img_video_chef,
                        ':nom_plat1_chef' => $nom_plat1_chef,
                        ':nom_plat2_chef' => $nom_plat2_chef,
                        ':citation_chef' => $citation_chef,
                        ':img_plat1_chef' => $img_plat1_chef,
                        ':img_plat2_chef' => $img_plat2_chef,
                        ':id_recette' => $id_recette



                    ]);
                    header("Location: Chefs.php");
                }


                ?>
                <?php
                if (isset($_POST['edit-chef'])) {
                    $id_chef = $_POST['id_chef'];
                    $url = "http://localhost/FoodHaus/backend/update-chef.php?id_chef=" . $id_chef;
                    header("Location: {$url}");
                }

                ?>
                <?php
                if (isset($_GET['id_chef'])) {
                    $id_chef = $_GET['id_chef'];
                    $sql = "SELECT * FROM chefs WHERE id_chef = :id_chef";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([':id_chef' => $id_chef]);
                    $chef = $stmt->fetch(PDO::FETCH_ASSOC);

                    $id_chef = $chef['id_chef'];
                    $img_chef = $chef['img_chef'];
                    $nom = $chef['nom'];
                    $descriptions = $chef['descriptions'];
                    $lien_video_chef = $chef['lien_video_chef'];
                    $img_video_chef = $chef['img_video_chef'];
                    $nom_plat1_chef = $chef['nom_plat1_chef'];
                    $nom_plat2_chef = $chef['nom_plat2_chef'];
                    $citation_chef = $chef['citation_chef'];
                    $img_plat1_chef = $chef['img_plat1_chef'];
                    $img_plat2_chef = $chef['img_plat2_chef'];
                    $id_recette = $chef['id_recette'];
                }
                ?>

                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">Edit chef</div>
                        <div class="card-body">
                            <form action="update-chef.php?id_chef=<?php echo $_GET['id_chef']; ?>" method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="nom">nom :</label>
                                    <input value="<?php echo $nom; ?>" name="nom" class="form-control" id="chef-name" type="text" placeholder="chef Name..." />
                                </div>
                                <div class="form-group">
                                    <label for="chef-nickname"> img :</label>
                                    <input value="<?php echo $img_chef; ?>" name="img_chef" class="form-control" id="chef-nickname" type="text" onblur="" placeholder="Enter nickname..." />
                                </div>
                                <div class="form-group">
                                    <label for="chef-email">description chef:</label>
                                    <input value="<?php echo $descriptions; ?>" name="descriptions" class="form-control" id="chef-email" type="text" placeholder="chef Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="chef-email">img_video_chef:</label>
                                    <input value="<?php echo $img_video_chef; ?>" name="img_video_chef" class="form-control" id="chef-email" type="text" placeholder="chef Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="chef-email">nom_plat1_chef:</label>
                                    <input value="<?php echo $nom_plat1_chef; ?>" name="nom_plat1_chef" class="form-control" id="chef-email" type="text" onblur="" placeholder="chef Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="chef-email"> nom_plat2_chef:</label>
                                    <input value="<?php echo $nom_plat2_chef; ?>" name="nom_plat2_chef" class="form-control" id="chef-email" type="text" onblur="" placeholder="chef Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="chef-email">citation chef:</label>
                                    <input value="<?php echo $citation_chef; ?>" name="citation_chef" class="form-control" id="chef-email" type="text" onblur="" placeholder="chef Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="chef-email">lien_video_chef:</label>
                                    <input value="<?php echo $lien_video_chef; ?>" name="lien_video_chef" class="form-control" id="chef-email" type="text" onblur="" placeholder="chef Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="chef-email">img_plat1_chef:</label>
                                    <input value="<?php echo $img_plat1_chef; ?>" name="img_plat1_chef" class="form-control" id="chef-email" type="text" onblur="" placeholder="chef Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="chef-email">img_plat2_chef:</label>
                                    <input value="<?php echo $img_plat2_chef; ?>" name="img_plat2_chef" class="form-control" id="chef-email" type="text" onblur="" placeholder="chef Email..." />
                                </div>
                                <label> id du recette: </label>
                                <?php
                                $mysqli = new MySQLi('localhost', 'root', '', 'foodhaus');
                                $resultSet = $mysqli->query("SELECT id_recette FROM recette");
                                ?>
                                <select class="form-control" name="id_recette">
                                    <?php
                                    while ($rows = $resultSet->fetch_assoc()) {
                                        $id_recette = $rows['id_recette'];
                                        echo "<option value='$id_recette'>$id_recette</option>";
                                    }
                                    ?>
                                </select> </br>


                        </div>
                        <button name="update" class="btn btn-primary mr-2 my-1" type="submit">Update now!</button>
                        </form>
                    </div>
                    <!--End Table-->
            </main>

            <?php require_once('./includes/footer.php'); ?>