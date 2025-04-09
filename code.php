<?php
session_start();

include('../config/dbcon.php');
include('../functions/myfunctions.php');

function validate_input($data) {
  global $con;
  return mysqli_real_escape_string($con, trim($data));
}

if(isset($_POST['add_category_btn'])) {
  $name = validate_input($_POST['name']);
  $slug = validate_input($_POST['slug']);
  $description = validate_input($_POST['description']);
  $meta_title = validate_input($_POST['meta_title']);
  $meta_description = validate_input($_POST['meta_description']);
  $meta_keywords = validate_input($_POST['meta_keywords']);
  $status = isset($_POST['status']) ? '1' : '0';
  $popular = isset($_POST['popular']) ? '1' : '0';

  if(empty($name) || empty($slug) || empty($description) || empty($meta_title)) {
      redirect("add-category.php", "All fields are mandatory");
      exit();
  }

  if ($_FILES['image']['error'] == 0) {
      $image = $_FILES['image']['name'];
      $image_ext = pathinfo($image, PATHINFO_EXTENSION);
      $filename = time().'.'.$image_ext;
      $path = "../uploads";

      $query = "INSERT INTO categories (name, slug, description, meta_title, meta_description, meta_keywords, status, popular, image)
                VALUES ('$name', '$slug', '$description', '$meta_title', '$meta_description', '$meta_keywords', '$status', '$popular', '$filename')";

      if (mysqli_query($con, $query)) {
          move_uploaded_file($_FILES['image']['tmp_name'], "$path/$filename");
          redirect("add-category.php", "Category added successfully");
      } else {
          redirect("add-category.php", "Something went wrong");
      }
  } else {
      redirect("add-category.php", "Image is required");
  }
}

elseif(isset($_POST['update_category_btn'])) {
  $category_id = validate_input($_POST['category_id']);
  $name = validate_input($_POST['name']);
  $slug = validate_input($_POST['slug']);
  $description = validate_input($_POST['description']);
  $meta_title = validate_input($_POST['meta_title']);
  $meta_description = validate_input($_POST['meta_description']);
  $meta_keywords = validate_input($_POST['meta_keywords']);
  $status = isset($_POST['status']) ? '1' : '0';
  $popular = isset($_POST['popular']) ? '1' : '0';

  if(empty($name) || empty($slug) || empty($description) || empty($meta_title)) {
      redirect("edit-category.php?id=$category_id", "All fields are mandatory");
      exit();
  }

  $old_image = validate_input($_POST['old_image']);
  $update_filename = $old_image;

  if ($_FILES['image']['error'] == 0) {
      $image = $_FILES['image']['name'];
      $image_ext = pathinfo($image, PATHINFO_EXTENSION);
      $update_filename = time().'.'.$image_ext;
      $path = "../uploads";
  }

  $query = "UPDATE categories SET name='$name', slug='$slug', description='$description', meta_title='$meta_title',
            meta_description='$meta_description', meta_keywords='$meta_keywords', status='$status', 
            popular='$popular', image='$update_filename' WHERE id='$category_id'";

  if (mysqli_query($con, $query)) {
      if ($_FILES['image']['error'] == 0) {
          move_uploaded_file($_FILES['image']['tmp_name'], "$path/$update_filename");
          if(file_exists("../uploads/$old_image")) {
              unlink("../uploads/$old_image");
          }
      }
      redirect("edit-category.php?id=$category_id", "Category updated successfully");
  } else {
      redirect("edit-category.php?id=$category_id", "Something went wrong");
  }
}

elseif(isset($_POST['delete_category_btn'])) {
  $category_id = validate_input($_POST['category_id']);
  $query = "SELECT image FROM categories WHERE id='$category_id'";
  $result = mysqli_query($con, $query);

  if ($result && mysqli_num_rows($result) > 0) {
      $category_data = mysqli_fetch_assoc($result);
      $image = $category_data['image'];

      $delete_query = "DELETE FROM categories WHERE id='$category_id'";
      if (mysqli_query($con, $delete_query)) {
          if(file_exists("../uploads/$image")) {
              unlink("../uploads/$image");
          }
          redirect("category.php", "Category deleted successfully");
      } else {
          redirect("category.php", "Something went wrong");
      }
  } else {
      redirect("category.php", "Category not found");
  }
}

elseif(isset($_POST['add_product_btn'])) {
  $category_id = validate_input($_POST['category_id']);
  $name = validate_input($_POST['name']);
  $slug = validate_input($_POST['slug']);
  $small_description = validate_input($_POST['small_description']);
  $description = validate_input($_POST['description']);
  $original_price = validate_input($_POST['original_price']);
  $selling_price = validate_input($_POST['selling_price']);
  $qty = validate_input($_POST['qty']);
  $meta_title = validate_input($_POST['meta_title']);
  $meta_description = validate_input($_POST['meta_description']);
  $meta_keywords = validate_input($_POST['meta_keywords']);
  $status = isset($_POST['status']) ? '1' : '0';
  $trending = isset($_POST['trending']) ? '1' : '0';

  if(empty($name) || empty($slug) || empty($description) || empty($original_price) || empty($selling_price) || empty($qty)) {
      redirect("add-product.php", "All fields are mandatory");
      exit();
  }

  if ($_FILES['image']['error'] == 0) {
      $image = $_FILES['image']['name'];
      $image_ext = pathinfo($image, PATHINFO_EXTENSION);
      $filename = time().'.'.$image_ext;
      $path = "../uploads";

      $query = "INSERT INTO products (category_id, name, slug, small_description, description, original_price, selling_price,
                qty, meta_title, meta_description, meta_keywords, status, trending, image) 
                VALUES ('$category_id', '$name', '$slug', '$small_description', '$description', '$original_price',
                '$selling_price', '$qty', '$meta_title', '$meta_description', '$meta_keywords', '$status', '$trending', '$filename')";

      if (mysqli_query($con, $query)) {
          move_uploaded_file($_FILES['image']['tmp_name'], "$path/$filename");
          redirect("add-product.php", "Product added successfully");
      } else {
          redirect("add-product.php", "Something went wrong");
      }
  } else {
      redirect("add-product.php", "Image is required");
  }
}

