
      <header>

    <div class="header-main">

      <div class="container">

      <button  id="click" onclick="toggleBackground()"></button>


        <!-- <a href="./index.html" class="header-logo">
          <img src="../../../assets/images/logo/logo.svg" alt="Anon's logo" width="120" height="36">
        </a> -->
        <a href="../../../index.html" class="header-logo">
          <h2 style="color:black;">BestStyle</h2>
        </a> 

        <div class="header-search-container">
        <form method="post" action="search.php">

      <input type="search" name="search" class="search-field" placeholder="Enter your product name...">
      <button  class="search-btn" name="btn-search" onclick="document.location='../products/search.php'">
        <ion-icon name="search-outline"></ion-icon>
</button>
</form>

        </div>

        <div class="header-user-actions">

          <button id="login" class="action-btn" onclick="document.location='../auth/login.html'">
            <ion-icon name="person-outline"></ion-icon>
          </button>

          <button class="action-btn">
            <ion-icon name="heart-outline"></ion-icon>
            <span class="count">0</span>
          </button>

          <button class="action-btn" onclick="document.location='../cart/index.html'">
            <ion-icon name="bag-handle-outline"></ion-icon>
            <span class="count">0</span>
          </button>

          <span id="logout"></span>

        </div>

      </div>

    </div>

    <nav class="desktop-navigation-menu">

      <div class="container">

        <ul class="desktop-menu-category-list">

          <li class="menu-category">
            <a href="http://localhost/ecommerce-pfe/index.html" class="menu-title">Home</a>
          </li>

          <?php
            include '../../../server/config.php'  ;

          $stmt = $conn->prepare("SELECT * FROM categories WHERE gender = 'men'");
          $stmt->execute();
          $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

          $stmt10 = $conn->prepare("SELECT * FROM categories WHERE gender = 'men'");
          $stmt10->execute();
          $data10 = $stmt10->fetchAll(PDO::FETCH_ASSOC);

          ?>

          <li class="menu-category">
            <a href="#" class="menu-title">Categories</a>

            <!-- BEGINING -->

            

            <div class="dropdown-panel">

              <div id="dropdown">

              <ul class="dropdown-panel-list">
     <li class="menu-title">
      <a href="#">Men</a>
      </li>
      <?php  foreach($data as $row) { ?>

        <li class="panel-list-item">
       <a href="../products/categories.php? id= <?php echo $row['id']?>"><?php echo $row['name']?></a>
       </li>
<?php } ?>
      <li class="panel-list-item"></li>
      </ul>
      
      <ul class="dropdown-panel-list">
    <li class="menu-title">
    <a href="#">Women</a>
    </li>
    <?php  foreach($data10 as $row10) { ?>

      <li class="panel-list-item">
      <a href="../products/categories.php? id=<?php echo $row10['id']?>"><?php echo $row10['name']?></a>
      </li>
      <?php } ?>

     
    <li class="panel-list-item"></li>
      </ul>





              </div>

            </div>

            <!-- END -->
          </li>

          <li class="menu-category">

            <a href="../products/men.php" class="menu-title">Men's</a>

            <div id="dropdown_sub_men"></div>

            <!-- <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="#">Shirt</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Shorts & Jeans</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Safety Shoes</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Wallet</a>
              </li>

            </ul> -->
          </li>

          <li class="menu-category">

            <a href="../products/women.php" class="menu-title">Women's</a>

            <div id="dropdown_sub_women"></div>

            <!-- <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="#">Dress & Frock</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Earrings</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Necklace</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Makeup Kit</a>
              </li>

            </ul> -->
          </li>





          <li class="menu-category">

            <a href="../products/test.php" class="menu-title">Products</a>

            <div id="dropdown_sub_women"></div>

            <!-- <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="#">Dress & Frock</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Earrings</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Necklace</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Makeup Kit</a>
              </li>

            </ul> -->
          </li>







          <li class="menu-category">
            <a href="../contact/contact.html" class="menu-title">contact </a>
          </li>

        </ul>

      </div>

    </nav>

    <div class="mobile-bottom-navigation">

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="menu-outline"></ion-icon>
      </button>

      <button class="action-btn" onclick="document.location='../cart/index.html'">
        <ion-icon name="bag-handle-outline"></ion-icon>
        <span class="count">0</span>
      </button>

      <button class="action-btn" onclick="document.location='./index.html'">
        <ion-icon name="home-outline"></ion-icon>
      </button>

      <button class="action-btn">
        <ion-icon name="heart-outline"></ion-icon>
        <span class="count">0</span>
      </button>

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="grid-outline"></ion-icon>
      </button>

    </div>

    <nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>

      <div class="menu-top">
        <h2 class="menu-title">Menu</h2>

        <button class="menu-close-btn" data-mobile-menu-close-btn>
          <ion-icon name="close-outline"></ion-icon>
        </button>
      </div>

      <ul class="mobile-menu-category-list">

        <li class="menu-category">
          <a href="#" class="menu-title">Home</a>
        </li>

        <li class="menu-category">
          <a href="../auth/login.html" class="menu-title"> Login </a>
        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Men's</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Shirt</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Shorts & Jeans</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Safety Shoes</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Wallet</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Women's</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Dress & Frock</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Earrings</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Necklace</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Makeup Kit</a>
            </li>

          </ul>

        </li>

      </ul>

      <div class="menu-bottom">

        <ul class="menu-category-list">

          <li class="menu-category">

            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">Language</p>

              <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
            </button>

            <ul class="submenu-category-list" data-accordion>

              <li class="submenu-category">
                <a href="#" class="submenu-title">English</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">Arabic</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">French</a>
              </li>

            </ul>

          </li>

          <li class="menu-category">
            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">Currency</p>
              <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
            </button>

            <ul class="submenu-category-list" data-accordion>
              <li class="submenu-category">
                <a href="#" class="submenu-title">USD &dollar;</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">EUR &euro;</a>
              </li>
            </ul>
          </li>

        </ul>

      </div>

    </nav>

  </header>
<script>
  function toggleBackground() {
  var body = document.getElementsByTagName("body")[0];
  body.classList.toggle("dark");
  document.getElementById("click").style.backgroundColor = "white";

}
</script>







































  <script src="../../js/index.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  