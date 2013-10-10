


 
 
 
 

<!DOCTYPE HTML>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
        <script src="http://jaysalvat.github.io/buzz/releases/latest/buzz.min.js"></script>
		<script src="http://jaysalvat.github.io/buzz/releases/latest/buzz.js"></script>
      
    </head>
    <body >
<div align="center">

 
 
  <p><?php echo "Artist: ".$data[0][3].""; ?></p>
  <p><?php echo "Title: ".$data[0][2].""; ?></p>
  <p><?php echo "Played: ".$data[0][1].""; ?></p>
  <p><?php echo "<img src=".$artwork.">"; ?></p>
   
  
    <script>
var mySound = new buzz.sound("http://icy3.abacast.com:80/nabco-wjkrfmmp3-48", {
autoplay: false
});

</script>
    <a href="javascript:mySound.togglePlay();">Play</a> | <a href="javascript:mySound.pause();">Pause</a>
		
  </p>
</div>
</body>
</html>


