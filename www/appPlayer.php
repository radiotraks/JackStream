<?php

$file = "data.txt";
$lines = file($file);
$count = count($lines);

// Two dimensional array
$data = array();

 $i = 0;

   foreach($lines as $value) {
   // Values delimited by \t (tab) as separate array values
   $data[$i] = explode("|", $value);
   // Increase the line index
   $i++;
}

//echo "$count lines processed&lt;br&gt;&lt;br&gt; ";

// A few examples on how to 'extract' values

// echo "First row, first column: ".$data[0][0]."<br />";
//echo "Artist: ".$data[0][3]."<br />";
//echo "Title: ".$data[0][2]."<br />";
//echo "Played: ".$data[0][1]."<br />";
//echo "Print entire data array: ";
//echo "<pre>";
//print_r($data);
//echo "</pre>";
// echo "<br>Second row: ".$lines[01];
$artist = $data[0][3];
$track =  $data[0][2];
$theartist = preg_replace('/\s+/', '+', $artist);
$thetrack = preg_replace('/\s+/', '+', $track); 
//echo $theartist;
//echo "</br>";
//echo $thetrack;
//echo "</br>";

$json = "http://ws.audioscrobbler.com/2.0/?method=track.getInfo&artist={$theartist}&track={$thetrack}&api_key=09f6cfe5ac2d475ea0c04ce22ba65493&format=json";
//$artistID = "https://itunes.apple.com/search?term=Police&attribute=albumTerm&entity=song&limit=1";
$json = file_get_contents($json);
$json = json_decode($json);

var_dump($json);

$album = $json->{'track'}->{'album'}->{'title'};
$thealbum = preg_replace('/\s+/', '+', $album); 
//echo $thealbum;

function getAlbum($theartist, $thealbum, $size) {
 
                
 
                
                $xml    = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&artist={$theartist}&album={$thealbum}&api_key=09f6cfe5ac2d475ea0c04ce22ba65493";
                $xml    = @file_get_contents($xml);
                
                if(!$xml) {
                        return;  // Artist lookup failed.
                }
                
                $xml = new SimpleXMLElement($xml);
                $xml = $xml->album;
                $xml = $xml->image[$size];
                
                $return = convert($xml);             
 
                return $return;
 
}  

function convert($file){
 
        $parts=pathinfo($file);
        //dont convert if its a jpg
        if($parts['extension'] == "jpg"){ 
                return '<img src="' . $file . '" />';
        } else {
 
        $image = imagecreatefrompng($file);
        $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
        imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
        imagealphablending($bg, TRUE);
        imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
 
        ob_start (); 
        imagejpeg($bg, NULL, 80);
        $image_data = ob_get_contents (); 
        ob_end_clean (); 
        $imageData = base64_encode ($image_data);
 
        imagedestroy($image);
        ImageDestroy($bg);
 
        return '<img src="data:image/jpg;base64,'.$imageData.'" />';
 
        }
 
}


if($thealbum && $theartist){
 
        //get album cover
        //echo "<h2>".$artist."</h2><br><h3>".$album."</h3>";
        $album_image = getAlbum($theartist,$thealbum,3);
        if($album_image) {
               // echo $album_image."<br>";
        }
 
} else if($theartist){
 
        //get artist photo
        //echo "<h2>".$theartist."</h2><br>";
        $artist_image = getArtistPhoto($theartist,3);
        if($artist_image) {
               // echo $artist_image."<br>";
        }
        getArtistAlbums($theartist,3);
 
} else {
        echo 'Nope.';
}
 

?>
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
  <p><?php echo $album_image."<br>"; ?></p>

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


