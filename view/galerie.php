<?php

require("header.php");
require("../controller/Controller_img.class.php");

$controller_img = new Controller_img();
$pics = $controller_img->get_one_page();
$str = "<div class='row'>";
foreach ($pics as $k => $pic) {
    $author = $pic['login'];
    $pic_name = $pic['name'];
    $pic_id = $pic['id'];
    $img = "<img class='img_galerie' src='../public/img/users/$author/$pic_name.jpg'>";
    $link = "<a href='solo_pic.php?id=$pic_id'>";
    $pic_container = "$link$img</a>";
    $str = $str."<div class='col-lg-4'>$pic_container</div>";
}
$str = $str."</div>";

?>

<div class="col-lg-6 offset-lg-3 container-fluid galerie">
    <?= $str ?>
</div>


<?php require("footer.php") ?>