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
    function ValidateEmail(inputText)
{
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
if(inputText.value.match(mailformat))
{
document.form1.text1.focus();
return true;
}
else
{
alert("You have entered an invalid email address!");
document.form1.text1.focus();
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
                                <span>Updating commande</span>
                            </h1>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_POST['update'])) {
                    $idCommande = $_POST['idCommande'];
                    $nom = $_POST['nom'];
                    $email = $_POST['email'];
                    $adresse = $_POST['adresse'];
                    $codePostal = $_POST['codePostal'];
                    $pays = $_POST['pays'];
                    $ville = $_POST['ville'];
                    $nomCarte = $_POST['nomCarte'];
                    $numCarte = $_POST['numCarte'];
                    $moisExp = $_POST['moisExp'];
                    $anneeExp = $_POST['anneeExp'];
                    $cvv = $_POST['cvv'];
                    $sql = "UPDATE commande SET nom='$nom',email='$email',adresse='$adresse',codePostal='$codePostal',
                    pays='$pays',ville='$ville',nomCarte='$nomCarte',numCarte='$numCarte',moisExp='$moisExp',anneeExp='$anneeExp',cvv='$cvv' WHERE idCommande='$idCommande'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':idCommande' => $idCommande,
                        ':nom' => $nom,
                        ':email' => $email,
                        ':adresse' => $adresse,
                        ':codePostal' => $codePostal,
                        ':pays' => $pays,
                        ':ville' => $ville,
                        ':nomCarte' => $nomCarte,
                        ':numCarte' => $numCarte,
                        ':moisExp' => $moisExp,
                        ':anneeExp' => $anneeExp,
                        ':cvv' => $cvv,
                    ]);
                    header("Location: Commandes.php");
                }


                ?>
                <?php
                if (isset($_POST['edit-user'])) {
                    $idCommande = $_POST['idCommande'];
                    $url = "http://localhost/FoodHaus/backend/update-commande.php?idCommande=" . $idCommande;
                    header("Location: {$url}");
                }

                ?>
                <?php
                if (isset($_GET['idCommande'])) {
                    $idCommande = $_GET['idCommande'];
                    $sql = "SELECT * FROM commande WHERE idCommande = :idCommande";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([':idCommande' => $idCommande]);
                    $event = $stmt->fetch(PDO::FETCH_ASSOC);
                    $idCommande = $event['idCommande'];
                    $nom = $event['nom'];
                    $email = $event['email'];
                    $adresse = $event['adresse'];
                    $codePostal = $event['codePostal'];
                    $pays = $event['pays'];
                    $ville = $event['ville'];
                    $nomCarte = $event['nomCarte'];
                    $numCarte = $event['numCarte'];
                    $moisExp = $event['moisExp'];
                    $anneeExp = $event['anneeExp'];
                    $cvv = $event['cvv'];
                }
                ?>

                <!--Start Table-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">Modifier Commande</div>
                        <div class="card-body">
                            <form action="update-commande.php?idCommande=<?php echo $_GET['idCommande']; ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $idCommande; ?>" name="idCommande">
                            <div>
                                    <label for="formateur-nickname">Plat:</label>
                                    <input value="<?php echo $nom; ?>" name="nom" class="form-control" id="formateur-nickname" type="text" onblur="lett(this)" placeholder="Enter nickname..." />
                                </div>
                                <div class="form-group">
                                    <label for="formateur-email">Email:</label>
                                    <input value="<?php echo $email; ?>" name="email" class="form-control" id="formateur-email" type="text" onblur="ValidateEmail(this)" placeholder="formateur Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="formateur-email">Adresse:</label>
                                    <input value="<?php echo $adresse; ?>" name="adresse" class="form-control" id="formateur-email" type="text"  placeholder="formateur Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="formateur-email">Code Postal:</label>
                                    <input value="<?php echo $codePostal; ?>" name="codePostal" class="form-control" id="formateur-email" type="text"  placeholder="formateur Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="formateur-email">Pays:</label>
                                    <input value="<?php echo $pays; ?>" name="pays" class="form-control" id="formateur-email" type="text" onblur="lett(this)" placeholder="formateur Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="formateur-email">Ville :</label>
                                    <input value="<?php echo $ville; ?>" name="ville" class="form-control" id="formateur-email" type="text" onblur="lett(this)" placeholder="formateur Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="formateur-email">Nom :</label>
                                    <input value="<?php echo $nomCarte; ?>" name="nomCarte" class="form-control" id="formateur-email" type="text" onblur="lett(this)" placeholder="formateur Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="formateur-email">Num de carte:</label>
                                    <input value="<?php echo $numCarte; ?>" name="numCarte" class="form-control" id="formateur-email" type="text" onblur="numb(this)" placeholder="formateur Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="formateur-email">Mois dexp:</label>
                                    <input value="<?php echo $moisExp; ?>" name="moisExp" class="form-control" id="formateur-email" type="text"  placeholder="formateur Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="formateur-email">Année dexp:</label>
                                    <input value="<?php echo $anneeExp; ?>" name="anneeExp" class="form-control" id="formateur-email" type="text" placeholder="formateur Email..." />
                                </div>
                                <div class="form-group">
                                    <label for="formateur-email">CVV:</label>
                                    <input value="<?php echo $cvv; ?>" name="cvv" class="form-control" id="formateur-email" type="text"  placeholder="formateur Email..." />
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