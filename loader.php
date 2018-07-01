<?php
  //ini_set('display_errors', 'On');
  //error_reporting(E_ALL ^ E_WARNING);
  //error_reporting(E_ALL | E_STRICT);

  // Start the PHP session
  session_start(); 
  
  // Include the WebBuilder
  require("PHP/WebBuilder.php");
  
  if ($theWB->IsLogged()) {
    if (isset($_GET["load"]) && isset($_POST["url"])) {
      // Load the page
      $ch = curl_init();
      $url = $_POST["url"];
      $header = array(
        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0'
      );
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $response_body = curl_exec($ch);
      $myfile = fopen("Load/page.html", "w");
      fwrite($myfile, $response_body);
      fclose($myfile);
      $data = array();
      // Search the filter
      $sql = "SELECT DivTgt, UrlSrc FROM LightReaderFilter ";
      $sql .= "WHERE locate(Filter, '" . $url . "') > 0 ";
      $sql .= "LIMIT 1";
      $cols = ["tgt", "srcUrl"];
      $data = $theWB->ExecSelectSQL($sql, $cols);
      if (isset($data[0])) {
        $data[0]["err"] = "ok";
        echo json_encode($data[0]);
      } else {
        echo '{"err":"No filter for the url ' . $url . '"}';
      }
    } else if (isset($_GET["add"]) && isset($_POST["url"])) {
      $theWB->ExecInsertSQL("LightReaderToRead", 
        array("Url"), "s", array($_POST["url"]));
      $data = array();
      $data["ref"] = $theWB->_insert_id;
      $data["url"] = $_POST["url"];
      $data["err"] = "ok";
      echo json_encode($data);
    } else if (isset($_GET["del"]) && isset($_POST["urlRef"])) {
      $theWB->ExecDeleteSQL("LightReaderToRead", 
        "Reference = ?", "s", array($_POST["urlRef"]));
      $data = array();
      $data["err"] = "ok";
      echo json_encode($data);
    }
  }
?>
