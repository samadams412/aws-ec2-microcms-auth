<?php
include("functions.php");

// Initialize variables for form values and error states
$firstName = $lastName = $email = $phone = $username = $password = $comments = "";
$errFirstName = $errLastName = $errEmail = $errPhone = $errUsername = $errPassword = $errComments = "";
$hasError = false;

// Check if form was submitted, trim trailing blank spaces
if (isset($_POST['submit'])) {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $comments = trim($_POST['comments']);

    // Validate First Name
    $fnCheck = validateName($firstName);
    if ($fnCheck == "empty") {
        $errFirstName = "First name cannot be blank.";
        $hasError = true;
    } elseif ($fnCheck == "invalid") {
        $errFirstName = "First name may only contain letters, hyphens, and apostrophes.";
        $hasError = true;
    }

    // Validate Last Name
    $lnCheck = validateName($lastName);
    if ($lnCheck == "empty") {
        $errLastName = "Last name cannot be blank.";
        $hasError = true;
    } elseif ($lnCheck == "invalid") {
        $errLastName = "Last name may only contain letters, hyphens, and apostrophes.";
        $hasError = true;
    }

    // Validate Email
    $emailCheck = validateEmail($email);
    if ($emailCheck == "empty") {
        $errEmail = "Email cannot be blank.";
        $hasError = true;
    } elseif ($emailCheck == "invalid") {
        $errEmail = "Please enter a valid email address format.";
        $hasError = true;
    }

    // Validate Phone
    $phoneCheck = validatePhone($phone);
    if ($phoneCheck == "empty") {
        $errPhone = "Phone number cannot be blank.";
        $hasError = true;
    } elseif ($phoneCheck == "invalid") {
        $errPhone = "Phone number may only contain digits.";
        $hasError = true;
    }

    // Validate Username
    if (validateStandard($username) == "empty") {
        $errUsername = "Username cannot be blank.";
        $hasError = true;
    }

    // Validate Password
    if (validateStandard($password) == "empty") {
        $errPassword = "Password cannot be blank.";
        $hasError = true;
    }

    // Validate Comments
    if (validateStandard($comments) == "empty") {
        $errComments = "Comments cannot be blank.";
        $hasError = true;
    }

    // If no errors, proceed to results/success handling
    if (!$hasError) {
        // Can render results here later on
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sam Adams : Contact</title>
        <link rel="icon" type="image/icon" href="../hw12/assets/images/tabicon.ico">

        <link href="../hw12/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../hw12/assets/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="../hw12/assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,700i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,700,700i|Josefin+Sans:700" rel="stylesheet">
        <link href="../hw12/assets/css/main.css" rel="stylesheet">
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
                        // Show form if not submitted or if there are errors. Show success results if successfully validated.
                        if (!isset($_POST['submit']) || $hasError):
                        ?>
						<!-- check if the err variable is not empty if so add has-error otherwise empty class attr using ternary operator for each field -->
                        <form id="contactForm" action="" method="POST" novalidate>
                            <!-- First Name -->
                            <div class="form-group <?php echo (!empty($errFirstName)) ? 'has-error' : ''; ?>" id="fg-firstName">
                                <label class="control-label" for="firstName">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" placeholder="First Name">
                                <span class="help-block"><?php echo $errFirstName; ?></span>
                            </div>

                            <!-- Last Name -->
                            <div class="form-group <?php echo (!empty($errLastName)) ? 'has-error' : ''; ?>" id="fg-lastName">
                                <label class="control-label" for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" placeholder="Last Name">
                                <span class="help-block"><?php echo $errLastName; ?></span>
                            </div>

                            <!-- Email -->
                            <div class="form-group <?php echo (!empty($errEmail)) ? 'has-error' : ''; ?>" id="fg-email">
                                <label class="control-label" for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Email">
                                <span class="help-block"><?php echo $errEmail; ?></span>
                            </div>

                            <!-- Phone Number -->
                            <div class="form-group <?php echo (!empty($errPhone)) ? 'has-error' : ''; ?>" id="fg-phone">
                                <label class="control-label" for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" placeholder="Phone Number">
                                <span class="help-block"><?php echo $errPhone; ?></span>
                            </div>

                            <!-- Username -->
                            <div class="form-group <?php echo (!empty($errUsername)) ? 'has-error' : ''; ?>" id="fg-username">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" placeholder="Username">
                                <span class="help-block"><?php echo $errUsername; ?></span>
                            </div>

                            <!-- Password -->
                            <div class="form-group <?php echo (!empty($errPassword)) ? 'has-error' : ''; ?>" id="fg-password">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" placeholder="Password">
                                <span class="help-block"><?php echo $errPassword; ?></span>
                            </div>

                            <!-- Comments -->
                            <div class="form-group <?php echo (!empty($errComments)) ? 'has-error' : ''; ?>" id="fg-comments">
                                <label class="control-label" for="comments">Comments</label>
                                <textarea class="form-control" id="comments" name="comments" rows="5" placeholder="Comments"><?php echo htmlspecialchars($comments); ?></textarea>
                                <span class="help-block"><?php echo $errComments; ?></span>
                            </div>

                            <button type="submit" name="submit" value="submit" class="btn btn-rabbit submit">Send Message</button>
                        </form>

                        <?php 
                        else: 
                            // Success (hasError flag is false and button is submit)
							// Currently password is displayed in plain text which should be updated for a production app
                        ?>
                            <div class="alert alert-success">Form successfully submitted and validated!</div>
                            <p><strong>First Name:</strong> <?php echo htmlspecialchars($firstName); ?></p>
                            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($lastName); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($phone); ?></p>
                            <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
                            <p><strong>Password:</strong> <?php echo htmlspecialchars($password); ?></p> 
                            <p><strong>Comments:</strong> <?php echo htmlspecialchars($comments); ?></p>
                        <?php endif; ?>
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