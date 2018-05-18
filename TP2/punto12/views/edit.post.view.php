<!DOCTYPE html>
<html lang="es">

<head>
    <title>Blog Unlu</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <meta name="author" content="Bruno Crisafulli y Mario Quiroga">
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="nuevoPostController.php">Nuevo Post</a></li>
        </ul>
    </nav>
    <main>
        <?php if ($post) : ?>
        <?php $datos = $post->getCamposAndValues(); ?>
        <?php $tagStr = $post->getStrTags(); ?>
        <form action="editPost.php" method="post" enctype="multipart/form-data">
            <h2>Editar Post </h2>
            <label for="title">Titulo:</label>
            <input type="text" name="title" value="<?= $datos['title'] ?>">
            <label for="desc">Cuerpo</label>
            <input type="text" name="desc" value="<?= $datos['descr'] ?>">
            <label for="tags"> Tags (separados por '<b>;</b>' o '<b>,</b>')</label>
            <input type="text" id="tags" name="tags" value="<?= $tagStr ?>">
            <label for="pic">Cambiar imagen: </label>
            <input type="file" name="pic" id="pic"><br>
            <button class="submit" type="submit">Terminado</button>
            <input type="number" value="<?= $post->getID() ?>" style="display:none" name="idP">

        </form>
        <?php else: ?>
        <p>No se ha seleccionado el Post a editar</p>
        <?php endif; ?>

    </main>
    <footer>
        <small>UNLu - Programación web - Crisafulli Bruno - Mario Quiroga</small>
    </footer>
</body>

</html>
