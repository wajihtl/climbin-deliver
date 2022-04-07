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
                            <span>mise a jour classe</span>
                        </h1>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_POST['update'])) {

                $id = $_GET['id'];
                $Title = $_POST['Title'];
                $Description = $_POST['Description'];
                $Content = $_POST['Content'];
                $Picture = $_POST['Picture'];


                $sql = "UPDATE classes SET Picture='$Picture' ,Title='$Title',Description='$Description' ,Content='$Content' WHERE id='$id' ";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([

                    ':Title' => $Title,
                    ':Description' => $Description,

                    ':Content' => $Content,

                    ':Picture' => $Picture,
                    ':id' => $_GET['id']
                ]);

                header("Location: Classes.php");

            }


            ?>
            <?php
            if (isset($_POST['edit-user'])) {
                $id = $_POST['id'];
                $url = "update-classe.php?id=" . $id;
                header("Location: {$url}");
            }

            ?>
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM classes WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':id' => $id]);
                $classe = $stmt->fetch(PDO::FETCH_ASSOC);
                $id = $classe['id'];
                $Title = $classe['Title'];
                $Description = $classe['Description'];
                $Content = $classe['Content'];
                $Picture = $classe['Picture'];
            }
            ?>

            <!--Start Table-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">Edit Picture</div>
                    <div class="card-body">
                        <form action="update-classe.php?id=<?php echo $_GET['id']; ?>" method="POST"
                              enctype="multipart/form-data">


                            <div class="form-group">
                                <label for="Title">titrerrrr:</label>
                                <input value="<?php echo $Title; ?>" name="Title" class="form-control" id="Title"
                                       type="text" placeholder="restaurant- ype..."/>
                            </div>
                            <div class="form-group">
                                <label for="Description">entrees:</label>
                                <input value="<?php echo $Description; ?>" name="Description" class="form-control"
                                       id="Description" type="text" placeholder="contact..."/>
                            </div>
                            <div class="form-group">
                                <label for="Content">plats principals:</label>
                                <input value="<?php echo $Content; ?>" name="Content" class="form-control" id="Content"
                                       type="text" placeholder="restaurant email..."/>
                            </div>
                            <div class="form-group">
                                <label for="Picture">formateur image:</label>
                                <input value="<?php echo $Picture; ?>" name="Picture" class="form-control" id="Picture"
                                       type="text" placeholder="formateur image..."/>
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