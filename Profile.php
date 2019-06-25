<?php
session_start();
require_once 'partials/init.php';
if (!isset($_SESSION['user'])) {
    header('Location:login.php');
    exit();
}
$user = $_SESSION['user'];
$title = "profile";
require_once "partials/headers.php";
?>
    <style>
        .profile-userpic {
            margin-bottom: 20px;
        }
        button {
            margin:10px;
        }
    </style>
<div class="container" style="margin-top: 70px;">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img style="width:100%;max-height:300px;" src="<?php echo $user['profile_picture'];?>" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <h3 class="profile-usertitle-name"><?php echo ucfirst($user["first_name"]) . " " . ucfirst($user["last_name"]);?></h3>
                    <div style="margin: 10px;">
                    <div class="rating">
                        <span class="rating-star" data-value="5"></span>
                        <span class="rating-star" data-value="4"></span>
                        <span class="rating-star" data-value="3"></span>
                        <span class="rating-star" data-value="2"></span>
                        <span class="rating-star" data-value="1"></span>
                    </div>

                    <script>
                    document.body.onload = function () {
                        $('.rating-star').click(function () {
                            $(this).parents('.rating').find('.rating-star').removeClass('checked');
                            $(this).addClass('checked');

                            var submitStars = $(this).attr('data-value');
                        });
                    }
                    </script>
                </div>
                    <div class="profile-usertitle-job">
                        <b >Bio:</b>
                        <div class="well" style="padding: 10px; margin:10px;"><?php echo strlen($user['bio']) > 0 ? $user['bio'] : "No Bio Added.";?></div>
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <button type="button" class="btn btn-info" onclick="location.href='edit.php'"><span class="glyphicon glyphicon-edit" ></span> Edit Info</button> <br/>
                    <button type="button" class="btn btn-warning" onclick="location.href='upload.php'" style="margin-right: 6px;"><span class="glyphicon glyphicon-facetime-video"></span> Upload Video</button>
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="profile-content">
                <?php
                $query = $con->prepare("SELECT * FROM `videos` WHERE `user_upload_id`=?");
                $query->execute(array($user['id']));
                if ($query->rowCount() > 0) {?>
                    <style>
                        .profile-video {
                            margin-bottom: 20px;
                            padding:15px;
                        }
                        .profile-video:not(:last-of-type) {
                            border-bottom:1px solid #444;
                        }
                        .video-heading {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                        }
                    </style>
                <?php
                    $videos = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($videos as $video) {
                        includeFileWithVariables("partials/video-profile-template.php", array(
                            "id" => $video['id'],
                            "title" => $video['title'],
                            "description" => $video['description'],
                            "url" => $video['video_link'],
                            "category" => $video['category']
                        ));
                    }
                } else {
                ?>
                    <h2>No Uploaded Videos</h2>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php require_once "partials/footer.php";