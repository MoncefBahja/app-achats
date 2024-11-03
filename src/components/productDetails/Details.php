<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product Card/Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./assets/images/logo/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  </head>
  <style>
    .img-display{
    overflow: hidden;
max-width: 100%;
max-height: 100%;



}
.img-showcase{
    display: flex;
max-width: 100%;
max-height: 500px;
  transition: all 0.5s ease;
}
.card-wrapper{
    max-width: 1900px;
    margin-left: 100px;
    margin-right: 100px;
    margin-top: 100px;
    margin-bottom: 100px;

    border: 1px solid var(--cultured);
    -webkit-box-shadow: 0 3px 5px hsla(0, 0%, 0%, 0.1);
            box-shadow: 0 3px 5px hsla(0, 0%, 0%, 0.1);
    -webkit-border-radius: var(--border-radius-md);
            border-radius: var(--border-radius-md);
    -webkit-transform: translateY(50px);
        -ms-transform: translateY(50px);
            transform: translateY(50px);
    -webkit-transition: var(--transition-timing);
    -o-transition: var(--transition-timing);
    transition: var(--transition-timing);

}
  </style>
  <body>




   
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
    <script src="../../js/index.js"></script>
  
    <!--
      - ionicon link
    -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
    





<?php 
 include '../../components/include/header.php' ;
if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  // Prepare a SQL statement to retrieve product details
  $stmt = $conn->prepare("SELECT * FROM products  WHERE id = ? ");
  $stmt->bindParam(1, $product_id);
  $stmt->execute();
  $product = $stmt->fetch(PDO::FETCH_ASSOC);
  $category_id=$product['category_id'] ;
  $sub_category=$product['subcategory_id'] ;
   // Prepare a SQL statement to retrieve img 

   $stmt1 = $conn->prepare("SELECT * FROM img  WHERE id_products= ? ");
   $stmt1->bindParam(1, $product_id);
   $stmt1->execute();
   $img = $stmt1->fetch(PDO::FETCH_ASSOC);

   // preapre color
   $stmt2 = $conn->prepare("SELECT * FROM product_colors WHERE product_id = ? ") ;
   $stmt2->bindParam(1,$product_id) ;
   $stmt2->execute() ;
   $color = $stmt2->fetch(PDO::FETCH_ASSOC) ;
   
   // prepare size 
   $stmt3 = $conn->prepare("SELECT * FROM product_sizes WHERE product_id = ? ") ;
   $stmt3->bindParam(1,$product_id) ;
   $stmt3->execute() ;
   $size = $stmt3->fetch(PDO::FETCH_ASSOC) ;

   // categories 
   $stmt4 = $conn->prepare("SELECT * FROM categories WHERE id = ? ") ;
   $stmt4->bindParam(1,$category_id) ;
   $stmt4->execute() ;
   $categories = $stmt4->fetch(PDO::FETCH_ASSOC) ;
   $Cat_id=$categories['id'] ;

   // subcategorie
   $stmt5 = $conn->prepare("SELECT * FROM subcategories WHERE id = ? ") ;
   $stmt5->bindParam(1,$sub_category) ;
   $stmt5->execute() ;
   $sub_categ= $stmt5->fetch(PDO::FETCH_ASSOC) ;



  	// $query = "SELECT id, name FROM  subcategories   ";
 

  if ($product  ) {
  

?>

















    
    <div class = "card-wrapper">
      <div class = "card">
        <!-- card left -->
        <div class = "product-imgs">
          <div class = "img-display">
            <div class = "img-showcase">
             <img src = "../../../assets/images/products/<?php echo $product['image_url']?>" alt = "shoe image">
              <img src = "../../../assets/images/products/<?php echo $img['img1']?>" alt = "shoe image">
              <img src = "../../../assets/images/products/<?php echo $img['img2']?>" alt = "shoe image">
              <img src = "../../../assets/images/products/<?php echo $img['img3']?>" alt = "shoe image">
            </div>
          </div>
          <div class = "img-select">
            <div class = "img-item">
              <a href = "#" data-id = "1">
                <img src = "../../../assets/images/products/<?php echo $product['image_url']?>" alt = "shoe image">
              </a>
            </div>
            <div class = "img-item">
              <a href = "#" data-id = "2">
                <img src = "../../../assets/images/products/<?php echo $img['img1']?>" alt = "shoe image">
              </a>
            </div>
            <div class = "img-item">
              <a href = "#" data-id = "3">
                <img src = "../../../assets/images/products/<?php echo $img['img2']?>" alt = "shoe image">
              </a>
            </div>
            <div class = "img-item">
              <a href = "#" data-id = "4">
                <img src = "../../../assets/images/products/<?php echo $img['img3']?>" alt = "shoe image">
              </a>
            </div>
          </div>
        </div>
        <!-- card right -->
        <div class = "product-content">
          <h2 class = "product-title"><?php echo $product['name']?></h2>
          <div class = "product-rating">
            <i class = "fas fa-star"></i>
            <i class = "fas fa-star"></i>
            <i class = "fas fa-star"></i>
            <i class = "fas fa-star"></i>
            <i class = "fas fa-star-half-alt"></i>
            <span>4.7(21)</span>
          </div>

          <div class = "product-price">
            <p class = "last-price">Old Price: <span><?php echo $product['price']?> DH</span></p>
            <p class = "new-price">New Price: <span><?php echo $product['price'] - (($product['price'] * 15) / 100)?> DH</span></p>
          </div>

          <div class = "product-detail">
            <h2 style="color:pink">about this item: </h2>
<p><?php echo $product['description']?></p>            
            <ul>
              <!-- <li>Color: <span><?php echo $color['color'] ?></span></li> -->
              <li>stock: <span><?php echo $product['stock']?></span></li>
              <li>Category: <span><?php echo $categories['name']  ?></span></li>
              <li>sub_Category: <span><?php echo $sub_categ['name']  ?></span></li>
              <!-- <li>size: <span> 
            </span></li> -->
              

            </ul>
          </div>
          <form method="post" action="">
          <div class = "purchase-info">
            <input type = "number" style="width:100px" min = "0" max="<?php echo $product['stock']?>" value = "<?php echo $product['stock']?>">
            <button type = "button" class = "btn">
              Add to Cart <i class = "fas fa-shopping-cart"></i>
            </button>
          </div>
          </form>
          <div class = "social-links">
            <p>Share At: </p>
            <a href = "#">
              <i class = "fab fa-facebook-f"></i>
            </a>
            <a href = "#">
              <i class = "fab fa-twitter"></i>
            </a>
            <a href = "#">
              <i class = "fab fa-instagram"></i>
            </a>
            <a href = "#">
              <i class = "fab fa-whatsapp"></i>
            </a>
            
          </div>
        </div>
      </div>
    </div>

<?php
  } 

