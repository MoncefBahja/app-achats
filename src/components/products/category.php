<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Anon - eCommerce Website</title>

  <!--
    - favicon
  -->
  <link rel="shortcut icon" href="../assets/images/logo/favicon.ico" type="image/x-icon">

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="css/style.css">

  <!--
    - google font link
  -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
</head>
<body>
<?php 
include '../include/header.php' ;


?>















<main>


    <div class="product-container">

      <div class="container">


        <!--
          - SIDEBAR
        -->

        <div class="sidebar">
        <div class="sidebar-category">





<!-- // include filtre -->
<?php include 'sidbar.php' ;?>
<?php

		
if (isset($_GET['subcategory_id'])) {
       $subcategory_id = $_GET['subcategory_id'] ;
       $stmt = $conn->prepare("SELECT * FROM products  WHERE subcategory_id = ? ");
  $stmt->bindParam(1, $subcategory_id);
  $stmt->execute();
  if($stmt->rowCount() > 0) {

  



	
  

                      
          


?>









</div>

        
       </div>



        <div class="product-box">
  
          <div class="product-main">
            <div class="select">
              <select id="cars" name="cars">
                <option value="price low to high">price low to high</option>
                <option value="price high to low">price high to low </option>
                <option value="ort AtoZ">sort A to Z</option>
                <option value="sort ZtoA"> sort Z to A</option>
              </select>
            </div>

			<div class="product-grid">
                  
        <?php  
         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    
         
                        

        ?>
			
     
          <div class="showcase">

                <div class="showcase-banner">

                  <img src="../../../assets/images/products/<?php echo $row['image_url']; ?>" alt="Mens Winter Leathers Jackets" width="300" class="product-img default">
                  <img src="../../../assets/images/products/<?php echo $row['image_url'] ;?>" alt="Mens Winter Leathers Jackets" width="300" class="product-img hover">

                  <p class="showcase-badge">15%</p>

                

                </div>

                <div class="showcase-content">

    <a href="http://localhost/ecommerce-pfe/src/components/productDetails/Details.php?id=<?php echo $row['id']?>" class="showcase-category" style="min-width:600px">  <?php  echo $row['name']?></a>

                  <a href="#">
                    <h3 class="showcase-title"><?php echo $row['description'] ;?></h3>
                  </a>

                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                  </div>

                  <div class="price-box">
                    <p class="price"> <?php echo $row['price'] ; ?></p>
                    <del>$75.00</del>
                  </div>
               
                </div>
               

              </div>
             
              <?php 
                }
              ?>
              
            </div>

            

          </div>
          






        </div>
        
      </div>

    </div>


    <?php
   
  }
}
 else {
       $pdo = null;
      

          	}


	?>


            
    

           </main>




<?php
include '../include/footer.php' ;
?>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!--
    - custom js link
  -->

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>











































































           




			
















