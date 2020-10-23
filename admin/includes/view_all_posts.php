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
                        		    <tr>
                            		    <td><?php echo $post_id; ?></td>
                            		    <td><?php echo $post_category_id; ?></td>
                            		    <td><?php echo $post_title; ?></td>
                            		    <td><?php echo $post_author; ?></td>
                            		    <td><?php echo $post_date; ?></td>
                            		    <td><img src="../images/<?php echo $post_image; ?>" width="200" height="64" alt="post_image" class="img-responsive"/></td>
                            		    <td><?php echo $post_content; ?></td>
                            		    <td><?php echo $post_tags; ?></td>
                            		    <td><?php echo $post_comment_count; ?></td>
                            		    <td><?php echo $post_status; ?></td>
                            		    <td><a href=<?php echo "posts.php?delete={$post_id}"; ?>>Delete</a></td>
                        			</tr>
                        		<?php } ?>  
                        		<?php deletePosts(); ?>                      		
                        	</tbody>
                        </table>