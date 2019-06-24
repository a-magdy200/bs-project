<?php
session_start();
require_once '../partials/init.php';




/**
 * Library Requirements
 *
 * 1. Install composer (https://getcomposer.org)
 * 2. On the command line, change to this directory (api-samples/php)
 * 3. Require the google/apiclient library
 *    $ composer require google/apiclient:~2.0
 */
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    throw new \Exception('please run "composer require google/apiclient:~2.0" in "' . __DIR__ .'"');
}
require_once __DIR__ . '/vendor/autoload.php';

    /*
     * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
     * {{ Google Cloud Console }} <{{ https://cloud.google.com/console }}>
     * Please ensure that you have enabled the YouTube Data API for your project.
     */

    $client = new Google_Client();
    $client->setDeveloperKey($DEVELOPER_KEY);

    // Define an object that will be used to make all API requests.
    $youtube = new Google_Service_YouTube($client);

    $videos = array();
    try {

        // Call the search.list method to retrieve results matching the specified
        // query term.
        $query_search = isset($_GET['q']) ? $_GET['q'] : 'hole';
        
        $searchResponse = $youtube->search->listSearch('id,snippet', array(
            'q' => $query_search,
            'maxResults' => 5 ,
            'type' => 'video',
            'videoCategoryId' => 27 ,   //education
        ));


        $videos = [];

        foreach ($searchResponse['items'] as $searchResult) {


            $title = $searchResult['snippet']['title'];
            $img = $searchResult['snippet']['thumbnails']['default']['url'];
            $videoId = $searchResult['id']['videoId'];
            $description = $searchResult['snippet']['description'];

            $video = array(
                'title'=>$title,
                'description'=>$description,
                'img'=>$img,
                'category'=>'Education',
                'id' => $videoId
            );

            if (!checkDB('videos', 'youtube_id', $videoId))
            {
                $query = $con->prepare("INSERT INTO `videos` (`youtube_id`,`title`,`description`,`img`) VALUES (?,?,?,?)");
                $query->execute(array($videoId, $title, $description, $img));
                $video['rating'] = 0;
            } else {
                $query = $con->prepare("SELECT average_rating FROM videos WHERE youtube_id=?");
                $query->execute(array($videoId));
                $rating = $query->fetchAll(PDO::FETCH_ASSOC)[0]['average_rating'];
                $video['rating'] = $rating;
            }
            array_push($videos, $video);

        }

        $searchResponse = $youtube->search->listSearch('id,snippet', array(
            'q' => $query_search,
            'maxResults' => 5 ,
            'type' => 'video',
            'videoCategoryId' => 28 ,   //education
        ));
        foreach ($searchResponse['items'] as $searchResult) {

            $title = $searchResult['snippet']['title'];
            $img = $searchResult['snippet']['thumbnails']['default']['url'];
            $videoId = $searchResult['id']['videoId'];
            $description = $searchResult['snippet']['description'];
            $videoLink = 'https://www.youtube.com/watch?v=' . $videoId;
            $video = array(
                'title'=>$title,
                'description'=>$description,
                'img'=>$img,
                'category'=>'Science & Technology',
                'id' => $videoId
            );
            
            if (!checkDB('videos', 'youtube_id', $videoId))
            {
                $query = $con->prepare("INSERT INTO `videos` (`youtube_id`,`title`,`description`,`img`) VALUES (?,?,?,?)");
                $query->execute(array($videoId, $title, $description, $img));
                $video['rating'] = 0;
            } else {
                $query = $con->prepare("SELECT average_rating FROM videos WHERE youtube_id=?");
                $query->execute(array($videoId));
                $rating = $query->fetchAll(PDO::FETCH_ASSOC)[0]['average_rating'];
                $video['rating'] = $rating;
            }
            array_push($videos,$video);

        }

    } catch (Google_Service_Exception $e) {
        echo htmlspecialchars($e->getMessage());
    } catch (Google_Exception $e) {
        echo htmlspecialchars($e->getMessage());
    }


