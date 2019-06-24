<?php
session_start();
require_once 'partials/init.php';
if (!isset($_SESSION['user'])) {
    header('Location:login.php');
    exit();
}
$user = $_SESSION['user'];
$title = "Edit Profile";
$scripts = array("croppie", "signup-script");
$styles = array("croppie");
require_once "partials/headers.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
    $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
    $id = $_SESSION['user']['id'];
    if ($_FILES['img']["name"] != "") {
        $file_upload = upload_files($_FILES['img'], "image");
        $img = $file_upload;
    } else {
        $img = $_SESSION['user']['profile_picture'];
    }
    $query = $con->prepare("UPDATE `users` SET `fname`=?,`lname`=?,`bio`=?, `img`=? WHERE id=?");
    $query->execute(array($fname, $lname, $bio, $img, $id));
    if ($query->rowCount() > 0) {
        $_SESSION['user'] = array(
            "email" => $_SESSION['user']['email'],
            "first_name" => $fname,
            "last_name" => $lname,
            "profile_picture" => $img,
            "bio" => $bio,
            "id" => $id
        );
        header("Location:profile.php");
    }
}
?>
		<div class="Container">
			<div class="row">
				<div class="col-xs-4">
					<div class="row">
						<div class="">
							<div class="profile-userpic" style="margin-top: 150px;">
							    <img style="width:100%;max-height:300px;" src="<?php echo $user['profile_picture'];?>" alt="..." id="item">
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-4">
					<form style="border:5px; margin-top: 120px;" id="registerForm" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <div class="form-group">
                            <label for="exampleInputName1">First Name</label>
                            <input name="fname" type="text" class="form-control" id="exampleInputName1" value="<?php echo $user['first_name'];?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName2">Last Name</label>
                            <input name="lname" type="text" class="form-control" id="exampleInputName2" value="<?php echo $user['last_name'];?>">
                        </div>
						<div class="form-group">
						    <label for="exampleInputName3">Bio</label><br/>
						    <textarea name="bio" style="height: 150px; width: 360px;padding: 6px 12px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;" id="exampleInputName3"><?php echo $user['bio'];?></textarea>
						</div>
						<div class="form-group">
						    <label for="exampleInputFile">Profile Picture</label>
						    <input type="file" name="img" id="exampleInputFile">
						    <p class="help-block">Choose another picture you want to upload</p>
						</div>
						<button type="submit" id="signup-btn" class="btn btn-success" style="width:150px;">Confirm</button>
						<button type="reset" class="btn btn-default">Cancel</button>
					</form>
				</div>
			</div>
		</div>
<?php require_once "partials/footer.php"; ?>