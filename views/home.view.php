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

    <h1 class="text-center my-5 text-origin">Each day is a good day</h1>

    <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="public/images/couple_home.jpg" class="d-block w-100 cover-img" alt="image of home (woman and man)">
            </div>
            <div class="carousel-item ">
                <img src="public/images/winter-coffe.jpg" class="d-block w-100 cover-img" alt="image of woman with hot coffee in winter">
            </div>
            <div class="carousel-item">
                <img src="public/images/herbal-tea-cup.jpg" class="d-block w-100 cover-img" alt="image of the tea pot">
            </div>
            <div class="carousel-item">
                <img src="public/images/ceramics.jpg" class="d-block w-100 cover-img" alt="image of asiatic ceramics tea pots">
            </div>
        </div>
    </div>

    <div class="rounded text-bg-primary text-center opacity-75 mt-4 text-origin">This Blog is for sharing our way of life and to give our hot recipes</div>

<?php
$content = ob_get_clean();
$title = '';
require "template.php";
?>