<?php

require("header.php");
require("../controller/Controller_img.class.php");

if (!isset($_GET['id']))
    die();
$controller = new Controller_img();
$pic = $controller->get_pic($_GET['id']);
$pic_name = $pic['name'];
$author = $pic['login'];
date_default_timezone_set("Europe/Paris");
$date = date("d/m/Y H:i:s", $pic['date']);
$desc = $pic['desc'];
$likes = $pic['likes'];
if ($likes < 2)
    $likes .= " like";
else
    $likes .= " likes";


?>

<div class='container-fluid'>
    <div class='col-lg-8 offset-lg-2 pic_container'>
        <div class='row'>

            <div class="col-lg-5 pic_section">
                <div class='col-lg-12'>
                    <p class='author'><?= $author ?></p>
                </div>
                <div class='col-lg-12 img_div'>
                    <img width='480px' height="480px" class="col-lg-12" src="../public/img/users/<?= $author ?>/<?= $pic_name ?>.jpg">
                </div>
                <div class='col-lg-12'>
                    <div class='react'>
                            <i id="like_btn" class="far fa-heart"></i>
                            <label for="comment"><i class="far fa-comment"></i></label>
                    </div>
                    <div class='col-lg-12 data'>
                        <p class="likes"><?= $likes ?></p>
                        <p class='desc'><?= $desc ?></p>                   
                        <p class='date'><?= $date ?></p>
                    </div>
                    <form class='col-lg-12 form_com' method='post'>
                        <input id='comment' class='col-lg-12' type='text' placeholder="Add a comment...">
                    </form>
                </div>
            </div>

            <div class="col-lg-5 comment_section">
                lol
            </div>

        </div>
    </div>
</div>

<script src="../public/js/solo_pic.js"></script>
<?php

require("footer.php");

?>