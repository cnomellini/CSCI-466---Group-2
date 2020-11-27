<?php
  // You must implement a page showing workouts over a given time period, including estimated calories
  // burned, and any other relevant information, for each workout. Statistics such as total calories and
  // average calories per workout should be displayed on this page as well.

  // Have the user enter two days that will define a time period.
  // Then we simply show the relevant informationfor each date.
  echo "<br />Showing a user's workout usage!<br />";

  echo "<form method=POST>";
    echo "Please enter the first day of the time period in the format YYYY-MM-DD!";
    echo "<input type=text name=WUFirstDate>";
    echo "Please enter the last day of the time period in the format YYYY-MM-DD!";
    echo "<input type=text name=WULastDate>";
    echo "<input type=submit value='Submit to see calories burned!'>";
  echo "</form>";

  if(!empty($_POST["WUFirstDate"]) && !empty($_POST["WULastDate"])){
    $WUFirstDate = $_POST["WUFirstDate"];
    $WULastDate = $_POST["WULastDate"];
    $sql = "SELECT NAME,DURATION,DATE FROM WORKOUT WHERE DATE >= :WUFD AND DATE <= :WULD;";
    $prepared = $pdo->prepare($sql);
    $success = $prepared->execute(array(":WUFD" => "$WUFirstDate", ":WULD" => "$WULastDate"));
		if(!$success){
			echo "Error in query";
			die();
		}
    $rowsWoW = $prepared->fetchAll(PDO::FETCH_ASSOC);
    $resultWI = $pdo->query("SELECT NAME, CALORIES_BURNED_PER_MINUTE FROM WORKOUTINFO;");
    $rowsWI = $resultWI->fetchAll(PDO::FETCH_ASSOC);
    // We now have all the workouts done by the user in the week, as well as all the workout info.
    // In order to calculate calories burned, we simply do CALORIES_BURNED_PER_MINUTE * DURATION.
    // For each workout done by the user.
    foreach($rowsWoW as $rowWOW){
      // For each workout in the DB.
      foreach($rowsWI as $rowWI){
        // We have the same workout.
        if($rowWOW["NAME"] == $rowWI["NAME"]){
          
        }  
      }
    }
    
    echo "<table border=1>";
    echo "<tr><th>Workout Name</th><th>Type</th><th>Intensity</th><th>Calories Burned</th></tr>";
    foreach($rowsWI as $rowWI){
      echo "<tr><td></td></tr>";
    }
    echo "</table>";
  }
?>
