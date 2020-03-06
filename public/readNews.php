<?php
   include_once __DIR__.'/../database/news.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
    crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
    crossorigin="anonymous"></script>
    <title>Nowena</title>
    <link rel="stylesheet" href="../design/style.css">
</head>
<body>
  
    <!--Navigation bar-->
    <?php
        include 'header.php';
    ?>
    <!--end of navigation-->

    <!--wrapper-->
    <div class="container-fluid">
        <div class="row row-wrapper">

            <!--sidebar-->
            <?php
                include 'sidebar.php';
            ?>
            <!--end of sidebar-->

            <!--main-->
            <main class="col-9 main">

                <div class="main-card">
                    <?php
                        $idArticle = $_GET['id'];
                        $article = getArticle($idArticle);

                        if(!empty($article)) {

                            echo '<div class="jumbotron jumbotron-fluid mt-3">';
                                echo '<div class="container">';
                                    echo '<h1 class=display-4">'.stripslashes($article["title"]).'</h1>';
                                    echo '<p class="lead">'.stripslashes($article["short_description"]).'</p>';
                                echo '</div>';
                            echo '</div>';

                            echo '<div class="article-content">';
                            echo stripslashes($article['content']);
                                echo '<p>'.stripslashes(getAuthor($article["administrator_id"])).'</p>';
                                echo '<p>'.$article["date_added"].' '.$article["category"].'</p>';
                            echo '</div>';

                        } else {
                            echo '<div class="jumbotron jumbotron-fluid mt-3">';
                                echo '<div class="container">';
                                    echo '<h1 class=display-4">Wrong article</h1>';
                                echo '</div>';
                            echo '</div>';
                        }

                        //other articles
                        $otherArticles = getAnotherArticle($idArticle);

                        if(!empty($otherarticles)) {

                            foreach($otherArticles as $key => $a) {

                                echo '<div class="card">';
                                    echo '<div class="card-body">';
                                    echo '<h2 class="card-header"><a class="green-link" href="readNews.php?id='.
                                    $a['id'].'&title='.stripslashes($a['title']).'">'.stripslashes($a['title']).'</a></h2>';
                                    echo '<p class="card-text mt-1">'.stripslashes($a['short_description']).'</p>';
                                    echo '<span>published on '.$a['date_added'].', by '.
                                    stripslashes(getAuthor($a['administrator_id'])).'</span>';
                                    echo '</div>';
                                echo '</div>';

                            }
                        } else {
                            echo '<div class="card">';
                                    echo '<div class="card-body">';
                                    echo '<h2 class="card-header">Wrong article</h2>';
                                    echo '</div>';
                                echo '</div>';
                        }

                    ?>
                </div>

            </main>
            <!--end of main-->
        </div>
    </div>
    <!--end of wrapper-->

</body>
</html>
