<?php 
ob_start(); 
?>

<div class="container">
    <form class="vstack gap-3" method="POST" action="<?= URL ?>articles/mv" enctype="multipart/form-data">
    <label for="validationTextarea" class="form-label">Title</label>
        <textarea class="form-control" id="validationTextarea" name="title" placeholder="Required example title textarea" required><?= $post->getTitle() ?></textarea>
        <div class="invalid-feedback">
            Please enter a title in the textarea.
        </div>
        <label for="validationTextarea" class="form-label">Content</label>
        <textarea class="form-control" id="validationTextarea" name="content" style="height: 300px" placeholder="Required example content textarea" required><?= $post->getContent() ?></textarea>
        <div class="invalid-feedback">
            Please enter some text in the textarea.
        </div>
        <?php if($post->getImage() !== ''):?>
            <div class="row" style="width: 25%; height: 25%;">
            <h5 class="col-sm-4">Images : </h5>
            <img src="<?= URL ?>public/images/<?= $post->getImage() ?>" class="img-thumbnail img-fluid col-sm-8">
        </div>
            <div class="form-group">
                <label for="img">Change this image ? : </label>
        <?php else:?>
            <p>Insert your image</p>
            <div class="form-group">
                <label for="img">What image ? : </label>
        <?php endif;?>
                <input type="file" class="form-control-file" id="img" name="img">
            </div>
        <div class="row">
            <div for="category" class="col">Genre : </div>
                <?php foreach($categories as $category): ?>
                    <div class="form-check col">
                        <input class="form-check-input" type="radio" name="category" id="flexRadioDefault1" value="<?= $category->getId() ; ?>" <?= $category->getId() == $post->getCategory() ? "checked" : ""; ?>>
                        <label class="form-check-label" for="flexRadioDefault1" value="<?= $category->getId(); ?>">
                            <?= $category->getCat() ?>
                        </label>
                    </div>
                <?php endforeach; ?>
        </div>
            <input type="hidden" name="identifiant" value="<?= $post->getId(); ?>">
            <button type="submit" class="btn btn-primary mt-3">OK</button>
    </form>
</div>

<?php
$content = ob_get_clean();
$title = "Modification of the article : ".$post->getTitle();
require "template.php";
?>