<div class="profile-video">
    <?php if (isset($category)) { ?>
    <div class="video-heading">
        <h2 class="text-capitalize"><?php echo $title;?></h2>
        <span><?php echo $category;?></span>
    </div>

    <?php } else { ?>
    <h2 class="text-capitalize"><?php echo $title;?></h2>
    <?php } ?>
    <div>
        <video width="100%" src="<?php echo $url;?>" controls></video>
    </div>
    <p class="lead"><?php echo $description;?></p>
</div>
