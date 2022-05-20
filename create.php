<?php
 require_once 'connection.php';

   $errors = [];

  $SKU = '';
  $Name = '';
  $Price = '';
  $size = '';
  $weight = '';
  $height = '';
  $width = '';
  $length = '';

// This code creates a general codes consisting of 8 digits and each product has a different unique code.
function generateKey() {
    $keyLength = 8;
    $str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randStr = substr(str_shuffle($str), 0, $keyLength);
    return $randStr;
  }
  function randomString($n)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for($i = 0; $i < $n; $i++){
      $index = rand(0, strlen($characters)-1);
      $str .= $characters[$index];
    }
    return $str;
  }
  if($SKU == ''){
    $SKU = generateKey();
  }
  
//  Through this code, information is stored and sent for printing to 
// a database and returned to the first page with the product uploaded.
  if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $Name=$_POST['name'];
    $Price=$_POST['price'];
    $size=$_POST['size']; 
    $weight=$_POST['weight']; 
    $height=$_POST['height'];
    $width=$_POST['width'];
    $length=$_POST['length'];
  
    $image = $_FILES['image'] ?? null;
    $imagePath = '';
    if(!is_dir('images')){
      mkdir('images');
    }
    if($image){
      $imagePath = 'images/' . randomString(5) .'/'.$image['name'];
      mkdir(dirname($imagePath));
      move_uploaded_file($image['tmp_name'], $imagePath);
    }
    
  if(empty($errors)){
      $statement = $pdo->prepare("INSERT INTO products (image, sku, name, price, size, weight, height, width, length)
              VALUES(:image, :SKU, :Name, :Price, :size, :weight, :height, :width, :length)");
    
    $statement->bindValue(':SKU', $SKU);
    $statement->bindValue(':Name', $Name);
    $statement->bindValue(':image', $imagePath);
    $statement->bindValue(':Price', $Price);
    $statement->bindValue(':size', $size);
    $statement->bindValue(':weight', $weight);
    $statement->bindValue(':height', $height);
    $statement->bindValue(':width', $width);
    $statement->bindValue(':length', $length);
  
    $statement->execute();
    header('Location: index.php');
    }
  }
  ?>
  <?php require_once 'header.php'; ?>
  
  <!--Styles are listed here-->
  <style>
  {
    margin:0 0;
    padding: 0 0;
    font-family: Arial, Helvetica, sans-serif;
  }
  .wrapper{
    padding: 1%;
    width: 80%;
    margin: 0 auto;
  }
      body {
    font-size: 14px;
    background-color: rgb(211, 82, 82);
    font-family: 'Roboto Slab', serif;
    color: white;
    }
    .cansel-button{
      position: absolute;
      left: 1100px;
      top: 38px;
      display: inline-block;
      padding: 2px 10px;
      font-size: 15px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      outline: none;
      color: #fff;
      background-color: #e74c3c;
      border: none;
      border-radius: 15px;
      box-shadow: 0 9px #4b4b4b;
    }
    .cansel-button:hover{
      background-color: #c23616;
    }
    .cansel-button:active{
      background-color: #c23616;
      box-shadow: 0 5px #4b4b4b;
      transform: translateY(4px);
    }
   .save-button{
    position: absolute;
    left: 550px;
    top: -115px;
    display: inline-block;
    padding: 2px 10px;
    font-size: 15px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    outline: none;
    color: #fff;
    background-color:  #4CAF50;
    border: none;
    border-radius: 15px;
    box-shadow: 0 9px #4b4b4b;
  }
  .save-button:hover{
    background-color: green;
  }
  .save-button:active{
    background-color:  green;
    box-shadow: 0 5px #4b4b4b;
    transform: translateY(4px);
  }
    
    footer {
            text-align: center;
        }
  
    .one{
     font-size: 15px; color: white;
    }
    .header{
           background: rgb(107, 17, 17);
        }
        .header {
          text-shadow: 2px 2px 5px black;
          color: white;
          cursor: pointer;
        }
    .two{
     font-size: 15px; 
      color: white;
    }
    .three{
     font-size: 15px; color: white;
    }
    .all-label{
      transform: translate(10px, 30px);
      
    }
      .form-group {
         cursor: pointer;
      text-align: center;
      font-size: 15px;
      color: white;
    background-color: tomato;
    }
  </style>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<link rel='stylesheet' href='app.css'>

