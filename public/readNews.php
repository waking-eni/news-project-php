<?php
   include_once __DIR__.'/../database/news.php';
   include_once __DIR__.'/../database/comments.php';
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

                            echo '<div class="image-read-news">';
                            echo '<img src="data:image/jpeg;base64,'.base64_encode( $article['picture'] ).'"/>';
                            echo '<a class="d-block green-link" href="'.$article["picture_source"].'" target="_blank">'.'Image source</a>';
                            echo '</div>';

                            echo '<hr>';

                            echo '<div class="article-content">';
                            echo stripslashes($article['content']);
                                echo '<hr>';
                                echo '<p class="font-weight-bold text-right">Written by '.stripslashes(getAuthor($article["administrator_id"])).'</p>';
                                echo '<p class="font-weight-bold text-right">Published on '.$article["date_added"].', category: '.$article["category"].'</p>';
                            echo '</div>';

                        } else {
                            echo '<div class="jumbotron jumbotron-fluid mt-3">';
                                echo '<div class="container">';
                                    echo '<h1 class=display-4">Wrong article</h1>';
                                echo '</div>';
                            echo '</div>';
                        }

                    ?>
                </div>

                <!--Comments-->
                <hr>

                <form action="../includes/comments.inc.php" method="post" onsubmit="emptyComment()">
                    <div class="form-group">
                        <span>Add a comment</span>
                        <button class="btn btn-dark" type="submit" name="comment">
                        Comment</button>
                        <textarea class="form-control" rows="3" name="comment" id="commentArea" placeholder="..."></textarea>
                        <input type="hidden" name="idArticle" value="<?php echo htmlspecialchars($idArticle); ?>">
                    </div>
                </form>


                <div class="comment-div">
                    <?php

                        $comments = fetchComments($idArticle);

                        if($comments && !empty($comments)) {
                            foreach($comments as $key => $comment) {
                                echo '<div class="card">';
                                    echo '<div class="card-body">';
                                        echo '<h6 class="card-header">'.stripslashes($comment['username']).'</h6>';
                                        echo '<p class="card-text">'.stripslashes($comment['content']).'</p>';
                                    echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>No comments to show</p>';
                        }
                    ?>
                </div>

                <script>
                    function emptyComment() {
                        document.getElementById("commentArea").innerText = "";
                    }
                </script>

                <!--end of comments-->

            </main>
            <!--end of main-->

        </div>
    </div>
    <!--end of wrapper-->

</body>
</html>
