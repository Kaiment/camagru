<?php

require("header.php");
require("../controller/Controller_img.class.php");
require("../controller/Controller_users.class.php");


$controller_img = new Controller_img();
$controller_users = new Controller_users();

if (!isset($_GET['id']))
    die();
if (isset($_SESSION['user_id']))
    $user_id = $_SESSION['user_id'];
$pic_id = $_GET['id'];
$pic = $controller_img->get_pic($_GET['id']);
$pic_name = $pic['name'];
$author = htmlspecialchars($controller_users->get_user_by_id($pic['userid']));
if (!$author)
    $author = '[Deleted User]';
date_default_timezone_set("Europe/Paris");
$date = date("d/m/Y H:i:s", $pic['date']);
$desc = $pic['desc'];
$likes = $pic['likes'];
if ($likes < 2)
    $likes .= " like";
else
    $likes .= " likes";
if (isset($user_id) && $controller_img->has_already_liked($pic_id, $user_id))
    $like_icon = "fas fa-heart";
else
    $like_icon = "far fa-heart";

$comments = $controller_img->get_pic_comments($pic_id);
$comments_html = '';
foreach ($comments as $comment) {
    $comment_author = $controller_users->get_user_by_id($comment['userid'])." ";
    $comment_text = $comment['comment'];
    $comments_html .= "<p class='col-lg-12'><b>".htmlspecialchars($comment_author)."</b>".htmlspecialchars($comment_text)."</p>";
}

?>

<div class='container-fluid'>
    <div class='col-lg-6 offset-lg-3 pic_container'>
        <div class='row'>

            <div class="col-lg-5 pic_section">
                <div class='col-lg-12'>
                    <p class='author'><?= $author ?></p>
                </div>
                <div class='col-lg-12 img_div'>
                    <img width='480px' height="480px" class="col-lg-12" src="../public/img/users/<?= $pic['login'] ?>/<?= $pic_name ?>.jpg">
                </div>
                <div class='col-lg-12 pic_footer'>
                    <div class='react'>
                            <i id="like_btn" class="<?= $like_icon ?>"></i>
                            <label for="comment_input"><i class="far fa-comment-dots"></i></label>
                    </div>
                    <div class='col-lg-12 data'>
                        <p id="likes" class="likes"><?= $likes ?></p>
                        <p class='desc'><?= $desc ?></p>
                        <p class='date'><?= $date ?></p>
                    </div>
                </div>
            </div>

            <div id='comment_section' class="col-lg-7 comment_section">
                <?= $comments_html ?>
                <input id='comment_input' class='col-lg-12' type='text' placeholder="Add a comment..." name="comment">
            </div>

        </div>
    </div>
</div>


<script type='text/javascript'>
    var pic_id = <?= $pic_id; ?>;
    <?php if (isset($user_id)): ?>
        var user_id = <?= $user_id ;?>;
    <?php endif; ?>
</script>
<script type="text/javascript" src="../public/js/solo_pic.js"></script>
<?php

require("footer.php");

?>