<!-- This code executes the command during the call, the user chooses one of the 3 categories.
       DVD, book or furniture. -->
    <script type="text/javascript"> 
      $(document).ready(function(){
        $("select").change(function(){
          $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
              $(".box").not("." + optionValue).hide();
              $("." + optionValue).show();
            }
            else
            {
              $(".box").hide();
            }
          });
        }).change();
      });
    </script>
    
</head>
<body>
 
<!-- The validation code is written here -->
   <?php if(!empty($errors)): ?>
          <div class="alert alert-danger">
              <?php foreach ($errors as $error): ?>
                 <div><?php echo $error  ?></div>

                <?php endforeach; ?>

              </div>
      <?php endif; ?>

      <script>
          function validateForm() {
         let x = document.forms["myForm"]["name"].value;
         let y = document.forms["myForm"]["price"].value;

         if (x == "") {
         alert("Name must be filled out");
         return false;
         }
         if (y == "") {
         alert("Price must be filled out");
         return false;
         }
  
        }
     </script>

<!-- This code is the title of the second page -->
  <div class="header" style="width: 100%;">
      <div class="wrapper">
      <h1>ADD Product</h1>
   </div>
      
</div>

 <!-- This code displays the fields required to load the product on the Add page, the second page. -->
  <div class="container" id = "wholepage" style="width: 470px">   
     <form method="post" enctype="multipart/form-data" id="product_form" name="myForm"
        onsubmit="return validateForm()">

      <a href="cansel.php" type="reset" name="cansel" class="cansel-button">Cansel</a>
      <br><br><div class="all-label">

        <div class="form-group">
           <label>Product Image</label><br>
          <input type="file" name="image" > 
         </div><br>

        <div class="form-group" id="sku">
           <label>SKU</label><br>
           <input type="text" class="form-control" name="SKUTest000" value="<?php echo $SKU  ?>" readonly> 
         </div><br>

        <div class="form-group" id="name">
          <label for="Name" >Name</label>
          <input type="text" class="form-control" name="name" value="<?php echo $Name  ?>">
        </div><br>

        <div class="form-group" id="price">
          <label>Price ($)</label>
          <input type="number" step=".01" class="form-control" name="price" value="<?php echo $Price  ?>">
         </div><br><br>

     <!-- This code is a switch. Displays the fill-in fields by categories. -->
       <select class="select" style="width: 200px" id="productType" >
          <option selected>Type_Switcher...</option>
         <option value="one" >DVD-Disk</option>
         <option value="two">Book</option>
         <option value="three">Furniture</option>
       </select><br><br>
   

  <div class="one box">
    <label>Size (MB):</label>
    <input type="text" id="size" name="size" value="<?php echo $size  ?>">
  </div>

  <div class="two box">
    <label>Weight (KG):</label>
    <input type="text" id="weight" name="weight" value="<?php echo $weight  ?>">
  </div>

  <div class="three box">

   <label>Height (CM):</label>
    <input type="text" id="height" name="height" value="<?php echo $height  ?>"><br><br>
   
        <label>Width (CM):</label>
    <input type="text" id="width" name="width" value="<?php echo $width  ?>"><br><br>
  
        <label>Length (CM):</label>
    <input type="text" id="length" name="length" value="<?php echo $length  ?>">
   
  </div>
    
 <button type="submit" class="save-button" name="save">Save</button>

  </div>
  <br><br><br>
  </form>

   <!-- Here is the code at the bottom of the page -->
   <?php  require_once 'footer.php';  ?>

  </body>
</html>