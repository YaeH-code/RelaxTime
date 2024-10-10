
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
<div class="d-flex justify-content-center">
  <div class="container row">
    <?php if($posts !== NULL): ?>
      <?php foreach($posts as $post): ?>
        <?php if($post->getCategory() == $category->getId()): ?>
          <div class="card rounded col-6 col-md-3 p-3 my-1">
            <a href="<?= URL ?>articles/p/<?= $post->getId(); ?>" class="text-decoration-none">
            <div>
              <?php if($post->getImage()  !== ''):?>
                      <img src="<?= URL ?>public/images/<?= $post->getImage(); ?>" class="rounded card-img-top home-img">
              <?php else:?>
                  <p>No image</p>
              <?php endif;?>
            </div>
            <div class="card-body">
                    <p class="card-title fs-5"><?= strlen($post->getTitle()) > 26 ? substr(htmlspecialchars($post->getTitle()), 0, 25) . "&nbsp;..." : $post->getTitle(); ?></p>
            </div>
            </a>
            <?php if (array_key_exists('name', $_SESSION) == TRUE):?>
                    <?php if ($_SESSION['id'] == $post->getUser() || $_SESSION['role'] == 'admin'): ?>
                            <div class="d-flex flex-row justify-content-center align-items-end">
                            <a href="<?= URL ?>articles/m/<?= $post->getId(); ?>" class="btn btn-outline-primary">Modify</a>
                            <form method="POST" action="<?= URL ?>articles/d/<?= $post->getId();?>" class="ms-3">
                                    <button class="btn btn-primary" type="submit">Delete</button>
                            </form>
                            </div>
                    <?php endif; ?>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>
<?php
$content = ob_get_clean();
$title = $category->getCat();
require "template.php";
?>