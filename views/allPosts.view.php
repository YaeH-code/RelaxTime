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
      <aside class="col-12">
          <p class="fs-3 text-center">Genre</p>
          <ul class="d-flex flex-row justify-content-center align-items-md-center style-ul">
              <?php foreach($categories as $category): ?>
                <?php if($category->getCat() == "etc"): ?>
                    <div class="order-last">
                        <li><a class="btn text-decoration-none cat-hover fs-5 m-1" href="<?= URL ?>articles/category/<?= $category->getId(); ?>"><?= $category->getCat() ?></a></li>
                    </div>
                <?php else :?>
                  <li><a class="btn text-decoration-none cat-hover fs-5 m-1" href="<?= URL ?>articles/category/<?= $category->getId(); ?>"><?= $category->getCat() ?></a></li>
                <?php endif; ?>
              <?php endforeach; ?>
          </ul>
      </aside>

          <?php foreach($posts as $post) : ?>
              <div class="card rounded col-6 col-md-3 p-3 my-1">
                  <a href="<?= URL ?>articles/p/<?= $post->getId(); ?>" class="text-decoration-none">
                    <div class="card-body">
                        <p class="card-title fs-5"><?= strlen($post->getTitle()) > 26 ? substr(htmlspecialchars($post->getTitle()), 0, 25) . "&nbsp;..." : $post->getTitle(); ?></p>
                        <p class="text-secondary"><?= substr(htmlspecialchars($post->getContent()), 0, 30) ?>&nbsp;...</p>
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
          <?php endforeach; ?>
        <?php if (array_key_exists('name', $_SESSION) == TRUE): ?>
            <a href="<?= URL ?>articles/c" class="btn btn-outline-dark btn-sm my-3">Creat New</a>
        <?php endif; ?>
    </div>
</div>



<?php
$content = ob_get_clean();
$title = "Total articles (". count($posts) .")";
require "template.php";
?>