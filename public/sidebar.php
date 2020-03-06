<?php
   include_once __DIR__.'/../database/news.php';
?>

<div class="col sidebar bg-dark mt-0 h-100">
     <h3 class="white-font">Category</h3>

    <ul class="list-unstyled">

    <?php
     $categories = getAllCategories();

     if($categories && !empty($categories)) {
         foreach($categories as $key => $category) {

            echo '<li class="nav-item">';
                echo '<a class="nav-link active green-link" href="listByCategory.php?category='.$category["category"].'">'
                .$category['category'].'</a>';
            echo '</li>';

         }
     }
     else {
         echo 'Wrong category';
     }

     ?>

    </ul>

</div>
