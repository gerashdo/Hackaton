<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BatchApp</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/crearreportes.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/BachApp.ico" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>


</head>
<body onload="findMe();" >
    <section class="container creaReporte">
        <h1 class="crearReporte__title">Crear reporte</h1>
    <br>
        <label for="" class="crearReporte__label">Ubicacion</label>
    <div id="map"></div>
    <div id="mapid" ></div>

    <br>

    <?php
    if (isset($_SESSION['message']) && $_SESSION['message'])
    {
      printf('<b>%s</b>', $_SESSION['message']);
      unset($_SESSION['message']);
    }

if($_COOKIE['archivosubido']!=TRUE){
  ?>

  <form method="POST" action="upload.php" enctype="multipart/form-data">
    <div>
    
      <input type="file" name="uploadedFile" class="crearReporte__input" />
    </div>

    <input type="submit" name="uploadBtn" value="Subir"class="crearReporte__input"  />
  </form>
  <?php
  }
  ?>


    <br>
    <form action="registrarincidente.php" name="registro" method="POST">
    <input type="hidden" id="latitud"  name="latitud" >
    <input type="hidden" id="longitud" name="longitud" >
    <input type="hidden" name="foto" value=<?php echo $_COOKIE['nombrearchivo']?>>
    <input type="hidden" id="fecha" name="fecha">
    <input type="hidden" id="hora" name="hora">
    

    <button type="submit" id="crearReporte_buton" >Reportar</button>
    </form>
    
</section>
</body>


<script>
        function findMe() {
            var latitude = 21.852503 ;
            var longitude = -102.261558;
            var output = document.getElementById('map');




            //Obtenemos latitud y longitud




                var mensaje = "esta es tu casa"

                var mymap = L.map('mapid').setView([latitude, longitude], 15);

                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                    maxZoom: 18,
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/streets-v11',
                    tileSize: 512,
                    zoomOffset: -1
                }).addTo(mymap);

                L.marker([latitude, longitude]).addTo(mymap)
                    .bindPopup(mensaje);

                var popup = L.popup();

                L.circle([latitude, longitude], 100, {
                    color: 'red',
                    fillColor: '#f03',
                    fillOpacity: 0.5
                }).addTo(mymap).bindPopup("Probable zona");
                function onMapClick(e) {
                    popup
                        .setLatLng(e.latlng)
                        .setContent("You clicked the map at " + e.latlng.toString())
                        .openOn(mymap);
                }
                mymap.on('click', onMapClick);
            }

            navigator.geolocation.getCurrentPosition(localizacion, error);
            var f = new Date();

            document.registro.latitud.value = latitude;
            document.registro.longitud.value = longitude;
            document.registro.fecha.value = f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate();
            document.registro.hora.value = f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds();
           

        
    </script>





<script>

</script>
</html>