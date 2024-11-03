<?php
require ('../../../server/config.php') ;

$sql = "SELECT * FROM categories WHERE gender = women" ;
$stmt = $conn-> prepare($sql) ;
$stmt->execute() ;
$data = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
$output = [] ;

foreach ( $data as $row ) {

    $categorie = [];
    $categorie['id'] = $row['id'] ;
    $categorie['name']=$row['name'] ;
    $categorie['gender']=$row['gender'] ;

  $output[] = $categorie ;
}
  header('Content-Type: application/json');
  echo json_encode($output);
  exit;
  
  
  $conn = null;
  



?>