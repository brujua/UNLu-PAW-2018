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
            <form action=\"nuevopost.php\" method=\"post\">
            
                <label for=\"pic\">Subir imagen:  </label>
                <input type=\"file\" name=\"pic\" id=\"pic\"><br>

                <label for=\"titleInput\"> Titulo:  </label>
                <input type=\"text\" name=\"titulo\" id=\"titleInput\"><br>

                <label for=\"Descrp\">Descripción: </label>
                <input type=\"text\" name=\"Descrp\" id=\"Descrp\"><br>

                <br>
                <button type=\"submit\">Terminado</button>

            </form>

        </main>";

echo blogEnd();