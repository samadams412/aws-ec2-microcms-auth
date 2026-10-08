<?php
// Initialize variables for form values and error states
$firstName = $lastName = $email = $phone = $username = $password = $comments = "";
$errFirstName = $errLastName = $errEmail = $errPhone = $errUsername = $errPassword = $errComments = "";
$hasError = false;

// Enable error reporting for debugging
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include_once("functions.php");

// Check if form was submitted
if (isset($_POST['submit'])) {
    $firstName = trim($_POST['firstName']);
    $lastName  = trim($_POST['lastName']);
    $email     = trim($_POST['email']);
    $phone     = trim($_POST['phone']);
    $username  = trim($_POST['username']);
    $password  = trim($_POST['password']);
    $comments  = trim($_POST['comments']);

    // Validate fields
    if (validateName($firstName) != "valid") { $errFirstName = "Invalid first name."; $hasError = true; }
    if (validateName($lastName) != "valid") { $errLastName = "Invalid last name."; $hasError = true; }
    if (validateEmail($email) != "valid") { $errEmail = "Invalid email format."; $hasError = true; }
    if (validatePhone($phone) != "valid") { $errPhone = "Invalid phone digits."; $hasError = true; }
    if (validateStandard($username) != "valid") { $errUsername = "Username required."; $hasError = true; }
    if (validateStandard($password) != "valid") { $errPassword = "Password required."; $hasError = true; }
    if (validateStandard($comments) != "valid") { $errComments = "Comments required."; $hasError = true; }

    // If validation passed, connect via dbConnect() and insert
    if (!$hasError) {
        $dblinks = dbConnect("contact_data");

        $escFirstName = addslashes($firstName);
        $escLastName  = addslashes($lastName);
        $escEmail     = addslashes($email);
        $escPhone     = addslashes($phone);
        $escUsername  = addslashes($username);
        $escPassword  = addslashes($password);
        $escComments  = addslashes($comments);

        $sql = "INSERT INTO `contact_info` (`first_name`, `last_name`, `email`, `user_name`, `phone`, `pass_word`, `comments`) 
                VALUES ('$escFirstName', '$escLastName', '$escEmail', '$escUsername', '$escPhone', '$escPassword', '$escComments')";

        $dblinks->query($sql) or die("<h3>Something went wrong with<br>$sql</h3>" . $dblinks->error);
        
        
        redirect("results.php");
    }
}
?>

<div id="contact_scroll" class="pages" style="display: block !important; opacity: 1 !important; overflow-y: auto; max-height: 100vh;">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 left" id="contact_left">
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
                
                <form id="contactForm" action="index.php?page=contact" method="POST" novalidate>
                    <div class="form-group <?php echo (!empty($errFirstName)) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
                        <span class="help-block"><?php echo $errFirstName; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($errLastName)) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
                        <span class="help-block"><?php echo $errLastName; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($errEmail)) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                        <span class="help-block"><?php echo $errEmail; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($errPhone)) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                        <span class="help-block"><?php echo $errPhone; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($errUsername)) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
                        <span class="help-block"><?php echo $errUsername; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($errPassword)) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
                        <span class="help-block"><?php echo $errPassword; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($errComments)) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="comments">Comments</label>
                        <textarea class="form-control" id="comments" name="comments" rows="5"><?php echo htmlspecialchars($comments); ?></textarea>
                        <span class="help-block"><?php echo $errComments; ?></span>
                    </div>

                    <button type="submit" name="submit" value="submit" class="btn btn-rabbit submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>        
</div>