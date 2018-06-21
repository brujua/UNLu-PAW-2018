<!DOCTYPE html>
<?php $config = parse_ini_file('key.conf')?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Api Google Maps</title>
    <meta name="author" content="Bruno Crisafulli y Mario Quiroga">
    <link rel="stylesheet" type="text/css" href="css/map.css">
    <script type="text/javascript" src="js/myMap.js"></script>
</head>
<body>
    <div class="map-cointainer">
        <input id="place-input" class="controls" type="text" placeholder="Ingrese Ubicacion">

        <section id="map"></section>
    </div>
</body>
<script src="https://maps.googleapis.com/maps/api/js?key=<?=$config['key'];?>&callback=MyMap.initMap&libraries=places" async defer></script>
</html>