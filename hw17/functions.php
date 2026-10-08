<?php
// Validation helper functions

function validateName($name) {
    // Alphabet characters, hyphens, and apostrophes only
    if (empty($name)) {
        return "empty";
    } elseif (!preg_match("/^[a-zA-Z\-' ]+$/", $name)) {
        return "invalid";
    }
    return "valid";
}

function validateEmail($email) {
    if (empty($email)) {
        return "empty";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "invalid";
    }
    return "valid";
}

function validatePhone($phone) {
    // Digits only
    if (empty($phone)) {
        return "empty";
    } elseif (!ctype_digit($phone)) {
        return "invalid";
    }
    return "valid";
}

// For username, password, and comments
function validateStandard($field) {
    if (empty($field)) {
        return "empty";
    }
    return "valid";
}

// Database Connection Function (ODBC/MySQLi)
// Credentials come from the environment, not the source tree — see .env.example
function dbConnect($dbName) {
    $host = getenv('DB_HOST') ?: 'localhost';
    $dbUser = getenv('DB_USER');
    $dbPw = getenv('DB_PASSWORD');

    $dblinks = new mysqli($host, $dbUser, $dbPw, $dbName);

    if ($dblinks->connect_error) {
        die("Connection failed: " . $dblinks->connect_error);
    }
    
    return $dblinks;
}

function redirect($url) {
    ?>
    <script type="text/javascript">
        document.location.href="<?php echo $url;?>";
    </script>
    <?php
    die();
}
?>