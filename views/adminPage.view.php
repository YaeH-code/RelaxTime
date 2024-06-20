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
          <p class="fs-3 text-center">Categories (<?= count($categories) ?>)</p>
          <ul class="d-flex flex-wrap justify-content-start align-items-center style-ul">
              <?php foreach($categories as $category): ?>
                <?php if($category->getCat() == "etc"): ?>
                    <div class="order-last">
                        <li>
                            <a class="btn text-decoration-none border border-secondary rounded-pill fst-italic fs-5 m-1" href="<?= URL ?>articles/category/<?= $category->getId(); ?>"><?= $category->getCat() ?>
                            </a>
                        </li>
                    </div>
                <?php else :?>
                  <li><a class="btn text-decoration-none border border-secondary rounded-pill fst-italic fs-5 m-1" href="<?= URL ?>articles/category/<?= $category->getId(); ?>"><?= $category->getCat() ?></a></li>
                    <form method="POST" action="<?= URL ?>admin/addcv/<?= $category->getId();?>" class="col-sm-2">
                        <button class="btn btn-outline-secondary" type="submit">D</button>
                    </form>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
            <form method="POST" action="<?= URL ?>admin/adv" class="col-8 my-3 mx-auto">
                <div class="input-group mb-3">
                    <input for="validationCustom03" type="text" class="form-control" placeholder="Create category" aria-label="default input example" aria-describedby="button-addon2" name="cat" id="validationCustom03" required>
                    <div class="invalid-feedback">
                        Please provide a valid category.
                    </div>
                    <button class="btn btn-outline-dark btn-sm" type="submit" id="button-addon2">OK</button>
                </div>
            </form>
      </aside>
      <p class="fs-3 text-center my-2">Articles (<?= count($posts) ?>)</p>
          <?php foreach($posts as $post) : ?>
              <div class="card rounded col-6 col-md-3 p-3 my-1">
                  <a href="<?= URL ?>articles/p/<?= $post->getId(); ?>" class="text-decoration-none">
                    <div class="card-body">
                        <p class="card-title fs-5"><?= strlen($post->getTitle()) > 26 ? substr(htmlspecialchars($post->getTitle()), 0, 25) . "&nbsp;..." : $post->getTitle(); ?></p>
                        <p class="text-secondary"><?= substr(htmlspecialchars($post->getContent()), 0, 30) ?>&nbsp;...</p>
                    </div>
                  </a>
                          <div class="d-flex flex-row justify-content-center align-items-end">
                              <a href="<?= URL ?>articles/m/<?= $post->getId(); ?>" class="btn btn-outline-primary">Modify</a>
                              <form method="POST" action="<?= URL ?>articles/d/<?= $post->getId();?>" class="ms-3">
                                  <button class="btn btn-primary" type="submit">Delete</button>
                              </form>
                          </div>
              </div>
          <?php endforeach; ?>

          <p class="fs-3 text-center my-2">Users (<?= count($users) ?>)</p>
            <?php foreach($users as $user) : ?>
                <div class="card rounded col-6 col-md-4 p-3 my-1">
                    <div class="card-body text-body-secondary">
                        <p class="card-title fw-bold fs-5">Name : <?= $user->getName();  ?></p>
                        <p class="fs-6">Email : <?= $user->getEmail();  ?></p>
                        <p class="fs-6">Role : <?= $user->getRole();  ?></p>
                    </div>
                    <div class="d-flex flex-row justify-content-end align-items-end">
                        <a href="<?= URL ?>admin/adm/<?= $user->getId(); ?>" class="btn btn-outline-secondary">Modify</a>
                        <form method="POST" action="<?= URL ?>admin/adduv/<?= $user->getId();?>" class="ms-3">
                            <button class="btn btn-secondary" type="submit">D</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = "Admin page";
require "template.php";
?>