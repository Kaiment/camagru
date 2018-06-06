<?php require_once("header.php"); ?>

<div class="container-fluid content">
        <div id='add_panel' class="col-lg-10 offset-lg-1 add_photo">
            <div class='row'>
                <div id='video_section' class="col-lg-4 col-md-12">
                </div>
                <div class="col-lg-8">
                    <div class="col-lg-12"></div>
                    <div class="col-lg-12"></div>
                </div>
            </div>
            <input class="col-lg-4 menu_button" id="take_picture" type="submit" value='TAKE'>
            <div class='row'>
                <canvas width='400' height='400' id='canvas'></canvas>
            </div>
            <div class='row'>
                <input class="col-lg-4 menu_button" id="publish" type="submit" value='PUBLISH'>
            </div>
        </div>
</div>
<script src='../public/js/cam.js'></script>
<?php require_once("footer.php"); ?>