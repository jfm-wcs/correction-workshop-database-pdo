<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toutes les histoires</title>
</head>

<body>
    <?php
    require 'connect.php';
    $pdo = new PDO(DSN, USER, PASS);
    $query = "SELECT * FROM story";
    $statement = $pdo->query($query);
    $stories = $statement->fetchAll();
    ?>

    <section>
        <?php foreach ($stories as $story) : ?>
            <article>
                <h1><?= $story['title'] ?></h1>
                <p><?= $story['content'] ?></p>
                <p><small><em><?= $story['author'] ?></em></small></p>
            </article>
        <?php endforeach; ?>
    </section>
</body>

</html>