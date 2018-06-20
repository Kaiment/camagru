<?php require_once("header.php"); ?>

<div class="container-fluid content">
    <div class='row'>
        <div id='add_panel' class="col-lg-6 offset-lg-1 add_photo">

            <!-- SECTION VIDEO -->
            <div class='row'>
                <div id='video_section' class="col-lg-8 offset-lg-2 col-md-12">
                </div>
            </div>

            <!-- TAKE PHOTO BUTTON -->
            <div class='row'>
                <div id='take_picture_section' class="col-lg-8 offset-lg-2 col-md-12">
                </div>
            </div>

            <!-- CHOOSE FILE -->
            <div class='row choose_file'>
                    <input id ="choose_file" class="col-lg-6 offset-lg-1" type='file'>
                    <input type="submit" class="col-lg-3 offset-lg-1 menu_button" id="submit_file" value="SUBMIT">
            </div>

            <!-- MONTAGE IMG -->
            <div class='row'>
                <div class='col-lg-3'>
                    <input class='col-md-1 offset-md-1' onclick="select_montage_img()" name='montage_img' type='radio' id='pineapple' value='pineapple'>
                    <label class='col-md-9' for='pineapple'><img height='100px' src='/public/img/montage/pineapple.png'></label>
                </div>
                <div class='col-lg-3'>
                    <input class='col-md-1 offset-md-1' onclick="select_montage_img()" name='montage_img' type='radio' id='cat' value='cat'>
                    <label class='col-md-9' for='cat'><img height='100px' src='/public/img/montage/cat.png'></label>
                </div>
                <div class='col-lg-3'>
                    <input class='col-md-1 offset-md-1' onclick="select_montage_img()" name='montage_img' type='radio' id='dickbutt' value='dickbutt'>
                    <label class='col-md-9' for='dickbutt'><img height='100px' src='/public/img/montage/dickbutt.png'></label>
                </div>
                <div class='col-lg-3'>
                    <input class='col-md-1 offset-md-1' onclick="select_montage_img()" name='montage_img' type='radio' id='stop' value='stop'>
                    <label class='col-md-9' for='stop'><img height='100px' src='/public/img/montage/stop.png'></label>
                </div>
            </div>
                
            <!-- MONTAGE IMG 2 -->
            <div class='row'>
                <div class='col-lg-3'>
                    <input class='col-md-1 offset-md-1' onclick="select_montage_img()" name='montage_img' type='radio' id='wow' value='wow'>
                    <label class='col-md-9' for='wow'><img height='100px' src='/public/img/montage/wow.png'></label>
                </div>
                <div class='col-lg-3'>
                    <input class='col-md-1 offset-md-1' onclick="select_montage_img()" name='montage_img' type='radio' id='knuckles' value='knuckles'>
                    <label class='col-md-9' for='knuckles'><img height='100px' src='/public/img/montage/knuckles.png'></label>
                </div>
                <div class='col-lg-3'>
                    <input class='col-md-1 offset-md-1' onclick="select_montage_img()" name='montage_img' type='radio' id='trump' value='trump'>
                    <label class='col-md-9' for='trump'><img height='100px' src='/public/img/montage/trump.png'></label>
                </div>
                <div class='col-lg-3'>
                    <input class='col-md-1 offset-md-1' onclick="select_montage_img()" name='montage_img' type='radio' id='luigi' value='luigi'>
                    <label class='col-md-9' for='luigi'><img height='100px' src='/public/img/montage/luigi.png'></label>
                </div>
            </div>

        </div>

        <!-- SIDE -->
        <div id='add_panel' class="col-lg-4 add_photo">

            <div class='row'>
                <div class='col-lg-10 offset-lg-1'>
                    <img class='preview' width='480' height='480' id='preview'>
                </div>
            </div>

            <div class='row'>
                <input class="menu_button" id="publish" type="submit" value='PUBLISH'>
            </div>

        </div>
    </div>

    <div class='row'>
        <div id='saved_pics' class='col-lg-10 offset-lg-1 add_photo'>
        </div>
    </div>
</div>

<script type="text/javascript" src='../public/js/cam.js'></script>

<?php require_once("footer.php"); ?>