<?php
require 'include/php_header.php';
require 'include/db.php';

    if (!isset($_GET['q']) || empty($_GET['q'])) {
        header("Location: ./");
        exit;
    }

    $q = $_GET['q'];
    
    $subFolder = false;
    $_TITLE = $_GET['q']." | Search | ".$_BRAND;
    $_PAGE = "search";

    $sql = "SELECT * FROM posts WHERE content LIKE concat('%', '?', '%') OR uid LIKE concat('%', '?', '%')"; // concat('%', '?', '%') =='%$q%'
    $stmt = $conn->prepare($sql);

    if (!$stmt->execute([$q, $q])) {
        echo "FATAL ERROR: ";
        exit;
    }

    $result = $stmt->fetchAll();

    if ($stmt->rowCount() == 0) {
        $found = false;
    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <?php require 'include/meta.php'; ?>
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>

<?php require 'include/nav.php';
    if (!$found) {
        echo "Nothing found";
    } else {
        foreach($result as $post): ?>
            <div class="tets"><?=$post['username']?></div>
        <?php endforeach;
    }
    ?>
    </div>
</body>
</html>