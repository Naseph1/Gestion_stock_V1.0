<!DOCTYPE html>
<?php require('action/loginaction.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="asset/css/login.css">
</head>
<body>
    <div class="form__contain">
        <div class="form-container">
            <p class="title">Sign In</p>
            <?php if (isset($errormsg) && isset($_POST['validate'])) { echo $errormsg; }?>
            <form class="form" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="">
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="">
                    <div class="forgot">
                        <a rel="noopener noreferrer" href="#"></a>
                    </div>
                </div>
                <button class="sign" name="validate">Sign in</button>
            </form>
        </div>
    </div>
</body>
</html>