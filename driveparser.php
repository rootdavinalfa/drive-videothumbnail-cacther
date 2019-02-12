<?php
header('Content-Type: application/json');

  class driveparser{
    function getjs($url){
      preg_match('@^(?:http.?://)?([^/]+)@i', $url, $matches);
  		$host = $matches[1];
  		$id = (strpos($url, 'drive.google.com') !== false) ? $this->get_drive_id($url) : $id = $_GET['id'];
      //echo $id;
      return $this->GoogleDrive($id);

    }


    function GoogleDrive($gid){
  		$image = sprintf('https://drive.google.com/thumbnail?id=%s&authuser=0&sz=w640-h360-n-k-rw', $gid);
  		//$streaming_vid = Drive($gid)
  		$output = $image;
  		//$output = json_encode($output, JSON_PRETTY_PRINT);
      //var_dump($output);
  		return $output;
  	}

    function get_drive_id($string) {
  	  if (strpos($string, "/edit")) {
  	    $string = str_replace("/edit", "/view", $string);
  	  } else if (strpos($string, "?id=")) {
  	    $parts = parse_url($string);
  	    parse_str($parts['query'], $query);
  	    return $query['id'];
  	  } else if (!strpos($string, "/view")) {
  	    $string = $string . "/view";
  	  }
  	  $start  = "file/d/";
  	  if(strpos($string, "/preview")){
  	    $end = "/preview";
  	  }elseif(strpos($string, "/view")){
  	    $end = "/view";
  	  }
  	  $string = " " . $string;
  	  $ini    = strpos($string, $start);
  	  if ($ini == 0) {
  	    return null;
  	  }
  	  $ini += strlen($start);
  	  $len = strpos($string, $end, $ini) - $ini;
  	  return substr($string, $ini, $len);
  	}




  }


?>
