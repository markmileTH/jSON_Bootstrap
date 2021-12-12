<!DOCTYPE html>
<html>

<head>
     <title>Simple Map</title>
     <meta name="viewport" content="initial-scale=1.0">
     <meta charset="utf-8">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
          crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.6.0.js"
          integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2a9VcSrpcXvIpAlNpitfvAmiqkBx67mw&callback=initMap"
          async defer></script>

     <style>
          /* Always set the map height explicitly to define the size of the div
          * element that contains the map. */
          #map {
               height: 100%;
          }

          /* Optional: Makes the sample page fill the window. */
          html,
          body {
               height: 100%;
               margin: 0;
               padding: 0;
               background-color: gray;
          }

          #map {
               height: 600px;
               width: 600px;
               display: block;
               margin: auto;
          }
     </style>
</head>

<body>
     <div class="container">
          <div class="mb-3 row">
               <label for="inputlat" class="col-sm-2 col-form-label">lat</label>
               <div class="col-sm-10">
                    <input type="text" class="form-control" id="x">
               </div>
               <label for="inputlon" class="col-sm-2 col-form-label">lng</label>
               <div class="col-sm-10">
                    <input type="text" class="form-control" id="y">
               </div>

               <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="button" id="btnLoad">Load</button>
               </div>

               <div id="map"></div>
               <script>
                    var map;
                    function initMap(x, y) {
                         map = new google.maps.Map(document.getElementById('map'), {
                              center: { lat: x, lng: y },
                              zoom: 11
                         });
                    };


               </script>

               <div id="name">

               </div>


          </div>


     </div>


</body>
<script>
     //input and show map
     alert("โปรดใส่ค่าlatกับlng")
     $("#map").hide();
     $("#btnLoad").click(() => {
          $("#map").show();
          var x = parseInt($("#x").val());
          var y = parseInt($("#y").val());
          initMap(x, y);
          getjson(x, y);

     });

     function getjson(x, y) {
          var url = "https://api.openweathermap.org/data/2.5/weather?lat=" + x + "&lon=" + y + "&appid=525ddb052cfb1b0107daeefdbac39a88"
          $.getJSON(url)
               .done((data) => {
                    
                    let temp_data = data.main.temp;
                    var temp = temp_data - 273;

                    let time_stamp = data.dt;
                    var time = new Date(time_stamp * 1000);
                    var hours = time.getHours();
                    var minutes = "0" + time.getMinutes();
                    var seconds = "0" + time.getSeconds();
                    var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);

                    let time_stamp_sunrise = data.sys.sunrise;
                    var sunrise = new Date(time_stamp_sunrise * 1000);
                    var hours_sunrise = sunrise.getHours();
                    var minutes_sunrise = "0" + sunrise.getMinutes();
                    var seconds_sunrise = "0" + sunrise.getSeconds();
                    var formattedSunrise = hours_sunrise + ':' + minutes_sunrise.substr(-2) + ':' + seconds_sunrise.substr(-2);

                    let time_stamp_sunset = data.sys.sunset;
                    var sunset = new Date(time_stamp_sunset * 1000);
                    var hours_sunset = sunset.getHours();
                    var minutes_sunset = "0" + sunset.getMinutes();
                    var seconds_sunset = "0" + sunset.getSeconds();
                    var formattedSunset = hours_sunset + ':' + minutes_sunset.substr(-2) + ':' + seconds_sunset.substr(-2);

                    let time_now = new Date();
                    var now = time_now.toLocaleString();

                    var line = "<div class='accordion-item'>"

                    line += "<h2 class='accordion-header'><button  class='accordion-button collapsed ' data-bs-toggle='collapse' data-bs-target='#content1'aria-expanded='false'>" + data.name + " </button> </h2>"

                    line += "<div id='content1' class='collapse ' >"
                    line += "<div class='accordion-body'>"
                    line += "<p>ณ เวลา= " + formattedTime + "น.</p>"
                    line += "<p>อุณหภูมิ= " + temp.toFixed(2) + "°C</p>"
                    line += "<p>ความชื้นสัมพัทธ์= "+ data.main.humidity +"%</p>"
                    line += "<p>ดวงอาทิตย์ขึ้นเวลา= "+ formattedSunrise +"น.</p>"
                    line += "<p>ดวงอาทิตย์ตกเวลา="+ formattedSunset +"น.</p>"
                    line += "<p>วันเวลาสืบค้น:"+ now +"</p>"
                    line += "</div>"
                    line += "</div>"
                    line += "</div>"
                    $("#name").append(line);

               })


     }
</script>

</html>
