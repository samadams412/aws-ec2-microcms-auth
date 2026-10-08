<?php
switch($page) {
    case "hobbies":
        echo '<li><a href="index.php">Home</a></li>';
        echo '<li class="active"><a href="index.php?page=hobbies">Hobbies</a></li>';
        echo '<li><a href="index.php?page=school">School</a></li>';
        echo '<li><a href="index.php?page=work">Work</a></li>';
        echo '<li><a href="index.php?page=contact">Contact</a></li>';
        break;
    case "school":
        echo '<li><a href="index.php">Home</a></li>';
        echo '<li><a href="index.php?page=hobbies">Hobbies</a></li>';
        echo '<li class="active"><a href="index.php?page=school">School</a></li>';
        echo '<li><a href="index.php?page=work">Work</a></li>';
        echo '<li><a href="index.php?page=contact">Contact</a></li>';
        break;
    case "work":
        echo '<li><a href="index.php">Home</a></li>';
        echo '<li><a href="index.php?page=hobbies">Hobbies</a></li>';
        echo '<li><a href="index.php?page=school">School</a></li>';
        echo '<li class="active"><a href="index.php?page=work">Work</a></li>';
        echo '<li><a href="index.php?page=contact">Contact</a></li>';
        break;
    case "contact":
        echo '<li><a href="index.php">Home</a></li>';
        echo '<li><a href="index.php?page=hobbies">Hobbies</a></li>';
        echo '<li><a href="index.php?page=school">School</a></li>';
        echo '<li><a href="index.php?page=work">Work</a></li>';
        echo '<li class="active"><a href="index.php?page=contact">Contact</a></li>';
        break;
    default:
        echo '<li class="active"><a href="index.php">Home</a></li>';
        echo '<li><a href="index.php?page=hobbies">Hobbies</a></li>';
        echo '<li><a href="index.php?page=school">School</a></li>';
        echo '<li><a href="index.php?page=work">Work</a></li>';
        echo '<li><a href="index.php?page=contact">Contact</a></li>';
        break;
}
?>