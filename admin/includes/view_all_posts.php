						<table class="table table-bordered table-hover">
                        	<thead>
                        		<tr>
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