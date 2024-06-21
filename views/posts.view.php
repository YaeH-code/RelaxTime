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
        <aside class="col-12 col-md-2">
            <p class="fs-3 text-center">Genre</p>
            <ul class="d-flex flex-row flex-md-column justify-content-center align-items-md-center style-ul">
                <?php if(empty($categories)):?>
                        <p>No category</p>
                <?php else :?>
                    <?php foreach($categories as $category): ?>
                        <?php if($category->getCat() == "etc"): ?>
                            <div class="order-last">
                                <li><a class="btn text-decoration-none cat-hover fs-5 m-1" href="<?= URL ?>articles/category/<?= $category->getId(); ?>"><?= $category->getCat() ?></a></li>
                            </div>
                        <?php else :?>
                        <li><a class="btn text-decoration-none cat-hover fs-5 m-1" href="<?= URL ?>articles/category/<?= $category->getId(); ?>"><?= $category->getCat() ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </aside>

        <div class="col-12 col-md-10">
            <div class="container row d-flex flex-column">
                <p class="fs-2">Latest</p>
                <?php if(empty($posts)):?>
                    <p>No article</p>
                <?php else :?>
                    <?php if(count($posts) > 6): ?>
                        <?php for($i = 0; $i < 6; $i++) : ?>
                            <div class="card rounded p-5 my-1" width = "50%">
                                <a href="<?= URL ?>articles/p/<?= $posts[$i]->getId(); ?>" class="text-decoration-none">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <?php if($posts[$i]->getImage() !== ''):?>
                                                <img src="public/images/<?= $posts[$i]->getImage(); ?>" class="rounded card-img-top home-img">
                                        <?php else:?>
                                            <p>No image</p>
                                        <?php endif;?>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <p class="card-title fs-5"><?= $posts[$i]->getTitle(); ?></p>
                                            <p class="text-secondary"><?= substr(htmlspecialchars($posts[$i]->getContent()), 0, 500) ?>&nbsp;...</p>
                                        </div>
                                    </div>
                                </div>
                                </a>
                                <?php if (array_key_exists('name', $_SESSION) == true):?>
                                    <?php if ($_SESSION['id'] == $posts[$i]->getUser() || $_SESSION['role'] == 'admin'): ?>
                                        <div class="d-flex flex-row justify-content-end align-items-end">
                                            <a href="<?= URL ?>articles/m/<?= $posts[$i]->getId(); ?>" class="btn btn-outline-primary">Modify</a>
                                            <form method="POST" action="<?= URL ?>articles/d/<?= $posts[$i]->getId(); ?>" class="ms-3">
                                                <button class="btn btn-primary" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                    <?php else :?>
                                <?php endif; ?>
                            </div>
                        <?php endfor; ?>
                    <?php else :?>
                        <?php foreach($posts as $post) : ?>
                            <div class="card rounded p-5 my-1" width = "50%">
                                <a href="<?= URL ?>articles/p/<?= $post->getId(); ?>" class="text-decoration-none">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <?php if($post->getImage()  !== ''):?>
                                                <img src="public/images/<?= $post->getImage(); ?>" class="rounded card-img-top home-img">
                                        <?php else:?>
                                            <p>No image</p>
                                        <?php endif;?>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <p class="card-title fs-5"><?= $post->getTitle();  ?></p>
                                            <p class="text-secondary"><?= substr(htmlspecialchars($post->getContent()), 0, 500) ?>&nbsp;...</p>
                                        </div>
                                    </div>
                                </div>
                                </a>
                                <?php if (array_key_exists('name', $_SESSION) == TRUE):?>
                                    <?php if ($_SESSION['id'] == $post->getUser() || $_SESSION['role'] == 'admin'): ?>
                                        <div class="d-flex flex-row justify-content-end align-items-end">
                                            <a href="<?= URL ?>articles/m/<?= $post->getId(); ?>" class="btn btn-outline-primary">Modify</a>
                                            <form method="POST" action="<?= URL ?>articles/d/<?= $post->getId();?>" class="ms-3">
                                                <button class="btn btn-primary" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                    <?php else :?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
            <?php endif; ?>
            </div>
        </div>
        <?php if (array_key_exists('name', $_SESSION) == TRUE): ?>
            <a href="<?= URL ?>articles/all" class="d-flex align-items-center justify-content-end icon-link icon-link-hover fs-6 my-3" style="--bs-link-hover-color-rgb: 0,0,0;">View All Articles <i class="bi bi-chevron-double-right"></i></a>
            <a href="<?= URL ?>articles/c" class="btn btn-outline-dark btn-sm my-3">Creat New</a>
        <?php else :?>
        <?php endif; ?>
    </div>
</div>



<?php
$content = ob_get_clean();
if(empty($posts)){
    $title = "No article";
}else{
    $title = "Total articles (". count($posts) .")";
}
require "template.php";
?>