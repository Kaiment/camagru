<?php

require("header.php");
require("../controller/Controller_img.class.php");

$controller_img = new Controller_img();
if (isset($_GET['page']))
    $page = $_GET['page'];
else
    $page = 0;
$pics = $controller_img->get_one_page($page);
if (empty($pics) && $page == 0)
    $str = '';
else if (empty($pics))
    header("Location:/view/galerie.php");
else
    $str = "<div class='row'>";
foreach ($pics as $k => $pic) {
    $author = $pic['login'];
    $author_id = $pic['userid'];
    $pic_name = $pic['name'];
    $pic_id = $pic['id'];
    if (!file_exists("../public/img/users/user$author_id/$pic_name.jpg"))
        $controller_img->delete_img($pic_id);
    $img = "<img class='img_galerie' src='../public/img/users/user$author_id/$pic_name.jpg'>";
    $link = "<a href='solo_pic.php?id=$pic_id'>";
    $pic_container = "$link$img</a>";
    $str = $str."<div class='col-4'>$pic_container</div>";
}
$str = $str."</div>";

?>

<div class="col-lg-6 offset-lg-3 container-fluid galerie">
    <?= $str ?>
</div>
<div class='col-lg-6 offset-lg-3'>
    <div class='row'>
        <?php if ($page > 0): ?>
            <a href="/view/galerie.php?page=<?= $page - 1 ?>" class='col-lg-4 offset-lg-2 menu_button' >Page precedente</a>
        <?php endif; ?>
        <?php if ($controller_img->get_one_page($page + 1)): ?>
            <a href="/view/galerie.php?page=<?= $page + 1; ?>" class='col-lg-4 <?= $page == 0 ? 'offset-lg-6' : '' ?> menu_button' >Page suivante</a>
        <?php endif; ?>
    </div>
</div>


<?php require("footer.php") ?>