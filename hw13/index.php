<?php
// Capture page control variable from URL, default to home if not set
if (!isset($_GET['page'])) {
    $page = "home";
} else {
    $page = $_GET['page'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Dynamic Title based on page variable -->
        <title>Sam Adams : <?php echo ucfirst($page); ?></title>
        <link rel="icon" type="image/icon" href="assets/images/tabicon.ico">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,700i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,700,700i|Josefin+Sans:700" rel="stylesheet">
        <link href="assets/css/main.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    </head>

    <body>
        <!-- Navigation Menu -->
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Sam Adams</a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <?php include("navigation.php"); ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content Section Loaded Dynamic -->
        <div id="content_scroll" class="pages" style="display: block !important; opacity: 1 !important; overflow-y: auto; max-height: 100vh;">
            <div class="container main">
                <div class="row">
                    <?php
                    switch($page) {
                        case "hobbies":
                            include("hobbies.php");
                            break;
                        case "school":
                            include("school.php");
                            break;
                        case "work":
                            include("work.php");
                            break;
                        case "contact":
                            include("contact.php");
                            break;
                        default:
                            include("home.php");
                            break;
                    }
                    ?>
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