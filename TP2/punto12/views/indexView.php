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
                <?php $comments = $post->getComments(); ?>
                <article>
                    <h2><?= $datos['title'] ?></h2>
                    <?php if ($datos['imgname'] != null): ?>
                        <img src="imgs\<?= $datos['imgname'] ?>" alt="">
                    <?php endif; ?>
                    <p><?= $datos['descr'] ?></p>
                    <small><?= $datos['fecha'] ?></small>
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
