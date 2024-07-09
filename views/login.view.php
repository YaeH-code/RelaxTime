<?php 
ob_start(); 
    if(!empty($_SESSION['alert'])) :
?>
    <div class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
        <?= $_SESSION['alert']['msg'] ?>
    </div>
<?php 
    unset($_SESSION['alert']);
    endif; 
?>
<div class="container">
    <form method="POST" action="<?= URL ?>login/lv">
        <div class="mb-3 row">
                <label for="email" class="text-end col-sm-2 col-form-label">Mail : </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="email" name="email">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="text-end col-sm-2 col-form-label">Password (more than 8 letters): </label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="myInput" name="password">
                <input type="checkbox" onclick="togglePW()">Show Password
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">OK</button>
            </div>
        </div>
    </form>
        <div class="container text-center mt-4">
            <a class="fs-5" href="<?= URL ?>login">Did you forget your password ?</a>
        </div>
</div>
<?php
$content = ob_get_clean();
$title = "Go to SignIn";
require "template.php";
?>