<?php require_once('./includes/header.php'); ?>
<script>
    function numb(inputtxt) {
        var numbers = /^[-+]?[0-9]+$/;
        if (inputtxt.value.match(numbers)) {
            return true;
        } else {
            alert('Prière de saisir uniquement des nombres');
            return false;
        }
    }

    function lett(inputtxt) {
        var letters = /^[A-Za-z\s]+$/;
        if (inputtxt.value.match(letters)) {
            return true;
        } else {
            alert('Prière de saisir uniquement des lettres');
            return false;
        }
    }
</script>

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
                                <span>Updating recette</span>
                            </h1>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_POST['update'])) {
                    $id_recette = $_GET['id_recette'];

                    $nom_recette = $_POST['nom_recette'];
                    $img_recette = $_POST['img_recette'];
                    $descprition_recette = $_POST['descprition_recette'];
                    $temp_recette = $_POST['temp_recette'];
                    $type_recette = $_POST['type_recette'];
                    $lien_video_recette = $_POST['lien_video_recette'];

                    $sql = "UPDATE recette SET nom_recette='$nom_recette',img_recette='$img_recette',descprition_recette='$descprition_recette',temp_recette='$temp_recette',type_recette='$type_recette' ,lien_video_recette='$lien_video_recette' WHERE id_recette='$id_recette' ";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':nom_recette' => $nom_recette,
                        ':img_recette' => $img_recette,
                        ':descprition_recette' => $descprition_recette,
                        ':temp_recette' => $temp_recette,
                        ':lien_video_recette' => $lien_video_recette,
                        ':type_recette' => $type_recette
                    ]);
                    
                    header("Location: Recette.php");
                }


                ?>
                <?php
                if (isset($_POST['edit-recette'])) {
                    $id_recette = $_POST['id_recette'];
                    $url = "http://localhost/FoodHaus/backend/update-recette.php?id_recette=" . $id_recette;
                    header("Location: {$url}");
                }

                ?>
                <?php
                if (isset($_GET['id_recette'])) {
                    $id_recette = $_GET['id_recette'];
                    $sql = "SELECT * FROM recette WHERE id_recette = :id_recette";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([':id_recette' => $id_recette]);
                    $recette = $stmt->fetch(PDO::FETCH_ASSOC);
                    $nom_recette = $recette['nom_recette'];
                    $img_recette = $recette['img_recette'];
                    $descprition_recette = $recette['descprition_recette'];
                    $temp_recette = $recette['temp_recette'];
                    $type_recette = $recette['type_recette'];
                    $lien_video_recette = $recette['lien_video_recette'];

                }
                ?>

                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">Edit RECETTE</div>
                        <div class="card-body">
                            <form action="update-recette.php?id_recette=<?php echo $_GET['id_recette']; ?>" method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="recette-name">nom recette:</label>
                                    <input value="<?php echo $nom_recette; ?>" name="nom_recette" class="form-control" id="recette-name" type="text" placeholder="recette Name..." />
                                </div>
                                <div class="form-group">
                                    <label for="recette-nickname"> img recette :</label>
                                    <input value="<?php echo $img_recette; ?>" name="img_recette" class="form-control" id="recette-nickname" type="text"  placeholder="Enter img..." />
                                </div>
                                <div class="form-group">
                                    <label for="recette-email">description recette:</label>
                                    <input value="<?php echo $descprition_recette; ?>" name="descprition_recette" class="form-control" id="recette-email" type="text"  placeholder="recette description..." />
                                </div>
                                <div class="form-group">
                                    <label for="recette-email">temps recette:</label>
                                    <input value="<?php echo $temp_recette; ?>" name="temp_recette" class="form-control" id="recette-email" type="text" placeholder="recette temps..." />
                                </div>
                                <div class="form-group">
                                    <label for="recette-email">type recette:</label>
                                    <input value="<?php echo $type_recette; ?>" name="type_recette" class="form-control" id="recette-email" type="text" onblur="lett(this)" placeholder="recette type..." />
                                </div>
                                <div class="form-group">
                                    <label for="recette-email">lien recette:</label>
                                    <input value="<?php echo $lien_video_recette; ?>" name="lien_video_recette" class="form-control" id="recette-email" type="text"  placeholder="recette lien..." />
                                </div>
                                

                        </div>
                        <button name="update" class="btn btn-primary mr-2 my-1" type="submit">Update now!</button>
                        </form>
                    </div>
                </div>
        </div>
        <!--End Table-->
        </main>

        <?php require_once('./includes/footer.php'); ?>