<?php
if (!isset($_SESSION['user-id']) && !isset($_SESSION['logged-in'])) {
    header("location: " . base_url() . "user");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script>
        var baseUrl = "<?php echo base_url(); ?>";
    </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3">
            <div class="container">
                <a class="navbar-brand" href="<?php echo base_url('dashboard/dashBoardHome') ?>">User Dashboard</a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <div class="text-right" style="float: right">
                            <a href="<?php echo base_url('user/logout') ?>" class="btn btn-outline-info">Log Out</a>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</body>