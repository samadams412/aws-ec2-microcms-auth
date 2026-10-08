<?php
// Initialize variables for form values and error states
$firstName = $lastName = $email = $phone = $username = $password = $comments = "";
$errFirstName = $errLastName = $errEmail = $errPhone = $errUsername = $errPassword = $errComments = "";
$hasError = false;
$dbSuccess = false;
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if form was submitted, trim trailing blank spaces (validation runs on raw trimmed values)
if (isset($_POST['submit'])) {
    $firstName = trim($_POST['firstName']);
    $lastName  = trim($_POST['lastName']);
    $email     = trim($_POST['email']);
    $phone     = trim($_POST['phone']);
    $username  = trim($_POST['username']);
    $password  = trim($_POST['password']);
    $comments  = trim($_POST['comments']);

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

    // If validation passed with no errors, apply addslashes and insert into DB
    // Credentials come from the environment, not the source tree — see .env.example
    if (!$hasError) {
        $dbUser = getenv('DB_USER');
        $dbPw = getenv('DB_PASSWORD');
        $host = getenv('DB_HOST') ?: 'localhost';
        $db = "contact_data";

        // Create database connection
        $dblinks = new mysqli($host, $dbUser, $dbPw, $db);

        // Check connection error
        if ($dblinks->connect_error) {
            die("Connection failed: " . $dblinks->connect_error);
        }

        // Escape variables safely right before query execution to handle apostrophes correctly
        $escFirstName = addslashes($firstName);
        $escLastName  = addslashes($lastName);
        $escEmail     = addslashes($email);
        $escPhone     = addslashes($phone);
        $escUsername  = addslashes($username);
        $escPassword  = addslashes($password);
        $escComments  = addslashes($comments);

        // Build SQL insert statement matching column mapping
        $sql = "INSERT INTO `contact_info` (`first_name`, `last_name`, `email`, `user_name`, `phone`, `pass_word`, `comments`) 
                VALUES ('$escFirstName', '$escLastName', '$escEmail', '$escUsername', '$escPhone', '$escPassword', '$escComments')";

        // Execute query or display error
        $dblinks->query($sql) or die("<h3>Something went wrong with<br>$sql</h3>" . $dblinks->error);
        echo '<h2>Data successfully sent to database!</h2>';
        $dbSuccess = true;
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
                
                <?php
                // Show form if not submitted or if there are validation/database errors. Show success results otherwise.
                if (!isset($_POST['submit']) || $hasError):
                ?>
                <form id="contactForm" action="index.php?page=contact" method="POST" novalidate>
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
                ?>
                    <div class="alert alert-success">Form successfully submitted, validated, and saved to the database!</div>
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