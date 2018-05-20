<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guardar Imagenes</title>
    <meta name="author" content="Bruno Crisafulli, Mario Quiroga">    
    <link rel="stylesheet" type="text/css" href="css/punto10.css">
</head>
<body>
	<section>
	<h1>Guardar Imágenes</h1>
		<form action="save.php" method="post" enctype="multipart/form-data">	
			<label><b>Seleccione la imagen</b></label>
			<input type="file" name="fileToUpload" id="fileToUpload"><br>
			<input type="submit" value="Enviar Imagen" name="submit"">		
		</form>
	</section>

	<section>
		<?php if(count($imagenes)!==0): ?>

			<h1> Imagenes Guardadas </h1>			
			
			<?php foreach ($imagenes as $img ): ?>
				<h3> Nombre: <?= $img['nombre'] ?>	ID: <?= $img['id_imagen']?> </h3>
				
				<?php 	ob_start(); // Let's start output buffering.
	    				fpassthru($img['imagen']); //This will normally output the image, but because of ob_start(), it won't.
    					$contents = ob_get_contents(); //Instead, output above is saved to $contents
    					ob_end_clean(); //End the output buffer.    					
    					$dataUri = "data:image/png;base64," . base64_encode($contents);
    			?>
    			<img src=<?= $dataUri ?> />
    		<?php endforeach; ?>
    		
       	<?php endif; ?>		
	</section>
</body>
</html>