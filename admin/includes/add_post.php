<?php 

    include "../functions.php";

    if(isset($_POST['create_post'])) {
        
        // The data below we get from the form:
        
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        $post_comment_count = 4;      
        
        // Now we will the function for the images.
        // We will move the image from the temporary location to the permamanent one:
        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        
        // We also put the informations into the DB:
        
        $query = "INSERT INTO posts".
                "(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ".
                "VALUES({$post_category_id}, '{$post_title}','{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}')";
        //"VALUES(1, 'a','a', 2020-10-01, '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}')";
        
        $add_post_query = mysqli_query($connection, $query);  
        confirmQuery($add_post_query);
        

    }

?>


<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="title">Post Title</label>
		<input type=text class="form-control" name="title">
	</div>
	
	<div class="form-group">
		<label for="post_category_id">Post Category Id</label>
		<br>
		<?php 
    		$query = "SELECT * FROM categories";
    		$select_categories = mysqli_query($connection, $query);
		    
    		confirmQuery($select_categories);
		?>
    		  	<select name="post_category" id="post_category">
        		  <?php 
            		  while($row = mysqli_fetch_assoc($select_categories)) {
            		          $cat_id = $row['cat_id'];
            		          $cat_title=$row['cat_title'];
            		          echo "<option value='{$cat_id}'>{$cat_title}</option>";         
        		      }
                  ?>
    		  	</select>
		<!--<input type=text class="form-control" name="post_category_id">-->
	</div>
	
	<div class="form-group">
		<label for="author">Post Author</label>
		<input type=text class="form-control" name="author">
	</div>	
	
	<div class="form-group">
		<label for="post_status">Post Status</label>
		<input type=text class="form-control" name="post_status">
	</div>
	
	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type=file name="image">
	</div>
	
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type=text class="form-control" name="post_tags">
	</div>
	
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="10">
		</textarea>
	</div>
	
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
	</div>
	
</form>