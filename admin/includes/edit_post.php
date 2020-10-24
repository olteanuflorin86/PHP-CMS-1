<?php

    // THIS IS FOR SHOWING OUR CURRENT VALUES BEFORE EDIT IN THE FORM BELOW
    
    if(isset($_GET['p_id'])) {

        $the_post_id = $_GET['p_id'];
        // This is empty: echo $_GET['edit_post'];
        
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_posts_by_id = mysqli_query($connection, $query);  
        
        while($row = mysqli_fetch_assoc($select_posts_by_id)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
            $post_content = $row['post_content'];
        }
        
        //echo $_GET['p_id'];
    }
  
?>


<?php 

    // THIS IS FOR UPDATE A POST IN DB
    
    if(isset($_POST['update_post'])) {

        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category'];        
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content']; 
        
        // Now we will the function for the images.
        // We will move the image from the temporary location to the permamanent one:
        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
         
        // WO DO THIS SO IF WE "DOUBLE UPDATE" WE WILL HAVE THE RIGHT IMAGE ALWAYS...
        if(empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";            
            $get_image_query = mysqli_query($connection, $query);            
            confirmQuery($get_image_query);            
            while($row = mysqli_fetch_assoc($get_image_query)) {
                $post_image = $row['post_image'];
            }            
        }


        // UPDATE A POST QUERY
        $query = "UPDATE posts SET ".
                "post_title = '{$post_title}', ".
                "post_category_id = {$post_category_id}, ".
                "post_date = now(), ".
                "post_author = '{$post_author}', ".
                "post_status = '{$post_status}', ".
                "post_image = '{$post_image}', ".
                "post_tags = '{$post_tags}', ".
                "post_content = '{$post_content}' ".
                "WHERE post_id = {$the_post_id} ";
        $update_query = mysqli_query($connection, $query);
        
        /*
        if(!$update_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        }
        */
        confirmQuery($update_query);

    }

?>

<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="post_title">Post Title</label>
		<input value="<?php if(isset($post_title)) {echo $post_title;} ?>" type="text" class="form-control" name="post_title">
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
		
		<!--<input value="<?php if(isset($post_category_id)) {echo $post_category_id;} ?>" type=text class="form-control" name="post_category_id">-->
	</div>
	
	<div class="form-group">
		<label for="post_author">Post Author</label>
		<input value="<?php if(isset($post_author)) {echo $post_author;} ?>" type=text class="form-control" name="post_author">
	</div>	
	
	<div class="form-group">		
		<label for="post_status">Post Status</label>
		<input value="<?php if(isset($post_status)) {echo $post_status;} ?>" type=text class="form-control" name="post_status">
	</div>
	
	<div class="form-group">
		<label for="post_image">Post Image</label>
		<br>
		<img width="100" src="../images/<?php echo $post_image; ?>" alt="">
		<input value="<?php if(isset($post_image)) {echo $post_image;} ?>" type=file name="image">
	</div>
	
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input value="<?php if(isset($post_tags)) {echo $post_tags;} ?>" type=text class="form-control" name="post_tags">
	</div>
	
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="10">
			<?php if(isset($post_content)) {echo $post_content;} ?>
		</textarea>
	</div>
	
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="update_post" value="Publish Post">
	</div>
	
</form>