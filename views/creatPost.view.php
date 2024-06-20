<?php 
ob_start(); 
?>
<div class="container">
    <form class="vstack gap-3" method="POST" action="<?= URL ?>articles/av" enctype="multipart/form-data">
        <label for="validationTextarea" class="form-label">Title</label>
        <textarea class="form-control" id="validationTextarea" name="title" placeholder="Required example title textarea" required></textarea>
        <div class="invalid-feedback">
            Please enter a title in the textarea.
        </div>
        <label for="validationTextarea" class="form-label">Content</label>
        <textarea class="form-control" id="validationTextarea" name="content" style="height: 300px" placeholder="Required example content textarea" required></textarea>
        <div class="invalid-feedback">
            Please enter some text in the textarea.
        </div>
        <div class="form-group">
            <label for="img">Image : </label>
            <input type="file" class="form-control-file" id="img" name="img">
        </div>
        <div class="row">
            <div for="category" class="col">Genre : </div>
                <?php foreach($categories as $category): ?>
                    <div class="form-check col">
                        <input class="form-check-input" type="radio" name="category" id="flexRadioDefault1" value="<?= $category->getId(); ?>">
                        <label class="form-check-label" for="flexRadioDefault1" value="<?= $category->getId(); ?>">
                            <?= $category->getCat() ?>
                        </label>
                    </div>
                <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-primary my-5">OK</button>
    </form>
</div>
<?php
$content = ob_get_clean();
$title = "Write your new article";
require "template.php";
?>