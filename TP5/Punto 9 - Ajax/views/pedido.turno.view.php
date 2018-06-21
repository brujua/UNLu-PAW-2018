<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pedido de Turno</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/turno.js"></script>
    <meta name="author" content="Bruno Crisafulli y Mario Quiroga">
</head>

<body>
    <header>
        <h1>Pedido de Turno</h1>

    </header>
    <main>
        <h4> Complete el formulario para hacer el pedido</h4>
        <section class="new-turno-form">
            <form action="cargaTurno.php" id="turno-form" method="post">


                <!--imprimo los inputs texto-->
                <?php foreach ($textArr as $text): ?>
                <!--//completo los campos seteando el value del input si fue pedido visualizar un turno anterior-->
                <?php $value = ($datos[$text] ?? ""); ?>
                <!--//null coalescing operator-->
                <label for="<?= $text?> "> <?= $text?> </label>
                <input type="text" name="<?= $text ?>" value="<?= $value ?>"><br>
                <?php endforeach; ?>

                <!--//imprimo los input number-->
                <?php $value = ($datos["edad"] ?? ""); ?>
                <label for="edad">Edad</label>
                <input type="number" name="edad" value="<?= $value ?>"><br>
                <?php $value = ($datos["talle"] ?? "");?>
                <label for="talle">Talle de Calzado</label>
                <input type="number" name="talle" min="20" max="45" value="<?= $value ?>"><br>

                <!--//deslizador de altura-->

                <label for="altura">Altura</label>
                <select name="altura" size="1">
                <?php for($i = 0; $i<99;$i++): ?>

                    <?php if ($i < 10):?>
                        <option value="1,0<?= $i ?>">1,0<?= $i ?></option>
                    <?php else: ?>
                        <option value="1,<?= $i ?>">1,<?= $i ?></option>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php for($i = 0; $i<50;$i++): ?>

                    <?php if ($i < 10):?>
                        <option value="2,0<?= $i ?>">2,0<?= $i ?></option>
                    <?php else: ?>
                        <option value="2,<?= $i ?>">2,<?= $i ?></option>
                    <?php endif; ?>
                <?php endfor; ?>
                <?php  $value = ($datos["altura"]); ?>
                <?php if ($value != null): ?>
                <option value="<?= $value ?>" selected><?= $value ?></option>
                <?php endif; ?>
            </select>
                <br>
                <!--//fecha nacimiento-->
                <?php $value = ($datos["fechaNac"] ?? ""); ?>
                <label for="fecha de nacimiento">fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="<?= $value ?>"><br>
                <!-- // Horario del turno-->
                <label for="horario del turno">Horario del Turno</label>
                <select name="horario" size="1">
                <?php for($i = 8; $i<17;$i++): ?>
                    <option value="<?= $i ?>:00"><?= $i ?>:00</option>
                    <option value="<?= $i ?>:15"><?= $i ?>:15</option>
                    <option value="<?= $i ?>:30"><?= $i ?>:30</option>
                    <option value="<?= $i ?>:45"><?= $i ?>:45</option>
                <?php endfor; ?>
                <option value="17:00">17:00</option>
                <?php  $value = ($datos["horario"]); ?>
                <?php if ($value != null): ?>
                    <option value="<?= $value ?>" selected><?= $value ?></option>
                <?php endif; ?>
            </select>
                <!--Botones-->
                <br><button type="reset" value="reset">Limpiar</button>
                <button type="submit" value="submit">Enviar</button>
            </form>
        </section>
        <section id="system-msgs">

        </section>
        <section class="old-turno-form">
            <form action="index.php" method="post">
                <h2>Consultar Turno Anterior</h2>
                <label for="nroTurno">Nro de Turno</label>
                <input type="number" name="nroTurno"><br>
                <button type="submit" value="submit">Consultar</button>
            </form>
        </section>
    </main>
</body>

</html>
