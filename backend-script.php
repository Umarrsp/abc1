<?php

include('database.php'); 

$searchTerm = $_GET['term'];
$sql = "SELECT * FROM machine1 WHERE user_id LIKE '%".$searchTerm."%'"; 
$result = $conn->query($sql); 
if ($result->num_rows > 0) {
  $tutorialData = array(); 
  while($row = $result->fetch_assoc()) {

   $data['id']    = $row['id']; 
   $data['value'] = $row['user_id'];
   array_push($tutorialData, $data);
} 
}
 echo json_encode($tutorialData);
?>