/* ============= index.js =========== */

// ------------ Body.OnLoad handler

function BodyOnLoad() {
  try {
    
    // Display the url
    SelectUrl();
    
  } catch (err) {
    console.log("BodyOnLoad " + err.stack);
  }
}

function SelectUrl() {
  try {
    var url = $("#selUrl option:selected").text();
    // Hide the current content
    var node = document.getElementById("divShowUrlContent");
    while (node.firstChild)
        node.removeChild(node.firstChild);

    // Update the link
    $("#aUrlLink").attr("href", url);
    $("#aUrlLink").html(url);
    
    if (url != "") {
      
      // Display the waiting gif
      var img = document.createElement('img');
      img.src = "./Img/waiting.gif";
      node.appendChild(img);

      // Ajax request to load localy the url and display it when done
      var form = document.createElement('form');
      form.setAttribute('method', 'post');
      var inp = document.createElement("input");
      inp.setAttribute('type', "text");
      inp.setAttribute('name', 'url');
      inp.setAttribute('value', url);
      form.appendChild(inp);
      url = "./loader.php?load=1";
      theWB.HTTPPostRequest(url, form, ShowUrl);

    }
    
  } catch (err) {
    console.log("SelectUrl " + err.stack);
  }
}

function ShowUrl(data) {
  try {
    if (data["err"] !== undefined && data["err"] == "ok") {
      url = theWB._PHPdata["PHPdata"]["baseUrl"] + "Load/page.html";
      divTgt = data["tgt"];
      $("#divShowUrlContent").load(url + " " + divTgt, "", function() {
          $('img', $('#divShowUrlContent')).each(function(){ 
            //if ($(this).is('img')) {
              src = $(this).attr('src');
              $(this).attr("src", data["srcUrl"] + src);
            //}
          });
        });
    } else {
      // Display the error
      var node = document.getElementById("divShowUrlContent");
      while (node.firstChild)
          node.removeChild(node.firstChild);
      var span = document.createElement('span');
      span.innerHTML = data["err"];
      node.appendChild(span);
      
    }
  } catch (err) {
    console.log("ShowUrl " + err.stack);
  }
}

function AddUrl() {
  try {
    var url = $("#inpAddUrl").val();
    // Ajax request to add the url
      var form = document.createElement('form');
      form.setAttribute('method', 'post');
      var inp = document.createElement("input");
      inp.setAttribute('type', "text");
      inp.setAttribute('name', 'url');
      inp.setAttribute('value', url);
      form.appendChild(inp);
      url = "./loader.php?add=1";
      theWB.HTTPPostRequest(url, form, RefreshSelUrl);
  } catch (err) {
    console.log("AddUrl " + err.stack);
  }
}

function RefreshSelUrl(data) {
  try {
    if (data["err"] !== undefined && data["err"] == "ok") {
      // Add the url to the sel box
      var node = document.getElementById('selUrl');
      var opt = document.createElement('option');
      opt.value = data["ref"];
      opt.appendChild(document.createTextNode(data["url"]));
      node.appendChild(opt);
      $("#inpAddUrl").val("");
      $("#imgAddUrl").addClass("animated flash");
      setTimeout(function(){ 
        $("#imgAddUrl").removeClass("animated flash");}, 1000);
    } else {
      console.log(data["err"]);
    }
  } catch (err) {
    console.log("RefreshSelUrl " + err.stack);
  }
}

function DelUrl() {
  try {
    var urlRef = $("#selUrl option:selected").val();
    // Ajax request to add the url
      var form = document.createElement('form');
      form.setAttribute('method', 'post');
      var inp = document.createElement("input");
      inp.setAttribute('type', "text");
      inp.setAttribute('name', 'urlRef');
      inp.setAttribute('value', urlRef);
      form.appendChild(inp);
      url = "./loader.php?del=1";
      theWB.HTTPPostRequest(url, form, RefreshDelUrl);
  } catch (err) {
    console.log("AddUrl " + err.stack);
  }
}

function RefreshDelUrl(data) {
  try {
    if (data["err"] !== undefined && data["err"] == "ok") {
      // Remove the url from the sel box
      $('option:selected', $("#selUrl")).remove();
      $("#imgDelUrl").addClass("animated flash");
      setTimeout(function(){ 
        $("#imgDelUrl").removeClass("animated flash");}, 1000);
    } else {
      console.log(data["err"]);
    }
  } catch (err) {
    console.log("RefreshDelUrl " + err.stack);
  }
}

