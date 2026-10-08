<?php
// register.php - User Registration Module
$username = $password = "";
$errMessage = "";

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $errMessage = "All fields are required.";
    } else {
        $dblink = dbConnect("contact_data");
        
        // Check for pre-existing username
        $chkSql = "SELECT `auto_id` FROM `accounts` WHERE `username` = ?";
        $stmt = $dblink->prepare($chkSql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            redirect("index.php?page=register&err=exists");
        } else {
            $stmt->close();
            
            // Hash password using SHA-256 with a custom salt
            $salt = "CS4413SU26";
            $pwHash = hash('sha256', $salt . $password . $username);

            // Insert new account record
            $insSql = "INSERT INTO `accounts` (`username`, `pw_hash`) VALUES (?, ?)";
            $insStmt = $dblink->prepare($insSql);
            $insStmt->bind_param("ss", $username, $pwHash);
            $insStmt->execute();
            $insStmt->close();

            redirect("index.php?page=login&msg=success");
        }
    }
}
?>

<div class="col-md-12">
    <div id="watermark">
        <h2 class="page-title">Register</h2>
        <div class="marker">r</div>
    </div>
    <p class="subtitle">Create a new account to access system results:</p>

    <?php if (isset($_GET['err']) && $_GET['err'] == 'exists'): ?>
        <div class="alert alert-danger">Username already exists. Please choose another.</div>
    <?php endif; ?>

    <form action="index.php?page=register" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" name="submit" class="btn btn-rabbit">Register</button>
    </form>
</div>