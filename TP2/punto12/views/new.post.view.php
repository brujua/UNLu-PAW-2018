<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Blog UNLu</title>
</head>
<body>
<header>
    <h1> Blog de la UNlu </h1>

</header>
<nav>
    <form action="../index.php" method="get">
        <button type="submit"> Ver posts</button>
    </form>
    <form action="new.post.view.php" method="get">
        <button type="submit">Crear nuevo post</button>
    </form>
</nav>
<main>
    <h2>Crear nuevo post</h2>
    <form action="../nuevopost.php" method="post" enctype="multipart/form-data">

        <label for="pic">Subir imagen: </label>
        <input type="file" name="pic" id="pic"><br>

        <label for="titulo"> Titulo: </label>
        <input type="text" name="titulo" id="titulo"><br>

        <label for="descrp">Descripción: </label>
        <input type="text" name="descrp" id="descrp"><br>
        <label for="tags">Tags (ingrese los tags que desee, separados por '<b>;</b>'</label> <br>
        <input type="text" name="tags" id="tags">

        <br>
        <button type="submit">Terminado</button>

    </form>

</main>
<footer>
    <small>UNLu - Programación web - Crisafulli Bruno - Mario Quiroga</small>
</footer>
</body>
</html>