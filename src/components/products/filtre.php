



<!-- 
<form method="POST" action= "category.php" >  
		<?php
			// Establish database connection using PDO
      include '../../../server/config.php' ;

			// Query database for data to display in checkbox
			$query = "SELECT id, name FROM categories WHERE gender='men'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

			// Display data in checkbox
      ?>
      <h3>men</h3>
      <?php 
			foreach ($result as $row) {
				echo '<div style="display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;">
        <button  class="flitre" type="submit" style="background-color:transparent;border:none;" >
        <label>
        <input type="checkbox" name="checkbox[]" value="' . $row['id'] . '">' . $row['name'] . '</label></button></div>';
			}
		?>

<?php

    $query = "SELECT id, name FROM categories WHERE gender='women'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <h3>women</h3>
      <?php 
			foreach ($result as $row) {

				echo '<div style="display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;"> <button type="submit" style="background-color:transparent;border:none;" >
        <label ><input  type="checkbox" name="checkbox[]" value="' . $row['id'] . '">' . $row['name'] . '</label></button></div>';
			}
		?>
    
<?php
	// $query = "SELECT id, name FROM  subcategories   ";
 $query =  "SELECT subcategories.id , subcategories.name 
FROM subcategories 
, categories
WHERE subcategories.category_id = categories.id   and  gender='men' ";
  $stmt = $conn->prepare($query);
  $stmt->execute(); 
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

  // Display data in checkbox
  ?>
  <h3>men subcategory</h3>
  <?php 
  foreach ($result as $row) {
    echo '<div style="display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;">
    <button type="submit" style="background-color:transparent;border:none;" ><label><input type="checkbox" name="checkbox[]" value="' . $row['id'] . '">' . $row['name'] . '</label></button></div>';
  }
?>
   
   <?php
	// $query = "SELECT id, name FROM  subcategories   ";
 $query =  "SELECT subcategories.id , subcategories.name 
FROM subcategories
, categories
WHERE subcategories.category_id = categories.id   and  gender='women' ";
  $stmt = $conn->prepare($query);
  $stmt->execute(); 
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

  // Display data in checkbox
  ?>
  <h3>women subcategory</h3>
  <?php 
  foreach ($result as $row) {
    echo '<div style="display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;">
    <button type="submit" style="background-color:transparent;border:none;display:block;" ><label><input type="checkbox" name="checkbox[]" value="' . $row['id'] . '">' . $row['name'] . '</label></button></div>';
  }
?>










	</form>
































 
	<script>// get all the checkbox inputs
const checkboxes = document.querySelectorAll('input[type="checkbox"]');

// add event listener to each checkbox
checkboxes.forEach(checkbox => {
  checkbox.addEventListener('click', () => {
    // uncheck all other checkboxes
    checkboxes.forEach(cb => {
      if (cb !== checkbox) {
        cb.checked = false;
      }
    });
  });
}); 


</script>


 -->
