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
                                <span>Create New cours</span>
                            </h1>
                        </div>
                    </div>
                </div>







                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">Create New cours</div>
                        <div class="card-body">

                            <?php
                            if (isset($_POST['create'])) {

                                $id = $_POST['id'];
                                $nomc = $_POST['nomc'];
                                $imgpath = $_FILES['imgpath']['name'];
                                $user_photo_temp = $_FILES['imgpath']['tmp_name'];
                                move_uploaded_file("{$imgpath}", "./assests/img/{$user_photo_temp}");
                                $nomf = $_POST['nomf'];
                                $lieu = $_POST['lieu'];
                                $date = $_POST['date'];
                                $prix = $_POST['prix'];
                                $sql = "INSERT INTO COURS (id,nomc,imgpath,nomf,lieu,date,prix) values (:id, :nomc,:imgpath,:nomf,:lieu,:date,:prix) ";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([
                                    ':nomc' => $nomc,
                                    ':imgpath' => $imgpath,
                                    ':nomf' => $nomf,
                                    ':lieu' => $lieu,
                                    ':date' => $date,
                                    ':prix' => $prix,

                                    ':id' => $id
                                ]);
                                //the subject
                                require 'phpmailer/PHPMailerAutoload.php';
                                $mail = new PHPMailer;
                                $sql = "SELECT * FROM users";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute();
                                while ($users = $stmt->fetch(PDO::FETCH_ASSOC)) {


                                    $user_email = $users['user_email'];
                                    $user_name = $users['user_name'];


                                    // Add a recipient

                                    $mail->addBCC($user_email, $user_name);






                                    $message = "Un cours a ete ajoute avec succes";
                                    $subject = "Nouveau Cours";


                                    //MAILER

                                    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                                    $mail->isSMTP();                                      // Set mailer to use SMTP
                                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                                    $mail->Username = 'foodhaus.esprittn@gmail.com';                 // SMTP username
                                    $mail->Password = '(azerty12345)';                           // SMTP password
                                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                                    $mail->Port = 587;                                    // TCP port to connect to

                                    $mail->AddReplyTo('foodhaus.esprittn@gmail.com');
                                    $mail->From = 'foodhaus.esprittn@gmail.com';
                                    $mail->FromName = 'FoodHaus';





                                    $mail->isHTML(true);                                  // Set email format to HTML
                                    $mail->Subject = $subject;
                                    $mail->Body = $message;
                                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                                }
                                $mail->send();



                                header("Location: Cours.php");
                            }
                            ?>
                            <form action="add-new-cours.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="id">id du cours :</label>
                                    <input name="id" class="form-control" id="id" type="text" placeholder="id du cours" />
                                </div>
                                <div class="form-group">
                                    <label for="nomc">nom du cours :</label>
                                    <input name="nomc" class="form-control" id="nomc" type="text" onblur="lett(this)" placeholder="nom du cours" />
                                </div>
                                <div class="form-group">

                                    <div class="form-group">
                                        <label for="img">Choisir image:</label>
                                        <input name="imgpath" class="form-control" id="imgpath" type="file" />
                                    </div>
                                </div>
                                <label> nom du formateur: </label>
                                <?php
                                $mysqli = new MySQLi('localhost', 'root', '', 'foodhaus');
                                $resultSet = $mysqli->query("SELECT nom FROM formateur");
                                ?>
                                <select class="form-control" name="nomf">
                                    <?php
                                    while ($rows = $resultSet->fetch_assoc()) {
                                        $nom = $rows['nom'];
                                        echo "<option value='$nom'>$nom</option>";
                                    }
                                    ?>
                                </select> </br>
                                <div class="form-group">
                                    <label for="lieu">lieu du cours</label>
                                    <input name="lieu" class="form-control" id="lieu" type="text" placeholder="lieu du cours" />
                                </div>
                                <div class="form-group">
                                    <label for="date">date:</label>
                                    <input name="date" class="form-control" id="date" type="date" placeholder="date du cours ..." />
                                </div>

                                <div class="form-group">
                                    <label for="prix">prix:</label>
                                    <input name="prix" class="form-control" id="prix" onblur="numb(this)" type="text" placeholder="prix du cours ..." />
                                </div>
                                <button name="create" class="btn btn-primary mr-2 my-1" type="submit">Create now!</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--End Table-->
            </main>

            <?php require_once('./includes/footer.php'); ?>