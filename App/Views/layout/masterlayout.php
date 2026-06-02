<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        .content {
            
        }
    </style>
</head>
<body>
    <div><?php require_once '../App/Views/layout/partial/header.php'; ?></div>
    <div class="content">
        <?php
            require_once '../App/Views/' . $viewName . '.php'; 
        ?>
    </div>
    <div><?php require_once '../App/Views/layout/partial/footer.php'; ?></div>
</body>
</html>