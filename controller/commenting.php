<?php

require('Controller_img.class.php');
require('Controller_users.class.php');

$controller_img = new Controller_img();
$controller_users = new Controller_users();

if (!isset($_POST['comment'], $_POST['user_id'], $_POST['pic_id']))
    die();
$comment = $_POST['comment'];
$user_id = $_POST['user_id'];
$pic_id = $_POST['pic_id'];
if (!$controller_img->add_comment($pic_id, $user_id, $comment));
{
    echo 0;
    die();
}
send_notif($pic_id, $user_id, $controller_users->get_user_by_id($user_id));
$user_login = $controller_users->get_user_by_id($user_id);
$res = ['user_login' => $user_login, 'comment' => $comment];
echo(json_encode($res));

function send_notif($pic_id, $commenter_id, $commenter) {
    if (!$controller_users->notif_enabled($commenter_id))
        return FALSE;
    $subject = "Comment on your picture by $commenter";
    $txt = "Hi, $commenter commented your pic.";
    $header = "From: noreply@instalike.com" . "\r\n";
    mail($controller_users->get_email_by_picid($pic_id), $subject, $txt, $header);
}