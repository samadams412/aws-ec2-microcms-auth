<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("functions.php");
$dblinks = dbConnect("contact_data");

$sql = "SELECT * FROM `contact_info`";
$result = $dblinks->query($sql) or die("<h3>Something went wrong with<br>$sql</h3>" . $dblinks->error);

while ($data = $result->fetch_array(MYSQLI_ASSOC)) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($data['first_name']) . '</td>';
    echo '<td>' . htmlspecialchars($data['last_name']) . '</td>';
    echo '<td>' . htmlspecialchars($data['email']) . '</td>';
    echo '<td>' . htmlspecialchars($data['phone']) . '</td>';
    echo '<td>' . htmlspecialchars($data['user_name']) . '</td>';
    echo '<td>' . htmlspecialchars($data['pass_word']) . '</td>';
    echo '<td>' . htmlspecialchars($data['comments']) . '</td>';
    echo '</tr>';
}
?>