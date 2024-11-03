

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BestStyle - eCommerce Website</title>

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



    <style>
  h3 {
    margin-top:20px;
    margin-bottom:20px;
    font-size:20px;
  }


</style>






</head>



<?php 

include '../include/header.php' ;
?>


   





<?php 

// conntexion




//  code for pagination
$resultsPerPage =   8;

$numberOfResults = $conn->prepare("select * from products ") ;
$numberOfResults->execute() ;
$numberOfResults = $numberOfResults-> rowCount() ;
if(!isset($_GET['page'])) {
    $page = 1 ;

} else if(isset($_GET['page'])) {
    $page =  $_GET['page'] ;
    
} 
 $totalPages = ceil( $numberOfResults / $resultsPerPage) ;


$results = $conn->prepare("select * from products LIMIT " .$resultsPerPage. " OFFSET " .( $page-1)*$resultsPerPage) ;
$results -> execute() ;


?>



























<main>


    <div class="product-container">

      <div class="container">


        <!--
          - SIDEBAR
        -->

        <div class="sidebar">
        <div  id="Categorie" class="sidebar-category">



<?php include 'sidbar.php'   ?>


<!-- // include filtre -->









</div>

        
       </div>



        <div class="product-box">
  
          <div class="product-main">
            <div class="select">
              <select id="cars" name="cars">
                <option value="price low to high">price low to high</option>
                <option value="price high to low">price high to low </option>
                <option value="ort AtoZ">sort AtoZ</option>
                <option value="sort ZtoA"> sort ZtoA</option>
              </select>
            </div>
            
            
            <div class="product-grid">
                <?php  
                foreach ($results AS $result){
                    
                    
                
                
                ?>

           
          <div class="showcase">

                <div class="showcase-banner">
                  <img src="../../../assets/images/products/<?php echo $result['image_url'] ?>" alt="Mens Winter Leathers Jackets" width="300" class="product-img default">
                  <img src="../../../assets/images/products/<?php echo $result['image_url'] ?>" alt="Mens Winter Leathers Jackets" width="300" class="product-img hover">
              
                  <p class="showcase-badge">15%</p>

                

                </div>

                <div class="showcase-content">

                  <a href="http://localhost/ecommerce-pfe/src/components/productDetails/Details.php?id=<?php echo $result['id'] ?>" class="showcase-category" style="min-width:600px">  <?php  echo $result['name']?></a>

                  <a href="#">
                    <h3 class="showcase-title"><?php echo $result['description'] ?></h3>
                  </a>

                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                  </div>

                  <div class="price-box">
                    <p class="price"> <?php echo $result['price'] ?></p>
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

    <div style="display: flex;  flex-direction: row;   flex-wrap: nowrap;
 justify-content: center;
  align-items: center; margin-bottom:20px ; ">
    <?php 
          for($count = 1 ; $count<= $totalPages ; ++$count ) {
if($page == $count ) {

    ?>


    <a  style="color:white;display: flex;
  justify-content: center;
  align-items: center; padding: 10px;  border: 1px solid black;margin:5px ;  border-radius: 4px;

  background-color:black;
  " href="test.php?page=<?php echo $count ?>"><?php echo $count ?> </a>
    <?php
}
else { ?>
   
 <a   style="color:balck;display: flex;
  justify-content: center;
  align-items: center; padding: 10px; border: 1px solid black;
  background-color: white ;margin:5px ;  border-radius: 4px;

  " href="test.php?page=<?php echo $count ?>"><?php echo $count ?> </a>
  <?php
}

}?>
</div>



















<!-- <button  id="click" onclick="toggleBackground()"></button> -->

	




  </main>
















 

  <?php 

include '../include/footer.php' ;
?>



<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

  <!--
    - custom js link
  -->
  <script src="script/script.js"></script> 

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>








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









</body>

</html>