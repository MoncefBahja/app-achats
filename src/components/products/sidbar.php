
<h3 style="color:pink"> men <h3>

<?php 

$sql1 = "SELECT * FROM categories WHERE gender = 'men' " ;
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$data1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);




    foreach($data1 as $rus1) {
        $id = $rus1['id'];
$sql2 =  "SELECT * FROM subcategories WHERE category_id = $id  " ;
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$data2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);





     ?>
 
<ul class="sidebar-menu-category-list">

  <li class="sidebar-menu-category">
  <button class="sidebar-accordion-menu" data-accordion-btn>
  <div class="menu-title-flex">
  <p class="menu-title"><?php echo $rus1['name'] ;?>
 </p>  
  </div>
  <div>
<ion-icon name="add-outline" class="add-icon"></ion-icon>
  <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
  </div>
  </button>


  <ul class="sidebar-submenu-category-list" data-accordion>
  <?php  foreach($data2 as $rus2) { ?>
      <li class="sidebar-submenu-category">
      <a href="category.php?subcategory_id=<?php echo $rus2['id'] ?>" class="sidebar-submenu-title"> 
    <p class="product-name"><?php echo $rus2['name'] ;?> </p> 
      </a>
      </li>
  
<?php } ?>
  </ul>

   </li>


</ul>
<?php
  }


?>
  

  <h3 style="color:pink"> women <h3>
  <?php 

$sql3 = "SELECT * FROM categories WHERE gender = 'women' " ;
$stmt3= $conn->prepare($sql3);
$stmt3->execute();
$data3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);




    foreach($data3 as $rus3) {
        $id2 = $rus3['id'];
$sql4=  "SELECT * FROM subcategories WHERE category_id = $id2 " ;
$stmt4 = $conn->prepare($sql4);
$stmt4->execute();
$data4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);





     ?>
 
<ul class="sidebar-menu-category-list">

  <li class="sidebar-menu-category">
  <button class="sidebar-accordion-menu" data-accordion-btn>
  <div class="menu-title-flex">
  <p class="menu-title"><?php echo $rus3['name'] ;?>
 </p>  
  </div>
  <div>
<ion-icon name="add-outline" class="add-icon"></ion-icon>
  <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
  </div>
  </button>


  <ul class="sidebar-submenu-category-list" data-accordion>
  <?php  foreach($data4 as $rus4) { ?>

      <li class="sidebar-submenu-category">
      <a href="category.php?subcategory_id=<?php echo $rus4['id'] ?>"class="sidebar-submenu-title">
    <p class="product-name"><?php echo $rus4['name'] ;?> </p>
      </a>
      </li>
  
<?php } ?>
  </ul>

   </li>


</ul>
<?php
  }


?>
  




  <script>


     

const accordionBtn = document.querySelectorAll('[data-accordion-btn]');
const accordion = document.querySelectorAll('[data-accordion]');

for (let i = 0; i < accordionBtn.length; i++) {

  accordionBtn[i].addEventListener('click', function () {

    const clickedBtn = this.nextElementSibling.classList.contains('active');

    for (let i = 0; i < accordion.length; i++) {

      if (clickedBtn) break;

      if (accordion[i].classList.contains('active')) {

        accordion[i].classList.remove('active');
        accordionBtn[i].classList.remove('active');

      }

    }

    this.nextElementSibling.classList.toggle('active');
    this.classList.toggle('active');

  });

}








</script> 
