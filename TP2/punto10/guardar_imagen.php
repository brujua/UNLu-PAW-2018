<?php
include ("index.html");
error_reporting(E_ALL ^ E_NOTICE);
function redimensionar($rutaimg, $target_file_thumbs, $newwidth, $newheight){  		
		$imagen = imagecreatefromjpeg($rutaimg);  				
		$new = imagescale ($imagen, $newwidth, $newheight);	
		imagejpeg($new,$target_file_thumbs,100);
		echo '<img src="'.$target_file_thumbs.'">';
	}    

#Defino la carpeta de las imagenes
$imagenes = "imagenes/";

#Defino la carpeta de las imagenes thumbs
$thumbs = "imagenes/thumbs/";
$uploadOk = 1;
$target_file = $imagenes . basename($_FILES["fileToUpload"]["name"]);
$target_file_thumbs = $thumbs . basename($_FILES["fileToUpload"]["name"]);

#Variable para el tipo de archivo
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
echo "Ruta del archivo en el servidor: ".$target_file."<br>";
echo "Ruta del archivo redimensionado en el servidor: ".$target_file_thumbs."<br>";

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image " . $check["mime"] . "."."<br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "El archivo ya existe, no se ha guardado la imagen.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Lo sentimos, el archivo es muy grande.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "jpeg") {
    echo "Lo sentimos, solo se permite archivos con extension JPG o JPEG.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "El archivo no ha sido guardado.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {		
        echo "El archivo ". basename( $_FILES["fileToUpload"]["name"]). " se ha guardado correctamente."."<br>";		
		redimensionar($target_file, $target_file_thumbs, 100, 75);	
    } else {
        echo "Ocurrió un error al guardar la imagen.";
    }
}
?>