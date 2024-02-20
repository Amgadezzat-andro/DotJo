<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" enctype="multipart/form-data">
                <!-- Article Title -->
                <div class="form-group">
                    <label for="articleTitle">Title</label>
                    <input value="<?= $article->article_title ?>" name="article_title" type="text" class="form-control"
                        id="articleTitle" placeholder="Enter article title">
                </div>

                <!-- Article Image -->
                <div class="form-group">
                    <label for="articleImage">Select Image</label>
                    <input name="article_pic" type="file" class="form-control" id="articleImage">
                    <input type="hidden" name="current_image" value="<?= $article->article_pic ?>">
                    <?php
                    if ($article->article_pic == '') {
                        echo " <img style='width: 50px;' src='https://static.vecteezy.com/system/resources/previews/005/337/799/original/icon-image-not-found-free-vector.jpg' class='card-img-top' alt='...'>";
                    } else {
                        echo "<img style='width: 150px;' src='/upload/article_images/$article->article_pic' class='card-img-top' alt='...'>";
                    }
                    ?>
                </div>
                <!-- Article Description -->
                <div class="form-group">
                    <label for="articleDescription">Description</label>
                    <textarea name="article_desc" class="form-control" id="articleDescription" rows="3"
                        placeholder="Enter article description"><?=$article->article_desc?></textarea>
                </div>

                <!-- Article Category -->
                <div class="form-group">
                    <label for="articleCategory">Category</label>
                    <select name="cat_id" class="form-control" id="articleCategory">
                        <?php
                        foreach ($categories as $category):
                            if($category->id == $article->cat_id){
                                echo "<option value='$category->id' selected >$category->category_name</option>";
                            }
                            echo "<option value='$category->id'>$category->category_name</option>";
                        endforeach;
                        ?>
                    </select>
                </div>

                <!-- Submit Button -->
                <input name="submit" type="submit" class="btn btn-primary" value="Save">
            </form>
        </div>
    </div>
</div>