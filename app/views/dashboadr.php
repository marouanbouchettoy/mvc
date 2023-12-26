<?php
include_once APPROOT . '/views/inc/header.inc.php';
?>
    <table>
        <tr>
            <td>id</td>
            <td>name</td>
        </tr>
        <?php foreach ($data['users'] as $user) { ?>
            <tr>
                <td><?=$user->id?></td>
                <td><?=$user->name?></td>
            </tr>
        <?php } ?>
    </table>
<?php include_once APPROOT . '/views/inc/footer.inc.php' ?>