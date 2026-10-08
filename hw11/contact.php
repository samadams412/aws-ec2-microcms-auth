<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sam Adams : Contact</title>
        <link rel="icon" type="image/icon" href="../hw11/assets/images/tabicon.ico">

        <link href="../hw11/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../hw11/assets/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="../hw11/assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,700i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,700,700i|Josefin+Sans:700" rel="stylesheet">
        <link href="../hw11/assets/css/main.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    </head>

    <body>
        <div id="contact_scroll" class="pages" style="display: block !important; opacity: 1 !important; overflow-y: auto; max-height: 100vh;">
            <div class="container main">
                <div class="row">
                    <div class="col-md-6 left" id="contact_left">
                        <!-- Multi-page Active Navigation Menu -->
						<div class="btn-group font-sans" style="margin-top: 30px; margin-bottom: 25px; display: flex; flex-wrap: wrap; gap: 5px;">
							<a href="index.html" class="btn btn-rabbit btn-sm">Home</a>
							<a href="hobbies.html" class="btn btn-rabbit btn-sm">Hobbies</a>
							<a href="school.html" class="btn btn-rabbit btn-sm">School</a>
							<a href="work.html" class="btn btn-rabbit btn-sm">Work</a>
							<a href="contact.php" class="btn btn-rabbit btn-sm active" style="background-color: #bb9e7d; color: #fff;">Contact</a>
						</div>
                        
                        <div id="watermark">
                            <h2 class="page-title">Contact</h2>
                            <div class="marker">c</div>
                        </div>
                        
                        <p class="subtitle">You can reach me via the following channels:</p>
                        
                        <div class="info" style="font-size: 16px; line-height: 30px; margin-top: 20px;">
                            <p>
                                <i class="fa fa-envelope" aria-hidden="true" style="color: #bb9e7d; width: 25px;"></i> 
                                <strong>Email:</strong> <a href="mailto:samuel.adams@my.utsa.edu">samuel.adams@my.utsa.edu</a>
                            </p>
                            <p>
                                <i class="fa fa-github" aria-hidden="true" style="color: #bb9e7d; width: 25px;"></i> 
                                <strong>GitHub:</strong> <a href="https://github.com/samadams412" target="_blank">Visit my GitHub Profile</a>
                            </p>
                            <p>
                                <i class="fa fa-globe" aria-hidden="true" style="color: #bb9e7d; width: 25px;"></i> 
                                <strong>Website:</strong> <a href="https://samuelkadams.com" target="_blank">samuelkadams.com</a>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 right" id="contact_right" style="max-height: 80vh; overflow-y: auto; padding-right: 15px;">
                        <div class="form-title">
                            <h3 style="font-family: 'Josefin Sans', sans-serif; text-transform: uppercase; font-size: 18px; letter-spacing: 1px; color: #111; margin-bottom: 25px;">Send A Message</h3>
                        </div>
                        
                        <?php
                            // Display error banner if redirected from results.php
                            if (isset($_GET['err']) && $_GET['err'] == "dataNull")
                            {
                                echo '<div class="alert alert-danger">Please fill out the form before loading results!</div>';
                            }
                        ?>
                        
                        <form id="contactForm" action="results.php" method="POST" novalidate>
                            <!-- First Name -->
                            <div class="form-group" id="fg-firstName">
                                <label class="control-label" for="firstName">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
                                <span class="help-block" id="err-firstName"></span>
                            </div>

                            <!-- Last Name -->
                            <div class="form-group" id="fg-lastName">
                                <label class="control-label" for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
                                <span class="help-block" id="err-lastName"></span>
                            </div>

                            <!-- Email -->
                            <div class="form-group" id="fg-email">
                                <label class="control-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                <span class="help-block" id="err-email"></span>
                            </div>

                            <!-- Phone Number -->
                            <div class="form-group" id="fg-phone">
                                <label class="control-label" for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number (10 digits, no hyphens/parentheses)">
                                <span class="help-block" id="err-phone"></span>
                            </div>

                            <!-- Username -->
                            <div class="form-group" id="fg-username">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                <span class="help-block" id="err-username"></span>
                            </div>

                            <!-- Password -->
                            <div class="form-group" id="fg-password">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <span class="help-block" id="err-password"></span>
                            </div>

                            <!-- Comments -->
                            <div class="form-group" id="fg-comments">
                                <label class="control-label" for="comments">Comments</label>
                                <textarea class="form-control" id="comments" name="comments" rows="5" placeholder="Comments"></textarea>
                                <span class="help-block" id="err-comments"></span>
                            </div>

                            <button type="submit" class="btn btn-rabbit submit">Send Message</button>
                        </form>
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