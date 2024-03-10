<section style="position: absolute;
  top: 30%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 10px;" class="container-sm ">
    <form method="post">
        <div class="form-group">
            <label>Sub Category Name</label>
            <input type="text" name="scategory_name" class="form-control" placeholder="Enter Sub Category Name" value="<?= $scategory->name ?>" required>
         
            <div class="form-group">
                <label for="articleCategory">Category</label>
                <select name="cat_id" class="form-control" id="articleCategory">
                    <?php
                    foreach ($categories as $category):
                        if($category->id == $scategory->cat_id){     
                            echo "<option value='$category->id' selected>$category->category_name</option>";
                        }else{
                            echo "<option value='$category->id'>$category->category_name</option>";
                        }
                    endforeach;
                    ?>
                </select>
            </div>
            <input class="btn btn-primary" type="submit" name="submit" value="Save">


    </form>
</section>