?>
    <!-- hhhhhh -->

    <main>


      <div class="product-container">
  
        <div class="container">
  
  
         
  
  
  
  <?php 

  $sql="SELECT * FROM products WHERE subcategory_id = ? " ;
  $stmt6=$conn->prepare($sql) ;
  $stmt6->bindParam(1,$Cat_id) ;
  $stmt6->execute() ;
  $rus=$stmt6->fetchAll(PDO::FETCH_ASSOC);
  
  
 
  ?>
  
              
              <div class="product-grid">
                
             <?php  foreach($rus as $row) {
  
  
  ?>
      <div class="showcase">

<div class="showcase-banner">

  <img src="../../../assets/images/products/<?php echo $row['image_url']; ?>" alt="Mens Winter Leathers Jackets" width="300" class="product-img default">
  <img src="../../../assets/images/products/<?php echo $row['image_url'] ?>" alt="Mens Winter Leathers Jackets" width="300" class="product-img hover">

  <p class="showcase-badge">15%</p>



</div>

<div class="showcase-content">

  <a href="http://localhost/ecommerce-pfe/src/components/productDetails/Details.php?id=<?php echo $row['id']?>" class="showcase-category" style="min-width:600px">  <?php  echo $row['name']?></a>

  <a href="#">
    <h3 class="showcase-title"><?php echo $row['description'] ?></h3>
  </a>

  <div class="showcase-rating">
    <ion-icon name="star"></ion-icon>
    <ion-icon name="star"></ion-icon>
    <ion-icon name="star"></ion-icon>
    <ion-icon name="star-outline"></ion-icon>
    <ion-icon name="star-outline"></ion-icon>
  </div>

  <div class="price-box">
    <p class="price"> <?php echo $row['price'] ?></p>
    <del>$75.00</del>
  </div>

</div>

</div>


<?php 
}}
?>


</div>

</div>

  
  
  
  
  
  
  
          </div>
  
        </div> 
      
  
      </div>
  
     
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
    
  
  
  
  
    </main>















<?php include '../include/footer.php' ;?>

    
<script>
const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage(){
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);







// AJAX

















    </script>
  </body>
</html>