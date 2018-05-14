<style>
.weather-app {
    width: 135%;
    height: 100vh;
    margin: 0 auto;
    margin-top: 200px;
    overflow: hidden;
    max-height: 350px;
}
.days-of-the-week {
    width: 100%;
    margin: 0 auto;
    text-align: center;
    height: 350px;
    overflow: hidden;
}
.days-of-the-week li {
    width: 12.8%;
    height: auto;
    min-height: 280px!important;
    border: none;
    display: inline-block;
    transition: ease .2s;
    margin: 0;
    padding: 0;
    font-size: 8px;
    color: #ccc;
    font-weight: 600;
    padding-top: 0px;
    text-shadow: 0px 1px 3px #333;
    margin-left: -3px;
    margin-right: -3px;
    color: #222;
}
.days-of-the-week li:hover {
    cursor:pointer;
    padding: 0px;
    margin:0px;
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.2);
    -ms-transform: scale(1.5);
    transform: scale(1.2);
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
	
}
.monday {
    background: url('https://static.pexels.com/photos/113/sky-clouds-cloudy-weather-medium.jpg') no-repeat center center;
    background-size: cover;
    -webkit-box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    -moz-box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    position: relative;
    z-index: 12;
}
.tuesday {
    background: url('https://static.pexels.com/photos/6566/sea-sky-clouds-weather-medium.jpg') no-repeat center center;
    background-size: cover;
    -webkit-box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    -moz-box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    position: relative;
    z-index: 10;
}
.wednesday {
    background: url('https://static.pexels.com/photos/799/city-lights-night-clouds-medium.jpg') no-repeat center center;
    background-size: cover;
    -webkit-box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    -moz-box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    position: relative;
    z-index: 9;
}
.thursday {
    background: url('https://static.pexels.com/photos/896/city-weather-glass-skyscrapers-medium.jpg') no-repeat center center;
    background-size: cover;
    -webkit-box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    -moz-box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    position: relative;
    z-index: 8;
}
.friday {
    background: url('https://static.pexels.com/photos/4022/cold-snow-forest-trees-medium.jpeg') no-repeat center center;
    background-size: cover;
    -webkit-box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    -moz-box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    position: relative;
    z-index: 7;
}
.saturday {
    background: url('https://static.pexels.com/photos/3768/sky-sunny-clouds-cloudy-medium.jpg') no-repeat center center;
    background-size: cover;
    -webkit-box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    -moz-box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    box-shadow: 8px 0px 12px -1px rgba(0, 0, 0, 0.53);
    position: relative;
    z-index: 6;
}
.sunday {
    background: url('https://static.pexels.com/photos/6923/mountains-fog-green-beauty-large.jpg') no-repeat center center;
    background-size: cover;
    position: relative;
    z-index: 5;
}
.image_title {
	background: rgba(0, 0, 0, 0.5);
	position: absolute;
	left: 0; bottom: 0;	
    width: 100%;	
}
.image_title a {
	display: block;
	color: #fff;
	text-decoration: none;
	padding: 20px;
	font-size: 16px;
}
.img-circle{
    cursor:pointer;
}
.img-circle:hover{
    box-shadow: 0 0 24px 0 #00ACED;
}

</style>

<div class="row">
    <div class="col-lg-12" style="background-image:url('media/background.png');background-size:cover;height:800px;">
        <div class="col-lg-12 container">
            <div class="col-lg-2">
                <center>
                    <img id="adHome" src="media/home_icon.png" class="img-circle" style="height:60px;margin-top:30px;padding:0px;">
                    <img id="adBack" src="media/back_icon.png" class="img-circle" style="height:60px;margin-top:30px;padding:0px;">
                </center>
            </div>
            <div class="col-lg-10" style="margin-top:20px;color:#fff;padding:0px;"><h1><b><?=$adtitle;?></b></h1></div>
        </div>
        
        <div class="col-lg-12">
            <main class="weather-app">
              <ul class="days-of-the-week">
				
                <li class="monday active">
                    <div class="image_title">
                        <a href="#">Activities</a>
                    </div> 
                </li>
                <li class="monday">
                    <div class="image_title">
                        <a href="#">Nightlife</a>
                    </div> 
                </li>
                <li class="monday">
                    <div class="image_title">
                        <a href="#">Restaurants</a>
                    </div> 
                </li>
				
              </ul>
            </main>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#adBack").on("click",function() {
	window.history.back();
  });
  
  $("#adHome").click("click",function() {
	window.location.href = "advertiser-dashboard.php";
  });
});
</script>
<?php include'views/script-foot.php' ?>