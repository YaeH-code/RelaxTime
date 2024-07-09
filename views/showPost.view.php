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
    <div class="card mx-auto col-10 col-md-6 my-5">
        <?php if($post->getImage() !== ''):?>
                <img src="<?= URL ?>public/images/<?= $post->getImage(); ?>" class="card-img-top">
        <?php else: ?>
                <p>No image</p>
        <?php endif ?>
            <div class="card-body fs-6">
                <?php foreach($categories as $category): ?>
                    <?php if($post->getCategory() == $category->getId() ): ?>
                        <p>Category : <?= $category->getCat() ;?></p>
                    <?php endif; ?>
                <?php endforeach; ?>
                <p class="card-text">Content : <?= $post->getContent(); ?></p>
                <?php foreach($users as $user): ?>
                    <?php if($post->getUser() == $user->getId() ): ?>
                        <p>By : <?= $user->getName() ;?></p>
                    <?php endif; ?>
                <?php endforeach; ?>
                <p class="card-text fs-6">Created at : <?php $date = strtotime($post->getTime()); echo date("Y-m-d", $date); ?></p>
            </div>
    </div>
    <!-- comments -->
            <div class="text-center" style="overflow-y: auto; max-height: 200px;">
            <?php if(empty($comments)):?>
                <p>Empty comments</p>
            <?php else :?>
                <?php if($comments !== NULL): ?>
                        <?php foreach($comments as $comment): ?>
                                <?php if($comment->getUser_id() !== NULL && $comment->getPost_id() == $post->getId()): ?>
                                    <?php foreach($users as $user): ?>
                                        <?php if($comment->getUser_id()== $user->getId() ): ?>
                                            <div class="container row mx-auto">
                                                <p class="col-sm-8"><?= $user->getName() ;?> : <?= $comment->getComment();?></p>
                                                <?php if (array_key_exists('name', $_SESSION) == TRUE):?>
                                                    <?php if ($_SESSION['id'] == $comment->getUser_id() || $_SESSION['role'] == 'admin'): ?>
                                                        <form method="POST" action="<?= URL ?>articles/dc/<?= $comment->getId();?>" class="col-sm-2">
                                                            <input type="hidden" name="post_id" value="<?= $post->getId() ?>" />
                                                            <button class="btn btn-outline-secondary" type="submit">Delete</button>
                                                        </form>
                                                        <?php endif; ?>
                                                    <?php else :?>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                        <?php endforeach; ?>
                <?php else:?>
                                <p>No comments</p>
                <?php endif; ?>
            <?php endif; ?>
            </div>

            <form method="POST" action="<?= URL ?>articles/cm" class="col-8 my-5 mx-auto">
                <div class="input-group mb-3">
                    <input type="hidden" name="post_id" value="<?= $post->getId() ?>" />
                    <input for="validationCustom03" type="text" class="form-control" placeholder="Your comment" aria-label="default input example" aria-describedby="button-addon2" name="comment" id="validationCustom03" required>
                    <div class="invalid-feedback">
                        Please provide a valid comment.
                    </div>
                    <button class="btn btn-primary" type="submit" id="button-addon2">OK</button>
                </div>
            </form>
</div>
<?php
$content = ob_get_clean();
$title = $post->getTitle();
require "template.php";
?>