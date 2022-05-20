<?php
 require_once 'connection.php';
  
  $statement = $pdo->prepare('SELECT * FROM products');
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<?php 
   $errors = []; 
   require_once 'header.php';
?>

<link rel='stylesheet' href='style.css'>

<!-- Here is the title of the first page -->
            <div class="header" style="width: 100%;">
               <div class="wrapper">
                  <h1>Product List</h1>
               </div>
             </div>

<!-- The scroll code is written here -->
             <div class="progress-container">
                   <div class="progress-bar" id="myBar"></div>
            </div>  
    
<!--  When the user scrolls the page, execute myFunction  -->
             <script>
                   window.onscroll = function() {myFunction()};

                   function myFunction() {
                   var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                   var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                   var scrolled = (winScroll / height) * 100;
                   document.getElementById("myBar").style.width = scrolled + "%";
                   }
            </script>

    <style>
     .header h1{
    text-shadow: 2px 2px 5px black;
    color: white;
    cursor: pointer;
    text-align: left;
    color: white;
    display: absolute;
   transform: translate(20px, 30px);
   
  }
     .header{
           background: rgb(107, 17, 17);
        }
        .header {
          text-shadow: 2px 2px 5px black;
          color: white;
          cursor: pointer;
        }
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
    </style>

</head>

<body>
<!-- This is the code that prints the added products on the first page -->
        <div style="width: 100%;" class="container">
           <form  action="delete.php" method="post" id="product_form" class="form__body">
              <div class="grid-container">

       <!-- Here are the add and delete buttons -->
              <a href="create.php" type="submit" type="button" class="ADD-button">ADD</a>
              <button type="submit" name="check_delete_multiple_btn" id="delete-product-btn" 
              class="delete-button">MASS DELETE</button>

       <!-- According to this code, the program prints as many products on the first page as we upload -->
              <?php foreach ($products as $i => $product ): ?>
                 <tbody>
                 <div class="form-item">
                 <input style="width:18px" type="checkbox" id="check" class="delete-checkbox" onclick="isChecked"
                 name="delete-checkbox[]" value="<?php echo $product['id'] ?>"><br>

                 <?php if($product['image']): ?>
                  <img src="<?php echo $product['image'] ?>" class="product-img">
                <?php endif; ?><br>

                <?php
                echo $product['SKU'].'<br>';
                echo $product['Name'].'<br>';
                echo $product['Price']; echo " ($)".'<br>'; 
                
                if($product['size']){
                  echo "Size: "; echo $product['size']; echo " MB".'<br>';
                }
                if($product['weight']){
                  echo "Weight: "; echo $product['weight']; echo "KG".'<br>';
                  
                }
                 if($product['height']){
                  echo "Dimension: "; echo $product['height']; 
                  echo "/"; echo $product['width']; 
                  echo "/"; echo $product['length']; 
                }
                ?>

                 </div>
                 </tbody>
            <?php endforeach; ?>
             </div>
          </form>
    </div>

<!-- Here is the code at the bottom of the page -->
    <?php  require_once 'footer.php';  ?>

</body>
</html>