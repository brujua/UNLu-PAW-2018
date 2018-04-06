<?php


require_once "utils.php";

echo blogStart();

echo "<main>";


$doc = new DOMDocument();
$doc->load("posts.xml");
$xml = $doc->getElementsByTagName("xml")->item(0);
$posts = $xml->getElementsByTagName("post");
for ($i = 0; $i < $posts->length; $i++) {
    echo "<article>";
    $imgName = null; // variable usada para guardar las direcciones de las imagenes
    $imgNode = $posts->item($i)->getElementsByTagName("imgName");
    //Si el post tenia imagen, devolverá un nodo
    if ($imgNode->length > 0) {
        $imgName = $imgNode->item(0)->nodeValue;
        echo "<img src=\"imgs\\";
        echo "$imgName";
        echo "\" alt=\"\">";
    }
    //recupero fecha
    $fechaNode = $posts->item($i)->getElementsByTagName("date");
    $fecha = $fechaNode->item(0)->nodeValue;
    //recupero titulo
    $titleNode = $posts->item($i)->getElementsByTagName("title");
    $title = $titleNode->item(0)->nodeValue;
    //recupero descripcion
    $descNode = $posts->item($i)->getElementsByTagName("descrp");
    $desc = $descNode->item(0)->nodeValue;

    echo " <h2> $title</h2>
        <p> $desc</p>
        <small> $fecha</small>";

    //Imprimo boton para editar el post
    echo "<form action=\"editarPost.php\" method=\"post\">
            <input type=\"text\" value=\"$fecha\" style=\"display:none\" name='fecha'>
            <button type=\"submit\">Editar</button>
        </form>
    </article>";


} // fin for

echo "</main>";

echo blogEnd();