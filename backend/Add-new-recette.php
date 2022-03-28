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
                                <span>Create New recette</span>
                            </h1>
                        </div>
                    </div>
                </div>







                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">Create New recette</div>
                        <div class="card-body">

                            <?php
                            if (isset($_POST['create'])) {

                                $nom_recette = $_POST['nom_recette'];
                                $img_recette = $_FILES['img_recette']['name'];
                                $user_photo_temp = $_FILES['img_recette']['tmp_name'];
                                move_uploaded_file("{$img_recette}", "./assests/img/{$user_photo_temp}");

                                $descprition_recette = $_POST['descprition_recette'];
                                $temp_recette = $_POST['temp_recette'];
                                $type_recette = $_POST['type_recette'];
                                $lien_video_recette = $_POST['lien_video_recette'];

                                $sql = "INSERT INTO recette (nom_recette,img_recette,descprition_recette,temp_recette,type_recette,	lien_video_recette) values (:nom_recette, :img_recette , :descprition_recette, :temp_recette,:type_recette,:lien_video_recette) ";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([
                                    ':nom_recette' => $nom_recette,
                                    ':img_recette' => $img_recette,
                                    ':descprition_recette' => $descprition_recette,
                                    ':temp_recette' => $temp_recette,
                                    ':type_recette' => $type_recette,
                                    ':lien_video_recette' => $lien_video_recette,

                                ]);
                                // echo $id ; 
                                // echo $title ; 
                                // echo $nbplaces ; 
                                // echo $date ; 
                                // echo $description ; 
                                // echo $img ; 
                                // echo $adress ; 

                                header("Location: Recette.php");
                            }

                            ?>
                            <form action="add-new-recette.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nom">recette nom:</label>
                                    <input name="nom_recette" class="form-control" id="id" type="text" placeholder="nom recette" />
                                </div>
                                <div class="form-group">
                                        <label for="user-photo">Choose photo:</label>
                                        <input name="img_recette" class="form-control" id="user-photo" type="file" />
                                    </div>
                                <div class="form-group">
                                    <label for="nbplaces">description recette:</label>
                                    <input name="descprition_recette" class="form-control" id="prenom" type="text"  placeholder="description du recette" />
                                </div>
                                <div class="form-group">
                                    <label for="date">temps recette</label>
                                    <input name="temp_recette" class="form-control" id="specialite" type="text" onblur="numb(this)" placeholder="temps en minutes." />
                                </div>
                                <div class="form-group">
                                    <label for="date">type recette</label>
                                    <input name="type_recette" class="form-control" id="specialite" type="text" onblur="lett(this)" placeholder="type." />
                                </div>
                                <div class="form-group">
                                    <label for="date">lien recette</label>
                                    <input name="lien_video_recette" class="form-control" id="specialite" type="text"  placeholder="lien du recette." />
                                </div>

                                <button name="create" class="btn btn-primary mr-2 my-1" type="submit">Create now!</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--End Table-->
            </main>

            <?php require_once('./includes/footer.php'); ?>