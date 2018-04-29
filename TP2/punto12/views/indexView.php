<!DOCTYPE html>
<html lang="es">
<head>
    <title>Peliculas</title>
</head>
<body>
<nav>
    <ul>
        <li><a href="views/new.post.view.php">Nuevo Post</a></li>
    </ul>
</nav>
<main>
    <section id="listado_posts">
        <h1>BLOG de la UNLu</h1>
        <?php if ($posts) : ?>
            <?php foreach ($posts as $post) : ?>
                <?php $datos = $post->getCamposAndValues(); ?>
                <?php $tags = $post->getTags(); ?>
                <?php $comments = $post->getComments(); ?>
                <article>
                    <h2><?= $datos['title'] ?></h2>
                    <?php if ($datos['imgname'] != null): ?>
                        <img src="imgs\<?= $datos['imgname'] ?>" alt="">
                    <?php endif; ?>
                    <p><?= $datos['descr'] ?></p>
                    <small><?= $datos['fecha'] ?></small>
                    <?php if (!empty($tags)) : ?>
                        <h4>Tags</h4>
                        <ul>
                            <?php foreach ($tags as $tag) : ?>
                                <li><?= $tag ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div>
                        <form action="editPostControl.php" method="post">
                            <input type="number" name="idPost" value="<?= $post->getID(); ?>" style="display: none">
                            <button type="submit"> Editar</button>
                        </form>
                    </div>

                    <section>
                        <h3>Comentarios</h3>
                        <?php if ($comments) : ?>
                            <?php foreach ($comments as $comm) : ?>
                                <div class="comment" title="">
                                    <h3>Author: <?= $comm->getAuthor() ?></h3>
                                    <p> <?= $comm->getBody() ?> </p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <form action="addComment.php" method="post">
                            <label for="">Author: </label>
                            <input type="text" name="author"> <br>
                            <input class="paragraphInput" type="text" name="body"> <br>
                            <input type="number" name="idPost" value="<?= $post->getID(); ?>" style="display: none">
                            <button type="submit"> Agregar Comentario</button>
                        </form>
                    </section>

                </article>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No hay posts cargados</p>
        <?php endif; ?>
    </section>
</main>
</body>
<footer>
    <small>UNLu - Programación web - Crisafulli Bruno - Mario Quiroga</small>
</footer>
</html>
