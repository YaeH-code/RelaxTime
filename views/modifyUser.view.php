<?php 
ob_start(); 
?>

<div class="container">
    <form class="vstack gap-3" method="POST" action="<?= URL ?>admin/admv">
      <input type="text" class="form-control" placeholder="Name" aria-label="default input example" aria-describedby="button-addon2" name="name" value="<?= $user->getName() ?>">
      <input type="text" class="form-control" placeholder="Email" aria-label="default input example" aria-describedby="button-addon2" name="email" value="<?= $user->getEmail() ?>">
      <input type="text" class="form-control" placeholder="Role" aria-label="default input example" aria-describedby="button-addon2" name="role" value="<?= $user->getRole() ?>">
      <input type="text" class="form-control" placeholder="Password(8 letters)" aria-label="default input example" aria-describedby="button-addon2" name="password" value="<?= $user->getPassword() ?>">
      <input type="hidden" name="user_id" value="<?= $user->getId(); ?>">
        <button type="submit" class="btn btn-primary mt-3">OK</button>
    </form>
</div>

<?php
$content = ob_get_clean();
$title = "Modification of the user : ". $user->getName();
require "template.php";
?>