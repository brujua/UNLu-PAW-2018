<?php
require __DIR__ . '/../core/PdoFactory.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');


# REDIMENSIONA LA IMAGEN Y LA GUARDA EN LA CARPETA /imagenes/thumbs
function redimensionar($rutaimg, $target_file_thumbs){       
    $source_img = imagecreatefrompng($rutaimg);
    $width = imagesx($source_img);
    $height = imagesy($source_img);

    $thumbnail_w = 100;
    $thumbnail_h = 75;
    $dest_img = imagecreatetruecolor($thumbnail_w, $thumbnail_h);
    imagecopyresampled($dest_img, $source_img, 0, 0, 0, 0,
        $thumbnail_w, $thumbnail_h,
        $width, $height);

    ob_start();
    if (!imagepng($dest_img, $target_file_thumbs)) {
        die();
    }
    ob_end_clean();
}
#PERSISTE UNA IMAGEN EN BD, 
function insertImgDB($ruta, $target_file_thumbs, $nombre){   
    $pdo = PdoFactory::build();     
    $query = $pdo->prepare("INSERT INTO imagenes (nombre, imagen) VALUES (:nombre, :imagen);");
    $fp = fopen($ruta, 'rb');
    $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $query->bindParam(':imagen', $fp, PDO::PARAM_LOB);
    $query->execute();
    redimensionar($ruta, $target_file_thumbs);

}

##########################################################################
#            MAIN 
#Defino la carpeta de las imagenes thumbs
$thumbs = "imagenes/thumbs/";
$imagenes = "imagenes/";
$uploadOk = 1;
$target_file = $imagenes . basename($_FILES["fileToUpload"]["name"]);
$target_file_thumbs = $thumbs . basename($_FILES["fileToUpload"]["name"]);

#Variable para el tipo de archivo
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


# CHEQUEO LA IMAGEN
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
// Check file size  
// SE PERMITE CARGAR HASTA 10 MB
if ($_FILES["fileToUpload"]["size"] > 10000000) {
    echo "Lo sentimos, el archivo es muy grande.";
    $uploadOk = 0;
}
// SOLO FORMATO PNG
// Allow certain file formats
if($imageFileType != "png") {
    echo "Lo sentimos, solo se permite archivos con extension png.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "El archivo no ha sido guardado.";
// if everything is ok, try to upload file
} else {
        
        # SI TODO ESTÁ TODO OK, HAGO INSERT EN LA BD		
        insertImgDB($_FILES["fileToUpload"]["tmp_name"], $target_file_thumbs, basename( $_FILES["fileToUpload"]["name"]));
}