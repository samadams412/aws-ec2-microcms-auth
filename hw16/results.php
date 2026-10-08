<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sam Adams : Contact Results</title>
        <link rel="icon" type="image/icon" href="../hw11/assets/images/tabicon.ico">

        <link href="../hw11/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../hw11/assets/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="../hw11/assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,700i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,700,700i|Josefin+Sans:700" rel="stylesheet">
        <link href="../hw11/assets/css/main.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
		<script src="assets/js/jquery-3.5.1.js"></script>
    </head>

    <body>
        <div id="contact_scroll" class="pages" style="display: block !important; opacity: 1 !important; overflow-y: auto; max-height: 100vh;">
            <div class="container main" style="width: 90%; max-width: 1200px;">
                <div class="row">
                    <div class="col-md-12">

                        
                        <div id="watermark">
                            <h2 class="page-title">Results</h2>
                            <div class="marker">r</div>
                        </div>
                        
                        <p class="subtitle">Submission details from your database records:</p>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Comments</th>
                                    </tr>
                                </thead>
                                <tbody id="results">
                                    <!-- Dynamic AJAX results injected here -->
                                </tbody>
                            </table>
                        </div>
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

        <!-- jQuery and AJAX script integration -->
      
        <script>
            function refresh_data(){
                $.ajax({
                    type: 'get',
                    url: 'query_contacts.php',
                    success: function(data){
                        $('#results').html(data);
                    }
                });
            }
            // Run immediately on page load, then refresh every 500ms
            refresh_data();
            setInterval(function(){ refresh_data(); }, 500);
        </script>
    </body>
</html>