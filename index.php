<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
          crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.6.0.js"
          integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

     <title>สภาพอากาศ</title>
     <style>

     </style>
</head>

<body>

     <div class="container" style="margin-top: 30px;margin-left: 50px;">
          <div class="mb-3 row">
               <div class="col-sm-10">
                    <input type="text" class="form-control" id="x" style="width: 300px;" value="9.5877111">
               </div>
               <div class="col-sm-10">
                    <input type="text" class="form-control" id="y" style="width: 300px;" value="100.0694491">
               </div>
               <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="button" id="btnLoad" style="width: 300px;">Load</button>
               </div>
               <div class="card" style="width: 300px;margin-left: 11px;" id="Card">
                    <div class="image" style="margin-top: 15px;">
                         <img id="home" style="width: 270px;"
                              src="https://ed.edtfiles-media.com/static-cache/resize-cache/wk18/ud/gal/dcp/30/87047/IMG_0091.jpg"
                              alt="myhome">
                    </div>

                    
               </div>

          </div>





     </div>
</body>
<script>
     var x = 9.5877111
     var y = 100.0694491
     getjson(x,y);
     $("#btnLoad").click(() => {
          $("#cd").remove();
          var x = parseInt($("#x").val());
          var y = parseInt($("#y").val());
          getjson(x, y);
     });

     function getjson(x,y) {
          var url = "https://api.openweathermap.org/data/2.5/weather?lat=" + x + "&lon=" + y + "&appid=525ddb052cfb1b0107daeefdbac39a88"
          $.getJSON(url)
               .done((data) => {
                    console.log(data);
                    let temp_data = data.main.temp;
                    var temp = temp_data - 273;

                    let time_now = new Date();
                    var now = time_now.toLocaleString();

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

                    var line =  "<div class='card-body' id='cd'>"
                    line += "<h2>" + data.name + "</h2>"
                    line += "<p>อุณหภูมิ   "+ temp.toFixed(2) +" เซนเซียส</p>"
                    line += "<p>ความชื้นสัมพัทธ์ "+ data.main.humidity +"%</p>"  
                    line += "<p>ดวงอาทิตย์ขึ้นเวลา"+ formattedSunrise +" </p>"
                    line += "<p>ดวงอาทิตย์ตกเวลา"+ formattedSunset +" </p>"
                    line += "<p>ณ วันที่"+ now +"</p>"
                    line += "</div>"
                    $("#Card").append(line);
               })
     }
</script>

</html>
