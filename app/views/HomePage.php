<?php
include_once APPROOT . '/views/inc/header.inc.php';
?>

<div class="container gallery-container">

    <h1>MVC Home</h1>
    <form action="<?=URLROOT?>HomeControl/insert" method="POST">
        <input type="text" name="name">
        <input type="submit" value="insert">
    </form>

</div>


<?php include_once APPROOT . '/views/inc/footer.inc.php' ?>