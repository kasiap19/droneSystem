<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Mandatory Assignment_01</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- my css -->
    <link rel="stylesheet" type="text/css" href="main.css">

</head>
<body>
  <!-- google fonts-->
<link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
<!-- random accidents PHP -->
<?php
define("NO_OF_WH", 6);
$accidents = array();
for ($i = 0; $i < NO_OF_WH; $i++) {
    $w = rand(0,1200);
    $h = rand(0, 500);
    $accidents[$i] = '<i id="accident'.$i.'" style="top:'.$h.'px; left:'.$w.'px;" class=" fa fa-exclamation-triangle fa-pulse fa-3x fa-fw "></i></div>';
}
?>
<?php for ($i = 0; $i < count($accidents); $i++) { ?>
    <p><?php echo $accidents[$i]; ?></p>
<?php } ?>
<div class="container-fluid">
  <div class="row">
    <footer>
      <!-- new drone -->
        <div class="col-lg-3">
          <h4 class="titles"><span>1. NEW DRONE:</span></h4>
          <input type="text" placeholder="name of your drone..." class="input-box" id="inputTxt"><br>
          <button class="createBtn"><p class="textCreate"><strong>CREATE</strong></p></button> 
        </div>
      <!-- select drone -->
        <div class="col-lg-3">
          <h4><span>2. SELECT DRONE:</span></h4>
          <form>
            <select id="mySelect" size="5" class="flexcroll">
              <option></option>
            </select>
          </form>
        </div>
      <!-- destroy selected drone -->
        <div class="col-lg-3">
          <h4><span>3. DESTROY DRONE:</span></h4>
          <button class="removeBtn"><p class="textRemove"><strong>DESTROY</strong></p></button>
      <!-- drone counter ... drones in total in the system -->
          <p class="totalDronesTxt">drones in the system : <a id="clicks">0</a></p>
        </div>
      <!-- statistics ... used drones -->
      <div class="col-lg-3">
        <h4><span>4. STATISTICS:</span></h4>
        <div id="usedDrones"  class="usedDronesTxt"><p>used drones:</p> </div>
      </div>
    </footer>
  </div> <!-- end of the row-->
</div> <!-- end of the container -->

</script>
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
    <!-- jquery animations-->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script>

    var drones = []; //drones in the selector
    var clicks =0; // drone counter
    $(document).on("click", ".createBtn", function(){
      var optionText = $("#inputTxt").val();
    // console.log(optionText);
    // JSON object for drone .. add drone to the selector - append
      var drone =
      {
        "id":drones.length,
        "accidentCount":0,
        "name":optionText
      }
      drones.push(drone);
      $("#mySelect").append('<option id="'+optionText+'" class="droneOption"> '+ optionText +' </option>');
      document.getElementById("clicks").innerHTML = clicks;
    // name validation and drone counter
      var inputValidation = $("#inputTxt").val();
      // console.log(inputValidation);
      if(inputValidation == null || inputValidation == ""){
        alert("Please enter a name of your drone");
      }
      else{
      var image = '<div class="droneAtribute" id="drone-'+optionText+'"><i class="fa fa-rocket fa-spin fa-5x  fa fa-spinner fa-spin" id="hideDrone" style="color:black;"></i></div>';
      $("body").append(image);
      clicks += 1;
      document.getElementById("clicks").innerHTML =  clicks;
      }
    });
    // removed drone from select and count down
         $(document).on("click", ".removeBtn", function(){
        var selectedValue = document.getElementById("mySelect");
        var droneSelected = selectedValue.selectedIndex;
        // console.log(droneSelected);
        selectedValue.remove(droneSelected);
        clicks --;
    // cannot reach number below 0
       if(clicks < 0){
        clicks = 0 ;
       }
        document.getElementById("clicks").innerHTML = clicks;
    // distroy selected drone
        document.getElementById("hideDrone").remove();           
      });

      var selectAccident;
      var selectDrone;
      // get accident id     
      $(document).on("click", ".fa", function(){
        selectAccident = $(this).attr('id');
      // console.log(selectAccident);            
      });
      // get dron id
      $(document).on("click", ".droneOption", function(){
        selectDrone = $(this).attr('id');
      });
      //get accident position
      var accidentCounter = 0;
      $(document).on("click", ".fa", function(){
        var positionTop = $('#'+selectAccident).css("top");
        var positionLeft = $('#'+selectAccident).css("left");
        // fly drone
        $('#drone-'+selectDrone).animate({
            top: positionTop,
            left: positionLeft
        },1000, function(){
            // console.log("X");
            $('#'+selectAccident).remove();
            // counter for the specific drone id 
            for (var i = 0; i < drones.length; i++) 
            {
              // console.log(selectDrone, drones[i].name);
              if (drones[i].name == selectDrone)
              {
                drones[i].accidentCount++;
                // console.log(drones[i].accidentCount + selectDrone);
                $("#usedDrones").append(selectDrone + " " + drones[i].accidentCount + "x"+ " ");
              }
            };
          });
      });        
</script>
</body>
</html> 