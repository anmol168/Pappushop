<?php
$page = substr( $_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1);

?>

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-black opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#" target="_blank">
        
        <span class="ms-1 font-weight-bold text-black">Pappu mobile shop</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto max-height-vh-100 " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        
        
        <li class="nav-item">
          <a class="nav-link   text-black <?= $page == "category.php"? 'active bg-gradient-primary':''; ?>" href="category.php">
            <div class="text-black  text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">All  Category</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-black <?= $page == "add-category.php"? 'active bg-gradient-primary':''; ?>"  href="add-category.php">
            <div class="text-black  text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Add  Category</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-black <?= $page == "products.php"? 'active bg-gradient-primary':''; ?>"  href="products.php">
            <div class="text-black  text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">All  Products</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-black <?= $page == "add-product.php"? 'active bg-gradient-primary':''; ?>" href="add-product.php">
            <div class="text-black  text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Add  Products</span>
          </a>
        </li> <li class="nav-item">
          <a class="nav-link  text-black <?= $page == "orders.php"? 'active bg-gradient-primary':''; ?>" href="orders.php">
            <div class="text-black  text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Orders</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-black <?= $page == "feedback.php"? 'active bg-gradient-primary':''; ?>" href="feedback.php">
            <div class="text-black  text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">All  Feedbacks </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-black <?= $page == "returnadmin.php"? 'active bg-gradient-primary':''; ?>" href="returnadmin.php">
            <div class="text-black  text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Return Products</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-black <?= $page == "repairadmin.php"? 'active bg-gradient-primary':''; ?>" href="repairadmin.php">
            <div class="text-black  text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Repair Products</span>
          </a>
        </li>
      </ul>
    </div>
    
    <div class="slidenav-footer position-absolute w-100 bottom-0">
        <div class="md-3">
        <a class="btn btn-primary btn-sm mb-0 w-100" 
        href="../logout.php" >Logout</a>

        </div>
      </div>
    </div>
  </aside>