<?php
     
    $weather = "";
    $error = "";
     
    if ($_GET['pays']) {
         
     $apiData = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['pays']).",&APPID=2c225447269f77108e9170445fcd768e");
         
        $weatherArray = json_decode($apiData, true);
   
        if ($weatherArray['cod'] == 200) {
            
            $weather ="<b>".$_GET['pays']."</b>"." maintenant '".$weatherArray['weather'][0]['description']."'. ";
			
            $tempInCelcius = intval($weatherArray['main']['temp'] - 273);
            
            $weather .= "<br><b>La température à </b>".$tempInCelcius."&deg;C .<br> <b>la vitesse du vent<b/> est ".$weatherArray['wind']['speed']." m/s.";
            
			$weather .= "<br><b>L'humidité à </b>".$weatherArray['main']['humidity']."%. ";

        } else {
             
            $error = "Error - veuillez réessayer.";
             
        }
         
    }
 
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <style type="text/css">
 
         
          body {
               
              background: none;
               
          }
           
          .container {
               
              text-align: center;
              margin-top: 100px;
              width: 450px;
               
          }
		  .container h1{
			  font-size: 50px;
			  color: #fff;
			  font-weight: 100;
			  transition: 0.2s;
		  }
		  .container h1:hover{
			  -webkit-text-stroke: 2px #fff;
			  color: transparent;
			  
		  }
		.back-video{
			position : absolute;
			right: 0;
			bottom: 0;
			z-index: -1;
		}
		@media (min-aspect-ratio: 16/9){
			.back-video{
				width: 100%;
				height: auto;
			}
		}
		@media (max-aspect-ratio: 16/9){
			.back-video{
				width: auto;
				height: 100%;
			}
		}
          input {
               
              margin: 20px 0;
               
          }
           
          #weather {
               
              margin-top:15px;
               
          }
    </style>
     
              
 
  <title>Météo du Maghreb</title>
</head>
<body>
    <div class="container">
          <video autoplay lop muted plays-inline class="back-video">
			<source src="video.mp4" type="video/mp4">
		  </video>
          <h1><b>Savoir la Météo au temps réel</b></h1>
           
           
           
          <form>
  <fieldset class="form-group">
    <label for="pays"><b>Taper le nom d'un pays.</b></label>
    <input type="text" class="form-control" name="pays" id="pays" placeholder="Ex. Tunisie, Algérie,Maroc" value = "<?php echo $_GET['pays']; ?>">
  </fieldset>
   
  <button type="submit" class="btn btn-primary">Search</button>
</form>
       
          <div id="weather"><?php
               
              if ($weather) {
                   
                  echo '<div class="alert alert-success" role="alert">
  '.$weather.'
</div>';
                   
              } else if ($error) {
                   
                  echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';
                   
              }
               
              ?></div>
      </div>
 
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
</body>
</html>