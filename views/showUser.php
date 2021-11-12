<?php
    $isRestricted = false;
    if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
        $isRestricted = true;
}?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
                content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <style>
            body{
                padding-top: 3rem;
            }
            .container {
                width: 400px;
            }
        </style>
    </head>
    <body>
        <div class="container">
        <?php if(!$isRestricted):?>
            <h3>Show User Form</h3>
            <form action="?controller=users&action=update" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$user['id']?>"/>
                <div class="row">
                    <div class="field">
                        <label>Name: <input type="text" name="name" value="<?=$user['name']?>" ></label>
                    </div>
                </div>
                <div class="row">
                    <div class="field">
                        <label>E-mail: <input type="email" name="email" value = "<?=$user['email']?>"><br></label>
                    </div>
                </div>
                <div class="row">
                    <div class="field">
                        <label>Password: <input type="password" name="password" value= "<?=$user['password']?>"><br></label>
                    </div>
                </div>
                <div class="row">
                    <div class="field">
                        <label>
                            <input class="with-gap" type="radio" name="gender" <?php if ($user['gender']=='female'):?>checked<?php endif;?> value="female"/>
                            <span>Female</span>
                        </label>
                    </div>
                    <div class="field">
                        <label>
                            <input class="with-gap"  type="radio" name="gender" <?php if ($user['gender']=='male'):?>checked<?php endif;?> value="male"/>
                            <span>Male</span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Photo</span>
                            <input type="file" name="photo"  accept="image/png, image/gif, image/jpeg" value = "<?=$user['path_to_img']?>"> 
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn" value="Save">
            </form>
            <a class="btn" href="?controller=users">Return to users</a>
        <?php else:?>
        <span>
           You are already logged in <a href="?controller=index&action=logout"><input type="button" class="btn" value="Logout"></a>
        </span>
        <?php endif;?>
        </div>
    </body>
</html>
