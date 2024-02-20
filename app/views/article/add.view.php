<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" enctype="multipart/form-data">
                    <!-- Article Title -->
                    <div class="form-group">
                        <label for="articleTitle">Title <span style="color: red;" >*</span></label>
                        <input name="article_title" type="text" class="form-control" id="articleTitle" placeholder="Enter article title" required>
                    </div>

                    <!-- Article Image -->
                    <div class="form-group">
                        <label for="articleImage">Select Image</label>
                        <input name="article_pic" type="file" class="form-control" id="articleImage">
                    </div>

                    <!-- Article Description -->
                    <div class="form-group">
                        <label for="articleDescription">Description <span style="color: red;" >*</span></label>
                        <textarea name="article_desc" class="form-control" id="articleDescription" rows="3" placeholder="Enter article description" required></textarea>
                    </div>

                    <!-- Article Category -->
                    <div class="form-group">
                        <label for="articleCategory">Category</label>
                        <select name="cat_id" class="form-control" id="articleCategory">
                        <?php
                        foreach($categories as $category):
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