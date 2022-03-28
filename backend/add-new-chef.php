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
                                <span>Create New chef</span>
                            </h1>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_POST['create'])) {


                    $img_chef = $_FILES['img_chef']['name'];
                    $user_photo_temp = $_FILES['img_chef']['tmp_name'];
                    move_uploaded_file("{$img_chef}", "./assests/img/{$user_photo_temp}");

                    $chef_name = $_POST['chef_name'];
                    $chef_description = $_POST['chef_description'];
                    $link_vid = $_POST['link_vid'];
                   
                    $img_video_chef = $_FILES['img_video_chef']['name'];
                    $user_photo_temp = $_FILES['img_video_chef']['tmp_name'];
                    move_uploaded_file("{$img_video_chef}", "./assests/img/{$user_photo_temp}");


                    $plat1 = $_POST['plat1'];
                    $plat2 = $_POST['plat2'];
                    $citation = $_POST['citation'];
                    $id_recette = $_POST['id_recette'];

                    $Plat_image1 = $_FILES['Plat_image1']['name'];
                    $user_photo_temp = $_FILES['Plat_image1']['tmp_name'];
                    move_uploaded_file("{$Plat_image1}", "./assests/img/{$user_photo_temp}");

                    $Plat_image2 = $_FILES['Plat_image2']['name'];
                    $user_photo_temp = $_FILES['Plat_image2']['tmp_name'];
                    move_uploaded_file("{$Plat_image2}", "./assests/img/{$user_photo_temp}");


                    $sql =  "INSERT INTO chefs (img_chef,nom,descriptions,lien_video_chef,img_video_chef,nom_plat1_chef,nom_plat2_chef,citation_chef,img_plat1_chef,img_plat2_chef,id_recette) values
                    (:img_chef, :nom,:descriptions,:lien_video_chef,:img_video_chef,:nom_plat1_chef ,:nom_plat2_chef,:citation_chef,:img_plat1_chef,:img_plat2_chef,:id_recette)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':img_chef' => $img_chef,
                        ':nom' => $chef_name,
                        ':descriptions' => $chef_description,
                        ':lien_video_chef' => $link_vid,
                        ':img_video_chef' => $img_video_chef,
                        ':nom_plat1_chef' => $plat1,
                        ':nom_plat2_chef' => $plat2,
                        ':citation_chef' => $citation,
                        ':img_plat1_chef' => $Plat_image1,
                        ':img_plat2_chef' => $Plat_image2,
                        ':id_recette' => $id_recette



                    ]);
                    header("Location: Chefs.php");
                }


                ?>

                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">Create New chef</div>
                        <div class="card-body">
                            <form action="add-new-chef.php" method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label>chef Name:</label>
                                    <input name="chef_name" class="form-control" type="text" />
                                </div>
                                <div class="form-group">
                                        <label for="user-photo">Choose image chef:</label>
                                        <input name="img_chef" class="form-control" id="user-photo" type="file" />
                                    </div>
                              
                                <div class="form-group">
                                    <label>chef description:</label>
                                    <input name="chef_description" class="form-control" type="text" />
                                </div>
                                <div class="form-group">
                                    <label>link vid :</label>
                                    <input name="link_vid" class="form-control" type="text" />
                                </div>
                                <div class="form-group">
                                        <label for="user-photo">Choose image video :</label>
                                        <input name="img_video_chef" class="form-control" id="user-photo" type="file" />
                                    </div>
                              
                               
                                <div class="form-group">
                                    <label> plat1 :</label>
                                    <input name="plat1" class="form-control" type="text" />
                                </div>
                                <div class="form-group">
                                        <label for="user-photo">Plat image1:</label>
                                        <input name="Plat_image1" class="form-control" id="user-photo" type="file" />
                                    </div>
                              
                              
                                <div class="form-group">
                                    <label>plat2:</label>
                                    <input name="plat2" class="form-control" type="text" />
                                </div>
                                <div class="form-group">
                                        <label for="user-photo">Plat image2:</label>
                                        <input name="Plat_image2" class="form-control" id="user-photo" type="file" />
                                    </div>
                              
                              
                               


                                <div class="form-group">
                                    <label>citation :</label>
                                    <input name="citation" class="form-control" type="text" />
                                </div>
                                <label> id du recette: </label>
                                <?php
                                $mysqli = new MySQLi('localhost', 'root', '', 'foodhaus');
                                $resultSet = $mysqli->query("SELECT id_recette FROM recette");
                                ?>
                                <select  class="form-control" name="id_recette">
                                    <?php
                                    while ($rows = $resultSet->fetch_assoc()) {
                                        $id_recette = $rows['id_recette'];
                                        echo "<option value='$id_recette'>$id_recette</option>";
                                    }
                                    ?>
                                </select> </br>




                                <button name="create" class="btn btn-primary mr-2 my-1" type="submit">Create now!</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--End Table-->
            </main>

            <?php require_once('./includes/footer.php'); ?>