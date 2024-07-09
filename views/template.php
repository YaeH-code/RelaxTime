<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relax Time</title>
    <!-- normalize/css -->
    <link rel="stylesheet" type="text/css" href="../public/css/normalize.css">
    <!-- bootstrap/css -->
    <link rel="stylesheet" href="https://bootswatch.com/5/journal/bootstrap.css">
    <!-- googlefont/css -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
    <!-- global/css -->
    <link rel="stylesheet" type="text/css" href="../public/css/global.css">
    <!-- global/JS -->
    <script src="../public/JS/globalJS.js"></script>
    <!-- icons/fontawesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>