?>
<?php require_once "../partials/headers.php";?>
<div style="margin-top:70px"></div>
<?php if (isset($_GET['id'])) { ?>
    <?php
    $i = 0;
        foreach ($videos as $video) {
            if ($video['id'] == $_GET['id']) {
                $current_video = $video;
                array_splice($videos, $i, 1);
                $query2 = $con->prepare("SELECT * FROM `videos` WHERE youtube_id = ?");
                $query2->execute(array($current_video['id']));
                $ajax_id = $query2->fetchAll(PDO::FETCH_ASSOC)[0]['id'];
                break;
            }
            $i++;
        }
    ?>
    <div class="row">
        <div class="col-sm-7" style="padding-top: 40px; padding-left: 40px;">
            <!-- 16:9 aspect ratio -->
            <div class="embed-responsive embed-responsive-16by9">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $current_video['id'];?>?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <div class="col-sm-5" style="padding-top: 50px; padding-right: 50px;">
            <div class="panel panel-warning">
                <div class="panel-footer">
                    <b><h4><?php echo $current_video['title'];?></h4></b>
                    <?php if (isset($_SESSION['user'])) { ?>
                    <div>
                        <?php
                            $query3 = $con->prepare("SELECT * FROM `user_rating_videos` WHERE user_id=? AND video_id=?");
                            $query3->execute(array($_SESSION['user']['id'], $ajax_id));
                            $user_rated = $query3->rowCount() > 0;
                            if ($user_rated) {
                                $rating = $query3->fetchAll(PDO::FETCH_ASSOC)[0]['rating'];
                                ?>
                                    <div class="rating">
                                <?php for ($i = 0; $i < $rating; $i++) {?>
                                        <i class="fa fa-star"></i>
                                <?php } ?>
                                <?php for ($i = $rating; $i < 5; $i++) {?>
                                    <i class="fa fa-star-o"></i>
                                <?php } ?>
                                    </div>
                            <?php } else { ?>
                                <div class="rating">
                                    <i class="fa  rating-star" data-value="5"></i>
                                    <i class="fa  rating-star" data-value="4"></i>
                                    <i class="fa  rating-star" data-value="3"></i>
                                    <i class="fa  rating-star" data-value="2"></i>
                                    <i class="fa  rating-star" data-value="1"></i>
                                </div>
                        <?php } ?>
                        <?php if (!$user_rated) { ?>
                        <script>
                        document.body.onload = function () {
                            const video_id = "<?php echo $ajax_id;?>";
                            const user_id = "<?php echo $_SESSION['user']['id'];?>";
                            const send_url = "<?php echo $server_base?>/partials/ajax.php";
                            $('.rating-star').one( "click", function() {
                                $(this).parents('.rating').find('.rating-star').removeClass('checked');
                                $(this).addClass('checked');

                                const rating = parseInt($(this).attr('data-value'), 10);
                                //ajax call
                                $.post(send_url, {
                                    video_id, user_id, rating, type: "ajax", action: "rating"
                                }).done( result => {
                                    console.log(result);
                                    $(".rating-star").each(i => {
                                        if (i < rating) {
                                            $(".rating-star").eq(i).addClass("fa-star");
                                        } else {
                                            $(".rating-star").eq(i).addClass("fa-star-o");
                                        }
                                    });
                                    $(".rating-star").removeClass("rating-star");
                                } );
                            });
                        };
                        </script>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
                <div class="panel-body" style="/*background-color: rgba(252, 253, 149, 0.3)*/"><?php echo $current_video['description'];?></div>
            </div>

        </div>
    </div>


<?php } ?>
    <h2 class="text-center" style="padding:10px 0 15px 0">Results for word: <strong><?php echo $query_search;?></strong></h2>
    <?php
    $rating = array();
    foreach ($videos as $key => $video) {
        $rating[$key] = $video['rating'];
    }
    array_multisort($rating, SORT_DESC, $videos);
    foreach($videos as $video) {
        includeFileWithVariables("../partials/video-row-template.php", array(
            "id" => $video['id'],
            "title" => $video['title'],
            "description" => $video['description'],
            "img" => $video['img'],
            "watch_link" => $_SERVER['PHP_SELF'] . '?q=' . $query_search . '&id=' . $video['id']
        ));
    }
    ?>
<?php require_once "../partials/footer.php";?>
