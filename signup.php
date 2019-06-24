<?php require_once 'partials/init.php';?>

<?php $scripts = array('signup-script'); ?>
<?php $is_signup = true; ?>
<?php
    session_start();
    $title = "signup";
    if (isset($_SESSION['user'])) {
        header('Location:profile.php');
        exit();
    }
if (isset($error)) {unset($error);}
?>
<?php require_once "partials/headers.php";?>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if (!checkDB('users', 'email', $email)) {
            $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
            $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
            $password = sha1($_POST['pass']);
            $file_upload = upload_files($_FILES['img'], "image");
            $img = is_string($file_upload) ? $file_upload : "images/Anon.png";
            $query = $con->prepare("INSERT INTO `users` (`fname`,`lname`, `email`, `password`, `img`) VALUES (?,?,?,?,?)");
            $query->execute(array($fname, $lname, $email, $password, $img));
            if ($query->rowCount() > 0) {
                $query2 = $con->prepare("SELECT * FROM `users` WHERE `email`=?");
                $query2->execute(array($email));
                $id = $query2->fetchAll(PDO::FETCH_ASSOC)[0]['id'];
                $_SESSION['user'] = array(
                    "email" => $email,
                    "first_name" => $fname,
                    "last_name" => $lname,
                    "profile_picture" => $img,
                    "bio" => "",
                    "id" => $id
                );
                header('Location:profile.php');
                exit();
            }
        } else {
            $error = "This Email Already Exists.";
        }
?>
<?php } ?>
    <style>
        .profile-userpic img {
            float: none;
            margin: 0 auto;
            width: 200px;
            height: 200px;
            -webkit-border-radius: 50% !important;
            -moz-border-radius: 50% !important;
            border-radius: 50% !important;
        }
    </style>

        <div class="Container">
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger"><?php echo $error;?></div>
            <?php } ?>
            <div class="row">
<!--                <div class="col-xs-6 col-md-3">-->
<!--                    <div class="profile-userpic" style="margin-top: 150px;margin-left: 50px;">-->
<!--                        <img src="--><?php //echo $images_path;?><!--/Anon.png" alt="..." id="item">-->
<!--                    </div>-->
<!--                </div>-->
                <div class="col-xs-8 col-xs-offset-2">
                    <form id="registerForm" style="border:5px; margin-top: 120px;" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputName1">First name</label>
                            <input required type="text" name="fname" class="form-control" id="exampleInputName1" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Last name</label>
                            <input required type="text" name="lname" class="form-control" id="exampleInputName2" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input required type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input required type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">Confirm Password</label>
                            <input required type="password" name="passc" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Profile photo</label>
                            <input type="file" id="exampleInputFile" name="img">
                            <p class="help-block">Upload profile picture</p>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input required type="checkbox" name="terms"> Agree on Our Terms of Privacy & Use.
                            </label>
                        </div>
                        <button id="signup-btn" type="submit" class="btn btn-warning" style="width:150px;">Submit</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
<?php require_once "partials/footer.php"?>
