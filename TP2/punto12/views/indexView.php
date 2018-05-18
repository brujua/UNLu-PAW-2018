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
        <section class="listado-posts">
            <h1>BLOG de la UNLu</h1>
            <?php if ($posts) : ?>
            <?php foreach ($posts as $post) : ?>
            <?php $datos = $post->getCamposAndValues(); ?>
            <?php $tags = $post->getTags(); ?>
            <?php $comments = $post->getComments(); ?>
            <article class="post">
                <h2>
                    <?= $datos['title'] ?>
                </h2>
                <?php if ($datos['imgname'] != null): ?>
                <img src="imgs\<?= $datos['imgname'] ?>" alt="">
                <?php endif; ?>
                <p>
                    <?= $datos['descr'] ?>
                </p>
                <div class="meta-post">
                    <span class="fechaPost"><?= $datos['fecha'] ?></span>
                    <?php if (!empty($tags)) : ?>

                    <!-- <section class="tags">-->
                    <!-- <h4>Tags</h4>-->

                    <div>
                        <ul class="tags">
                            <?php foreach ($tags as $tag) : ?>
                            <li>
                                <a href="#">
                                    <?= $tag ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <!--</section>-->
                    <div>
                        <form action="editPostControl.php" method="post">
                            <input type="number" name="idPost" value="<?= $post->getID(); ?>" style="display: none">
                            <button class="editar" type="submit"> Editar</button>
                        </form>
                    </div>
                </div>

                <section class="bloque-comments">
                    <h3>Comentarios:</h3>
                    <section class="nuevo-comment">
                        <form action="addComment.php" method="post">
                            <label for="">Author: </label>
                            <input type="text" name="author">
                            <label for="body">Comentario:</label>
                            <textarea class="paragraphInput" placeholder="Deja un comentario..." name="body"></textarea>
                            <input type="number" name="idPost" value="<?= $post->getID(); ?>" style="display: none">
                            <button class="submit" type="submit"> Agregar Comentario</button>
                        </form>
                    </section>

                    <?php if ($comments) : ?>

                    <section class="otros-comments">
                        <?php foreach ($comments as $comm) : ?>
                        <div class="comment" title="">

                            <div>
                                <span class="autor"><?= $comm->getAuthor() ?></span> dijo:
                            </div>

                            <p>
                                <?= $comm->getBody() ?>
                            </p>
                        </div>
                        <?php endforeach; ?>
                    </section>
                    <?php endif; ?>

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
    <small>UNLu - Programación web -  Bruno Crisafulli - Mario Quiroga</small>
</footer>

</html>
