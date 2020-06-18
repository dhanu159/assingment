<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- font owsome -->
    <script src="https://kit.fontawesome.com/97b061d3ee.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo base_url('resources/css/custom.css') ?>">
</head>

<body id="loginBody">

    <div class="container my-auto" style="transform: translatey(+5%)">
        <div class="mx-auto jumbotron" id="login-form-wrapper">
            <div class="text-center mx-auto">
                <img class="img-fluid" src="<?php echo base_url('resources/img/login-user.png') ?>" alt="" style="width: 40%">
                <h3 class="h2">Sign in</h3>

                <!-- validation errors -->
                <?php
                if (validation_errors()) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button class="close" type="button" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        <p><?php echo validation_errors(); ?></p>
                    </div>

                <?php } ?>

                <!-- login errors -->
                <?php
                if (isset($userExist) && !$userExist) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button class="close" type="button" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        <p><?php echo $msg; ?></p>
                    </div>

                <?php } ?>

            </div>
            <?php echo form_open(base_url('user/login')) ?>
            <div class="form-group">
                <label for="user-name">Username :</label>
                <input type="email" class="form-control" name="user-name">
            </div>
            <div class="form-group">
                <label for="passwrod">Password :</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="row form-group">
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
                </div>
            </div>
            </form>
        </div>

    </div>




    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


</body>

</html>