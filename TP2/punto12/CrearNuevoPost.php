<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 5/4/2018
 * Time: 2:07 AM
 */

require_once "utils.php";

echo blogStart();

echo " <main>
            <h2>Crear nuevo post</h2>
           <!-- TODO ver si no hay que agregar -->
            <form action=\"nuevopost.php\" method=\"post\" enctype=\"multipart/form-data\">
            
                <label for=\"pic\">Subir imagen:  </label>
                <input type=\"file\" name=\"pic\" id=\"pic\"><br>

                <label for=\"titulo\"> Titulo:  </label>
                <input type=\"text\" name=\"titulo\" id=\"titulo\"><br>

                <label for=\"descrp\">Descripción: </label>
                <input type=\"text\" name=\"descrp\" id=\"descrp\"><br>

                <br>
                <button type=\"submit\">Terminado</button>

            </form>

        </main>";

echo blogEnd();