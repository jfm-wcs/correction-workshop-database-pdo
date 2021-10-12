<?php
function testInput($data)
{
    $data = trim($data); //retire les espaces en début et fin de chaîne
    $data = stripslashes($data); //échape les anti-slashes
    $data = htmlspecialchars($data); //protège des injections XSS
    return $data;
}
$errors = [];
if (!empty($_POST)) {
    require 'connect.php';
    $pdo = new PDO(DSN, USER, PASS);

    $title = testInput($_POST['title']);
    $content = testInput($_POST['content']);
    $author = testInput($_POST['author']);


    if (strlen($title) > 5) {
        $errors[] = "Texte trop long";
    }

    if (strlen($author) > 100) {
        $errors[] = "Nom d'auteur trop long";
    }

    if (empty($errors)) {
        $query = "INSERT INTO story (title, content, author) VALUES (:title, :content, :author)";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':title', $title, PDO::PARAM_STR);
        $statement->bindValue(':content', $content, PDO::PARAM_STR);
        $statement->bindValue(':author', $author, PDO::PARAM_STR);
        $statement->execute();
        header('Location: create.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une histoire</title>
</head>

<body>
    <form action="" method="post">
        <div>
            <label for="title">Titre</label>
            <input type="text" name="title" id="title">
        </div>

        <div>
            <label for="content">Contenu de l'histoire</label>
            <textarea name="content" id="content" rows="10"></textarea>
        </div>

        <div>
            <label for="author">Auteur</label>
            <input type="text" name="author" id="author">
        </div>

        <button type="submit">Sauvegarder</button>
    </form>
</body>

</html>