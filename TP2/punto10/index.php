<?php 
	require __DIR__."/getImagenes.php";				
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guardar Imagenes</title>
    <meta name="author" content="Bruno Crisafulli, Mario Quiroga">    
</head>
<body>
	<section>
	<h1>Guardar Imágenes</h1>
		<form action="guardar_imagen.php" method="post" enctype="multipart/form-data">	
			<label><b>Seleccione la imagen</b></label>
			<input type="file" name="fileToUpload" id="fileToUpload"><br>
			<input type="submit" value="Enviar Imagen" name="submit"">		
		</form>
	</section>

	<section>
		<?php

			# SI SE RECIBEN IMAGENES DE getImagenes.php, SE MUETRAN EN ESTA SECCION

			if(count($imagenes)!==0){
				echo '<h1> Imagenes Guardadas </h1>';
			}			
			foreach ($imagenes as $img ) {
				echo '<h3> Nombre: '.$img['nombre'].'		';
				echo 'ID: '.$img['id_imagen'].' </h3>';
				ob_start(); // Let's start output buffering.
	    		fpassthru($img['imagen']); //This will normally output the image, but because of ob_start(), it won't.
    			$contents = ob_get_contents(); //Instead, output above is saved to $contents
    			ob_end_clean(); //End the output buffer.
    			#echo $contents;
    			$dataUri = "data:image/png;base64," . base64_encode($contents);
    			echo "<img src='$dataUri' />";
			}
		?>
	</section>
</body>
</html>