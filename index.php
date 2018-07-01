<?php 
  // ------------------ index.php ---------------------
  // Start the PHP session
  session_start();
  // Include the WebBuilder
  require("PHP/WebBuilder.php");
  // Process POST values
  $theWB->ProcessPOSTValues();
  // Process arguments in url
  // 'la' to set language, 'mo' to set mode, 
  // 'setupdb' to automatically setup the database
  $theWB->ProcessURLArg();
  // Include the local builder
  require("PHP/builder.php");
  // Pass data from PHP to JS
  $var["baseUrl"] = $WebBuilderConf["BaseURL"]; 
  $theWB->SetJSData($var);
?>
<!DOCTYPE html>
<html lang="<?php echo $theWB->GetLang(); ?>">
  <head>
<?php 
    echo $theWB->BuildMeta();
    echo $theWB->BuildBase();
    // must be ./Img/icon.180x180.png, ./Img/icon.196x196.png and
    // ./Img/icon.32x32.ico -->
    echo $theWB->BuildIcon();
    echo $theWB->BuildCSS();
    echo $theWB->BuildJS();
    echo $theWB->BuildTitle(); 
?>
  </head>
  <body>
<?php 

    echo $theWB->BuildDivTitle('divTitle', 'LightReader');

    if (!($theWB->IsLogged())) {
      
      echo $theWB->BuildDivLogger("index.php");
    
    } else {

      $divAddUrl = BuildDivAddUrl($theWB);
      echo $theWB->BuildDivTile("divAddUrl", $divAddUrl);

      $divView = BuildDivViewer($theWB);
      echo $theWB->BuildDivTile("divView", $divView);

      $divFilter = BuildDivFilter($theWB);
      echo $theWB->BuildDivTile("divFilter", $divFilter);

    }
    
    echo $theWB->BuildDivFooter('divFooter', 
      'LightReader - Developper: P. Baillehache');
?>
  </body>
  <script>
    window.onload = function() {
      WBBodyOnLoad('<?php echo $theWB->GetJSdata(); ?>');
      BodyOnLoad();
    }
  </script> 
</html>
