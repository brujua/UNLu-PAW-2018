<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Blog UNLu</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <meta name="author" content="Bruno Crisafulli y Mario Quiroga">
</head>

<body>
    <header>
        <h1> Blog de la UNlu </h1>

    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="nuevoPostController.php">Nuevo Post</a></li>
        </ul>
    </nav>
    <main>
        <h2>Crear nuevo post</h2>
        <form action="nuevopost.php" method="post" enctype="multipart/form-data">

            <label for="pic">Subir imagen: </label>
            <input type="file" name="pic" id="pic"><br>

            <label for="titulo"> Titulo: </label>
            <input type="text" name="titulo" id="titulo"><br>

            <label for="descrp">Descripción: </label>
            <textarea name="descrp" id="descrp"></textarea><br>
            <label for="tags">Tags (ingrese los tags que desee, separados por ' <b> ; </b> ' o ' <b> , </b> ')</label> <br>
            <input type="text" name="tags" id="tags">

            <br>
            <button class="submit" type="submit">Terminado</button>

        </form>

    </main>
    <footer>
        <small>UNLu - Programación web - Crisafulli Bruno - Mario Quiroga</small>
    </footer>
</body>

</html>
