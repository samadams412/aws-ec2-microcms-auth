<?php
// login.php - User Login Module
$errMessage = "";

if (isset($_POST['submit'])) {
    $userName = $_POST['username'];
    $pw = $_POST['password'];
    
    $salt = "CS4413SU26"; // Salting string
    $pwHash = hash('sha256', $salt . $pw . $userName);
    
    $sql = "SELECT `auto_id` FROM `accounts` WHERE `username` = ? AND `pw_hash` = ?";
    $dblinks = dbConnect("contact_data");
    
    $stmt = $dblinks->prepare($sql);
    $stmt->bind_param("ss", $userName, $pwHash);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        // Invalid credentials provided
        redirect("index.php?page=login&msg=Invalid");
    } else {
        // Valid credentials provided
        $info = $result->fetch_array(MYSQLI_ASSOC);
        $timeSalt = microtime(); // Get unix timestamp in microseconds
        $sid = hash('sha256', $timeSalt . $pwHash);
        
        $updateSql = "UPDATE `accounts` SET `session_id` = ? WHERE `auto_id` = ?";
        $updStmt = $dblinks->prepare($updateSql);
        $updStmt->bind_param("si", $sid, $info['auto_id']);
        $updStmt->execute();
        $updStmt->close();
        
        redirect("index.php?page=results&sid=" . $sid);
    }
}
?>

<div class="col-md-12">
    <div id="watermark">
        <h2 class="page-title">Login</h2>
        <div class="marker">l</div>
    </div>
    <p class="subtitle">Sign in to your account:</p>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'Invalid'): ?>
        <div class="alert alert-danger">Invalid username or password. Please try again.</div>
    <?php elseif (isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
        <div class="alert alert-success">Registration successful! Please log in below.</div>
    <?php endif; ?>

    <form action="index.php?page=login" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" name="submit" class="btn btn-rabbit">Log In</button>
    </form>
</div>