else if(isset($_POST['update_product_btn']))
{
  $product_id = $_POST['product_id'];
  $category_id = $_POST['category_id'];
  $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description  = $_POST['small_description'];
    $description  = mysqli_real_escape_string($con, $_POST['description']);

    $original_price  = $_POST['original_price'];
    $selling_price  = $_POST['selling_price'];
    $qty  = $_POST['qty'];
    $meta_title  = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0';
    $trending = isset($_POST['trending']) ? '1':'0';

    $image =$_FILES['image']['name'];
    $path = "../uploads";
  $new_image = $_FILES['image']['name'];
  $old_image = $_POST['old_image'];

  if($new_image != "")
  {
    // $update_filename = $new_image;
    $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
    $update_filename = time().'.'.$image_ext;
  }
  else
  {
    $update_filename = $old_image;
  }
   
  
  $update_product_query = " UPDATE products SET name='$name',slug='$slug', small_description='$small_description' ,description='$description' ,
  original_price='$original_price',selling_price='$selling_price',qty='$qty', 
   meta_title = '$meta_title' , meta_description='$meta_description' , meta_keywords= '$meta_keywords', 
   status ='$status', trending='$trending' , image='$update_filename' WHERE id='$product_id' ";

   $update_product_query_run = mysqli_query($con, $update_product_query);

     if($update_product_query_run)
   {
    if($_FILES['image']['name'] != "")
    {
      move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
      if(file_exists("../uploads/".$old_image))
      {
        unlink("../uploads/".$old_image);
      }
    }
    redirect("edit-product.php?id=$product_id","product Update Successfully");
   }
   else
   {
    redirect("edit-product.php?id=$product_id","Something  Went Wrong");
    
   }
      

}

else if(isset($_POST['delete_product_btn']))
{
  $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
  
  $product_query = "SELECT * FROM products WHERE id='$product_id'";
  $product_query_run = mysqli_query($con ,$product_query);
  $product_data = mysqli_fetch_array($product_query_run);
  $image = $product_data['image'];

  $delete_query = "DELETE FROM products WHERE id='$product_id'";
  $delete_query_run = mysqli_query($con ,$delete_query);

  if($delete_query_run)
  { 
    if(file_exists("../uploads/".$image))
    {
      unlink("../uploads/".$image);
    }
    redirect("products.php","product Delete Successfully");
  }
  else
  {
   redirect("products.php","Something  Went Wrong");
   
  }
 
}

else if (isset($_POST['delete_feedback_btn'])) {
  $feedback_id = mysqli_real_escape_string($con, $_POST['feedback_id']);

  // Check if the feedback exists
  $checkFeedback = "SELECT * FROM feedback WHERE id='$feedback_id'";
  $checkFeedback_run = mysqli_query($con, $checkFeedback);

  if (mysqli_num_rows($checkFeedback_run) > 0) {
      // Delete query
      $deleteQuery = "DELETE FROM feedback WHERE id='$feedback_id'";
      $deleteQuery_run = mysqli_query($con, $deleteQuery);

      if ($deleteQuery_run) {
          $_SESSION['message'] = "Feedback deleted successfully!";
          header("Location: feedback.php");
          exit(0);
      } else {
          $_SESSION['message'] = "Failed to delete feedback!";
          header("Location: feedback.php");
          exit(0);
      }
  } else {
      $_SESSION['message'] = "Feedback not found!";
      header("Location: feedback.php");
      exit(0);
  }
}

else if (isset($_POST['update_order_btn']))
{
    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];

    $updateorder_query = "UPDATE orders SET status='$order_status' WHERE tracking_no ='$track_no' ";
    $updateorder_query_run = mysqli_query($con,$updateorder_query);

    redirect("view-order.php?t=$track_no", "Order Status updated successfully");
}

else if (isset($_POST['accept_btn']))
{
  $product_id = mysqli_real_escape_string($con, $_POST['rstatus']);

    $accept_query = "UPDATE returndata SET status ='1' WHERE id='$product_id' ";
    $accept_query_run = mysqli_query($con,$accept_query);

    redirect("returnadmin.php", "Status updated successfully");
}

else if(isset($_POST['reject_btn']))
{
  $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
  
  $reject_query = "SELECT * FROM returndata WHERE id='$product_id'";
  $reject_query_run = mysqli_query($con ,$reject_query);
  $product_data = mysqli_fetch_array($reject_query_run);
  $image = $product_data['image'];

  $delete_query = "DELETE FROM returndata WHERE id='$product_id'";
  $delete_query_run = mysqli_query($con ,$delete_query);

  if($delete_query_run)
  { 
    if(file_exists("../uploads/".$image))
    {
      unlink("../uploads/".$image);
    }
    redirect("returnadmin.php","Data Delete Successfully");
  }
  else
  {
   redirect("returnadmin.php","Something  Went Wrong");
   
  }
 
}

else
{
  header('Location: ../index.php');
}




?>