<?php 

if(isset($_POST['checkBoxArray'])) {
    // if it is not empty anymore, if at least one box is checked
    foreach($_POST['checkBoxArray'] as $checkBoxValue) {
        // every checkBoxValue from the array is a post id
        
        $bulk_options = $_POST['bulk_options'];
        
        switch($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status = 'published' 
                                                WHERE post_id = {$checkBoxValue}";
                $update_post_status = mysqli_query($connection, $query);
                if(!$update_post_status) {
                    die("QUERY FAILURE" . mysqli_error($connection));
                }
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status = 'draft'
                                                WHERE post_id = {$checkBoxValue}";
                $update_post_status = mysqli_query($connection, $query);
                if(!$update_post_status) {
                    die("QUERY FAILURE" . mysqli_error($connection));
                }
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$checkBoxValue}";
                $delete_post = mysqli_query($connection, $query);
                if(!$delete_post) {
                    die("QUERY FAILURE" . mysqli_error($connection));
                }
                break;
            default:
                break;
        }
        
    }
}

?>

<form action="" method="post">

							<div id="bulkOptionsContainer" class="col-xs-4" style="padding:0px;">
    							<select class="form-control" name="bulk_options" id="">
    								<option value="">Select Options</option>
    								<option value="published">Publish</option>
    								<option value="draft">Draft</option>
    								<option value="delete">Delete</option>
    							</select>
							</div>
							
							<div class="col-xs-4"> 
								<input type="submit" name="submit" class="btn btn-success" value="Apply">
								<a class="btn btn-primary" href="add_post.php">Add New</a>
							</div>
							
						<table class="table table-bordered table-hover">
                        	<thead>
                        		<tr>
                        			<th><input id="selectAllBoxes" type="checkbox"></th>
                        			<th>Id</th>
                        			<th>Category id</th>
                        			<th>Title</th>                       			
                        			<th>Author</th>                       			
                        			<th>Date</th>
                        			<th>Image</th>
                        			<th>Content</th>
                        			<th>Tags</th>
                        			<th>Comments</th>
                        			<th>Status</th>
                        			<th>Edit</th>
                        			<th>Delete</th>
                        		</tr>                        	
                        	</thead>
                        	<tbody>
                        		
                        		<?php 
                        		
                        		// FIND ALL POSTS QUERY
                        		$query = 'SELECT * FROM posts';
                        		$select_posts = mysqli_query($connection, $query);
                        		
                        		if(!$select_posts) {
                        		    
                        		    die("QUERY FAILURE" . mysqli_error($connection));
                        		    
                        		}
                        		
                        		while($row = mysqli_fetch_assoc($select_posts)) {
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

                        		    
                        		    ?>
                        		    
                        		    <?php 
                        		    
                        		      $query = "SELECT cat_title FROM categories WHERE cat_id={$post_category_id}";
                        		      $select_category_title = mysqli_query($connection, $query);
                        		      confirmQuery($select_category_title);
                        		      
                        		      while($row = mysqli_fetch_assoc($select_category_title)) {
                        		          $cat_title_name = $row['cat_title'];
                        		      }
                        		    
                        		    ?>
                        		    
                        		    
                        		    <tr>
                        		    	<!-- The name below is an array because we can check more posts - so we add more post ids to the array. 
                        		    	We put post_id at value so we will send that id into the array. At first is an empty array -->
                        		    	<td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value=<?php echo $post_id; ?>></td>
                            		    <td><?php echo $post_id; ?></td>
                            		    <!--<td><?php //echo $post_category_id; ?></td>-->
                            		    <td><?php echo $cat_title_name; ?></td>                            		    
                            		    
                            		    <td><?php echo $post_title; ?></td>
                            		    <td><?php echo $post_author; ?></td>
                            		    <td><?php echo $post_date; ?></td>
                            		    <td><img src="../images/<?php echo $post_image; ?>" width="200" height="64" alt="post_image" class="img-responsive"/></td>
                            		    <td><?php echo $post_content; ?></td>
                            		    <td><?php echo $post_tags; ?></td>
                            		    <td><?php echo $post_comment_count; ?></td>
                            		    <td><?php echo $post_status; ?></td>
                            		    <td><a href=<?php echo "posts.php?source=edit_post&p_id={$post_id}"; ?>>Edit</a></td>
                            		    <td><a href=<?php echo "posts.php?delete={$post_id}"; ?>>Delete</a></td>
                        			</tr>
                        		<?php } ?>                		
                        		
                        		
                        		<?php deletePosts(); ?>                      		
                        	</tbody>
                        </table>
                        
</form>