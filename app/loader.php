<?php
session_start();
include_once 'configs/config.php';
include_once 'helpers/redirect.php';


spl_autoload_register(function ($inc){
    include_once 'libraries/'.$inc.'.class.php';
});