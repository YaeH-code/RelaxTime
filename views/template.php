<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relax Time</title>
    <!-- normalize/css -->
    <link rel="stylesheet" type="text/css" href="<?= URL ?>public/css/normalize.css">
    <!-- bootstrap/css -->
    <link rel="stylesheet" href="<?= URL ?>public/bootstrap/bootstrap.min.css">
    <!-- googlefont/css -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
    <!-- global/css -->
    <link rel="stylesheet" type="text/css" href="<?= URL ?>public/css/global.css">
    <!-- global/JS -->
    <script src="<?= URL ?>JS/globalJS.js"></script>
    <!-- icons/fontawesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <!-- bootstrap/JS -->
    <script src="<?= URL ?>public/bootstrap/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link fs-4 ps-2" href="<?= URL ?>home">Home</a> <!-- on ajoute la constate dans laquelle on a récrit les url ce qui nous permet de partir toujours de la racine -->
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-4 ps-2" href="<?= URL ?>articles">Articles</a>
                </li>
                <?php if (array_key_exists('name', $_SESSION) == TRUE && $_SESSION['role'] == 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link fs-4 ps-2" href="<?= URL ?>admin">Admin</a>
                </li>
                <?php endif; ?>
            </ul>
            <div class="login-nav container-fluid d-lg-flex justify-content-lg-end">
                <ul class="navbar-nav mr-auto">
        <?php if (array_key_exists('name', $_SESSION) == TRUE): ?>
                    <li class="nav-item"><a class="nav-link fs-4" href="<?= URL ?>logout">LogOut</a></li>
        <?php else: ?>
                    <li class="nav-item"><a class="nav-link fs-4" href="<?= URL ?>login">SignIn</a></li>
                    <li class="nav-item"><a class="nav-link fs-4" href="<?= URL ?>signup">SignUp</a></li>
        <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

        <div class="container text-center">
            <h1 class="text-origin my-3"><?= $title ?></h1>
        </div>
        <main><?= $content ?></main>
</body>
</html>