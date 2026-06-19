<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .content {
            width: 60%;
            margin: 20px auto;
            flex: 1; 
        }
    </style>
</head>
<body>
    <div><?php require_once '../App/Views/layout/partial/header.php'; ?></div>
    <div class="content">
        <?php
            if (isset($viewName) && is_string($viewName)) {
                require_once '../App/Views/' . $viewName . '.php';
            } else {
                echo '<p>View không được xác định.</p>';
            }
        ?>
    </div>
    <div><?php require_once '../App/Views/layout/partial/footer.php'; ?></div>
</body>
</html>