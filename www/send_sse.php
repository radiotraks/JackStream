
<?php



header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
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
echo $theartist;
//echo "</br>";
echo $thetrack;
//echo "</br>";

$json = "http://ws.audioscrobbler.com/2.0/?method=track.getInfo&artist={$theartist}&track={$thetrack}&api_key=09f6cfe5ac2d475ea0c04ce22ba65493&format=json";
//$artistID = "https://itunes.apple.com/search?term=Police&attribute=albumTerm&entity=song&limit=1";
$json = file_get_contents($json);
$json = json_decode($json);

//var_dump($json);

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
                return '<img width="65%" src="' . $file . '" />';
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
 
        return '<img width="65%" src="data:image/jpg;base64,'.$imageData.'" />';
 
        }
 
}


if($thealbum && $theartist){
 
        //get album cover
        //echo "<h2>".$artist."</h2><br><h3>".$album."</h3>";
        $album_image = getAlbum($theartist,$thealbum,4);
        if($album_image) {
               // echo $album_image."<br>";
        }
 
} else if($theartist){
 
        //get artist photo
        //echo "<h2>".$theartist."</h2><br>";
        $artist_image = getArtistPhoto($theartist,2);
        if($artist_image) {
               // echo $artist_image."<br>";
        }
        getArtistAlbums($theartist,3);
 
} else {
        echo 'Nope.';
}
 

echo "retry: 20000\n
data: <ul class='ui-listview'><li class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c'><div class=ui-btn-inner ui-li><div align='center'><h3 class=ui-li-heading>$artist </h3> <p class=ui-li-desc>$track </p><p>$album_image</p> </div></div></li</ul>\n\n ";

ob_flush();






?>
