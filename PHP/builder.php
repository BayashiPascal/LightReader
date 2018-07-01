 <?php 
/* ============= builder.php =========== */

function BuildDivViewer($theWB) {
  $block = '';
  // Selector for the article
  $sql = "SELECT Reference, Url FROM LightReaderToRead ";
  $cols = ["Ref", "Url"];
  $catOpts = $theWB->ExecSelectSQL($sql, $cols);
  $block .= "<select id = 'selUrl' ";
  $block .= "onchange = 'SelectUrl();'>";
  $block .= "<option value = ''></option>";
  foreach ($catOpts as $opt) {
    $block .= "<option value = '" . $opt["Ref"] . "'>";
    $block .= $opt["Url"] . "</option>";
  }
  $block .= "</select>";
  $block .= "<img id = 'imgDelUrl' src = './Img/Icons/dash.png' onclick = 'DelUrl();'><br>";
  // Div to display the url
  $block .= "<div id = 'divShowUrl'>";
  $block .= "<div id = 'divShowUrlLink'>";
  $block .= "Original link: <a id = 'aUrlLink' target = '_blank'></a><br><br>";
  $block .= "<a href = './Load/page.html' target = '_blank'>Loaded page</a><br><br>";
  $block .= "Original article content:<br><br>";
  $block .= "</div>";
  $block .= "<div id = 'divShowUrlContent'></div>";
  $block .= "</div>";
  return $block;
}

function BuildDivAddUrl($theWB) {
  $block = '';
  $block .= "<input id = 'inpAddUrl' type = 'text'>";
  $block .= "</input>";
  $block .= "<img id = 'imgAddUrl' src = './Img/Icons/plus.png' onclick = 'AddUrl();'>";
  return $block;
}

function BuildDivFilter($theWB) {
  $block = '';
  $formName = 'LightReaderFilter';
  $title = 'Filters';
  $block .= $theWB->BuildDivDBEditor($formName, $title);
  return $block;
}


?>
