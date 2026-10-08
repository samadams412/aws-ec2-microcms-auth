<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sam Adams : Contact Results</title>
        <link rel="icon" type="image/icon" href="../hw10/assets/images/tabicon.ico">

        <link href="../hw10/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../hw10/assets/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="../hw10/assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,700i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,700,700i|Josefin+Sans:700" rel="stylesheet">
        <link href="../hw10/assets/css/main.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    </head>

    <body>
        <div id="contact_scroll" class="pages" style="display: block !important; opacity: 1 !important; overflow-y: auto; max-height: 100vh;">
            <div class="container main">
                <div class="row">
                    <div class="col-md-6 left" id="contact_left">
						<div class="btn-group font-sans" style="margin-top: 30px; margin-bottom: 25px; display: flex; flex-wrap: wrap; gap: 5px;">
							<a href="index.html" class="btn btn-rabbit btn-sm">Home</a>
							<a href="hobbies.html" class="btn btn-rabbit btn-sm">Hobbies</a>
							<a href="school.html" class="btn btn-rabbit btn-sm">School</a>
							<a href="work.html" class="btn btn-rabbit btn-sm">Work</a>
							<a href="contact.html" class="btn btn-rabbit btn-sm active" style="background-color: #bb9e7d; color: #fff;">Contact</a>
						</div>
                        
                        <div id="watermark">
                            <h2 class="page-title">Results</h2>
                            <div class="marker">r</div>
                        </div>
                        
                        <p class="subtitle">Submission details from contact form:</p>
                    </div>

                    <div class="col-md-6 right" id="contact_right" style="max-height: 80vh; overflow-y: auto; padding-right: 15px; margin-top: 40px;">
                        <div class="form-title">
                            <h3 style="font-family: 'Josefin Sans', sans-serif; text-transform: uppercase; font-size: 18px; letter-spacing: 1px; color: #111; margin-bottom: 25px;">Contact Form Data</h3>
                        </div>
                        
                        <?php
                            // Check and assign variables safely using approach from lecture
                            if (isset($_GET['firstName']) && $_GET['firstName'] !== NULL && $_GET['firstName'] !== '')
                                $fname = $_GET['firstName'];
                            else
                                $fname = NULL;

                            if (isset($_GET['lastName']) && $_GET['lastName'] !== NULL && $_GET['lastName'] !== '')
                                $lname = $_GET['lastName'];
                            else
                                $lname = NULL;

                            if (isset($_GET['email']) && $_GET['email'] !== NULL && $_GET['email'] !== '')
                                $email = $_GET['email'];
                            else
                                $email = NULL;

                            if (isset($_GET['phone']) && $_GET['phone'] !== NULL && $_GET['phone'] !== '')
                                $phone = $_GET['phone'];
                            else
                                $phone = NULL;

                            if (isset($_GET['username']) && $_GET['username'] !== NULL && $_GET['username'] !== '')
                                $un = $_GET['username'];
                            else
                                $un = NULL;

                            if (isset($_GET['password']) && $_GET['password'] !== NULL && $_GET['password'] !== '')
                                $pw = $_GET['password'];
                            else
                                $pw = NULL;

                            if (isset($_GET['comments']) && $_GET['comments'] !== NULL && $_GET['comments'] !== '')
                                $comments = $_GET['comments'];
                            else
                                $comments = NULL;

                            // Error validation 
                            if ($fname == NULL || $lname == NULL || $email == NULL || $phone == NULL || $un == NULL || $pw == NULL || $comments == NULL)
                            {
                                echo '<h4 style="color: #a94442;">You must fill out the contact form first! All fields are required.</h4>';
                            }
                            else
                            {
                                echo '<p><strong>First Name:</strong> ' . htmlspecialchars($fname) . '</p>'; //htmlspecialchars built in php function to convert into html entities
                                echo '<p><strong>Last Name:</strong> ' . htmlspecialchars($lname) . '</p>';
                                echo '<p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>';
                                echo '<p><strong>Phone Number:</strong> ' . htmlspecialchars($phone) . '</p>';
                                echo '<p><strong>Username:</strong> ' . htmlspecialchars($un) . '</p>';
                                echo '<p><strong>Password:</strong> ' . htmlspecialchars($pw) . '</p>';
                                echo '<p><strong>Comments:</strong> ' . htmlspecialchars($comments) . '</p>';
                            }
                        ?>
                    </div>
                </div>
            </div>            
        </div>            

        <footer class="text-center" style="padding: 20px 0; background: #fff;">
            <div class="container bottom">
                <div class="row">
                    <div class="col-sm-12">
                        <p>Made with <i class="fa fa-heartbeat" aria-hidden="true"></i> by Sam Adams</p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>