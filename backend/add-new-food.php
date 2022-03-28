<script>
    function ValidateEmail(inputText) {
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (inputText.value.match(mailformat)) {
            document.form1.text1.focus();
            return true;
        } else {
            alert("You have entered an invalid email address!");
            document.form1.text1.focus();
            return false;
        }
    }

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
                            <span>Create New food</span>
                        </h1>
                    </div>
                </div>
            </div>

            <!--Start Table-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">Create New food</div>
                    <div class="card-body">

                        <?php
                        if (isset($_POST['create'])) {

                            $id = $_POST['id'];
                            $image = $_POST['image'];
                            $Price = $_POST['Price'];
                            $Title = $_POST['Title'];




                            $sql = "INSERT INTO food (Price,Title,image) values (:Price,:Title,:image) ";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([

                                ':image' => $image,
                                ':Price' => $Price,
                                ':Title' => $Title,



                            ]);


                            header("Location: Food.php");
                        }

                        ?>
                        <form action="add-new-food.php" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="image"> image:</label>
                                <input name="image" class="form-control" id="image" type="text" placeholder="image" />
                            </div>
                            <div class="form-group">
                                <label for="Title"> Title:</label>
                                <input name="Title" class="form-control" id="Title" type="text" placeholder="Title" />
                            </div>
                            <div class="form-group">
                                <label for="Price"> Price:</label>
                                <input name="Price" class="form-control" id="Price" type="text" placeholder="Price" />
                            </div>




                            <button name="create" class="btn btn-primary mr-2 my-1" type="submit">Create now!</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Table-->
        </main>

<?php require_once('./includes/footer.php'); ?>