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
                                <span>Create New team</span>
                            </h1>
                        </div>
                    </div>
                </div>

                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">Create New team</div>
                        <div class="card-body">

                            <?php
                            if (isset($_POST['create'])) {

                                $id = $_POST['id'];
                                $image = $_POST['Picture'];
                                $name = $_POST['Name'];





                                $sql = "INSERT INTO team (Picture,Name) values (:image,:name) ";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([

                                    ':image' => $image,

                                    ':name' => $name,



                                ]);


                                header("Location: team.php");
                            }

                            ?>
                            <form action="add-new-team.php" method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="image"> image:</label>
                                    <input name="Picture" class="form-control" id="image" type="text" placeholder="image" />
                                </div>

                                <div class="form-group">
                                    <label for="Price"> name:</label>
                                    <input name="Name" class="form-control" id="Price" type="text" placeholder="Price" />
                                </div>

                                <button name="create" class="btn btn-primary mr-2 my-1" type="submit">Create now!</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--End Table-->
            </main>

            <?php require_once('./includes/footer.php'); ?>