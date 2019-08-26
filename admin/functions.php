<?php
function escape($string) {
  
  global $connection;
    
    return mysqli_real_escape_string($connection, trim($string));
   
                                                     }

function confirm($result) { global $connection;
  if(!$result) {
    
    die("QUERY FAILED" . mysqli_error($connection));
  
  }
}



 function compress_image($source_url, $destination_url, $quality) { // optimizes images

       $info = getimagesize($source_url);

        if ($info['mime'] == 'image/jpeg')
              $image = imagecreatefromjpeg($source_url);

        elseif ($info['mime'] == 'image/gif')
              $image = imagecreatefromgif($source_url);

      elseif ($info['mime'] == 'image/png')
              $image = imagecreatefrompng($source_url);
   
  

        imagejpeg($image, $destination_url, $quality);
    return $destination_url;
    }


function escape_string($string) {
  global $connection;
  
  return mysqli_real_escape_string($connection, $string);
}



?>