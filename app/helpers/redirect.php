<?php 
function redirect($file )
{
    header('location:'.URLROOT.$file);
}
function redirectHome($url = null, $seconds = 0) {

    if ($url === null) {

        $url = URLROOT . 'admins';

    } else {

        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {

            $url = $_SERVER['HTTP_REFERER'];

        } else {

            $url = URLROOT . 'admins';

        }

    }

    header("refresh:".$seconds.";url=$url");

    exit();

}