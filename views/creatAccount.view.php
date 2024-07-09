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
    <form method="POST" action="<?= URL ?>signup/sv">
        <div class="mb-3 row">
                <label for="name" class="text-end col-sm-2 col-form-label">Name : </label>
            <div class="col-sm-8">
                <input type="text" class="form-control"  id="name" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : null ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="text-end col-sm-2 col-form-label">Email : </label>
            <div class="col-sm-8">
                <input type="text" class="form-control"  id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : null ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="text-end col-sm-2 col-form-label">Password(more than 8 letters): </label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="myInput" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : null ?>" >
                <input type="checkbox" onclick="togglePW()">Show Password
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary my-3 my-sm-0">OK</button>
            </div>
        </div>
    </form>
        <div class="container text-center mt-4">
            <a class="fs-5" href="<?= URL ?>pw">Do you have your account ?</a>
        </div>
</div>
<?php
$content = ob_get_clean();
$title = "Go to SignUp";
require "template.php";
?>