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

        <?php
        if (isset($_POST['response'])) {
            $id = $_POST['id'];
            $url = "http://localhost/FoodHaus/backend/reply.php?id=" . $id;
            header("Location: {$url}");
        }
        ?>


        <div id="layoutSidenav_content">
            <main>
                <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
                    <div class="container-fluid">
                        <div class="page-header-content">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="mail"></i></div>
                                <span>Reply</span>
                            </h1>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_POST['send-reply'])) {
                    $reply = trim($_POST['reply']);
                    $sql = "UPDATE messages SET ms_status = :status, ms_state = :state, reply = :reply WHERE ms_id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':status' => 'Processed',
                        ':state' => 1,
                        ':reply' => $reply,
                        ':id' => $_GET['id']
                    ]);
                    header("Location: messages.php");

                    if (isset($_COOKIE['_uid_'])) {
                        $user_id = base64_decode($_COOKIE['_uid_']);
                    } else if (isset($_SESSION['user_id'])) {
                        $user_id = $_SESSION['user_id'];
                    } else {
                        $user_id = -1;
                    }

                    $sql = "SELECT * FROM users WHERE user_id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':id' => $user_id
                    ]);
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    $user_name = $user['user_name'];
                    $user_mail = $user['user_email'];

                    require 'phpmailer/PHPMailerAutoload.php';
                    $mail = new PHPMailer;
                    $mail->addBCC($user_mail, $user_name);

                    $message = '<div class="app font-sans min-w-screen min-h-screen bg-grey-lighter py-8 px-4">

									<div class="mail__wrapper max-w-md mx-auto">
								  
									  <div class="mail__content bg-white p-8 shadow-md">
								  
										
								  
										<div class="content__body py-8 border-b">
										  <p>
											Hey, <br><br> we responded to your message, please check our site for more details
										  </p>
										  <a href="http://localhost/FoodHaus/index.php" <button class="btn3 flex-c-m size31 txt11 trans-0-4" >Visit our website</button> </a>
										  <p class="text-sm">
											Keep Rockin!<br> FoodHaus Team
										  </p>
										</div>
								  
										<div class="content__footer mt-8 text-center text-grey-darker">
										  <h3 class="text-base sm:text-lg mb-4">Thanks for using Our site!</h3>
										 
										</div>
								  
									  </div>
								  
									  <div class="mail__meta text-center text-sm text-grey-darker mt-8">
								  
										
								  
										<div class="meta__help">
										  <p class="leading-loose">
											Questions or concerns? <a href="http://localhost/FoodHaus/contact.php" class="text-grey-darkest">help@Foodhaus.com</a>
								  
										  </p>
										</div>
								  
									  </div>
								  
									</div>
								  
								  </div>';
                    $subject = "Response";

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
                    $mail->send();
                }
                ?>

                <!--Start Form-->
                <div class="container-fluid mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">Reponse Area:</div>
                        <div class="card-body">
                            <?php
                            $sql = "SELECT * FROM messages WHERE ms_id = :id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([':id' => $_GET['id']]);
                            $ms = $stmt->fetch(PDO::FETCH_ASSOC);
                            $ms_detail = $ms['ms_detail'];
                            ?>
                            <?php
                            if (isset($_COOKIE['_uid_'])) {
                                $user_id = base64_decode($_COOKIE['_uid_']);
                            } else if (isset($_SESSION['user_id'])) {
                                $user_id = $_SESSION['user_id'];
                            } else {
                                $user_id = -1;
                            }
                            $sql = "SELECT * FROM users WHERE user_id = :id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([
                                ':id' => $user_id
                            ]);
                            $user = $stmt->fetch(PDO::FETCH_ASSOC);
                            $user_name = $user['user_name'];
                            $user_mail = $user['user_email'];
                            ?>
                            <form action="reply.php?id=<?php echo $_GET['id']; ?>" method="POST">
                                <div class="form-group">
                                    <label for="post-content">Message:</label>
                                    <textarea class="form-control" placeholder="Type here..." id="post-content" rows="9" readonly="true"><?php echo $ms_detail; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="user-name">User name:</label>
                                    <input name="user-name" value="<?php echo $user_name; ?>" class="form-control" id="user-name" type="text" placeholder="User name ..." readonly="true" value="Md. A. Barik" />
                                </div>

                                <div class="form-group">
                                    <label for="post-tags">Reply:</label>
                                    <textarea name="reply" class="form-control" placeholder="Type your reply here..." id="post-tags" rows="9"></textarea>
                                </div>

                                <button name="send-reply" class="btn btn-primary mr-2 my-1" type="submit">Send response</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--End Form-->

            </main>

            <?php require_once('./includes/footer.php'); ?>