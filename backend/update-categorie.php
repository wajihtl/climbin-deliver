<?php require_once('./includes/header.php'); ?>
<script>
    function numb(inputtxt) {
        var numbers = /^[-+]?[0-9]+$/;
        if (inputtxt.value.match(numbers)) {
            return true;
        } else {
            alert('Prière de saisir uniquement des namebres');
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
                                <span>Updating categorie</span>
                            </h1>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_POST['update'])) {
                    $id_categ = $_GET['id_categ'];

                    $name = $_POST['name'];
                   
                    $sql = "UPDATE categorie SET name='$name' WHERE id_categ='$id_categ' ";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':name' => $name,
                      

                    ]);
                    header("Location: Categorie.php");
                }


                ?>
                <?php
                if (isset($_POST['edit-user'])) {
                    $id_categ = $_POST['id_categ'];
                    $url = "http://localhost/FoodHaus/backend/update-categorie.php?id_categ=" . $id_categ;
                    header("Location: {$url}");
                }

                ?>
                <?php
                if (isset($_GET['id_categ'])) {
                    $id_categ = $_GET['id_categ'];
                    $sql = "SELECT * FROM categorie WHERE id_categ = :id_categ";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([':id_categ' => $id_categ]);
                    $categorie = $stmt->fetch(PDO::FETCH_ASSOC);
                    $name = $categorie['name'];
                   }
                ?>

                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">Edit categorie</div>
                        <div class="card-body">
                            <form action="update-categorie.php?id_categ=<?php echo $_GET['id_categ']; ?>" method="POST" enctype="multipart/form-data">

                       
                                <div class="form-group">
                                    <label for="formateur-nickname">categorie name :</label>
                                    <input value="<?php echo $name; ?>" name="name" class="form-control" id="formateur-nickname" type="text"  onblur="lett(this)" placeholder="Enter nickname..." />
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