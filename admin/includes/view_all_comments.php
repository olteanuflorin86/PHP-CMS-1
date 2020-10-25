						<table class="table table-bordered table-hover">
                        	<thead>
                        		<tr>
                        			<th>Id</th>
                        			<th>Author</th>  
                        			<th>Comments</th>                        			
                        			<th>Email</th>
                        			<th>Status</th>
                        			<th>In Response to</th>                        			
                        			<th>Date</th>
                        			<th>Approve</th>
                        			<th>Unapprove</th>
                        			<th>Delete</th>
                        			
                        		</tr>                        	
                        	</thead>
                        	<tbody>
                        		
                        		<?php 
                        		
                        		// FIND ALL POSTS QUERY
                        		$query = 'SELECT * FROM comments';
                        		$select_comments = mysqli_query($connection, $query);
                        		
                        		if(!$select_comments) {
                        		    
                        		    die("QUERY FAILURE" . mysqli_error($connection));
                        		    
                        		}
                        		
                        		while($row = mysqli_fetch_assoc($select_comments)) {
                        		    $comment_id = $row['comment_id']; 
                        		    $comment_post_id = $row['comment_post_id'];
                        		    $comment_author = $row['comment_author'];
                        		    $comment_content = $row['comment_content']; 
                        		    $comment_email = $row['comment_email'];
                        		    $comment_status = $row['comment_status'];
                        		    $comment_date = $row['comment_date'];
                        		    
                        		?>
                        		    
                        		    
                        		    <tr>
                            		    <td><?php echo $comment_id; ?></td>
                            		    <td><?php echo $comment_author; ?></td>                          		    
                            		    <td><?php echo $comment_content; ?></td>
                            		    <td><?php echo $comment_email; ?></td>
                            		    <td><?php echo $comment_status; ?></td>
                            		    
                            		    <?php 
                        		    
                            		      $query = "SELECT * FROM posts WHERE post_id={$comment_post_id}";
                            		      $select_comment_post_title = mysqli_query($connection, $query);
                            		      confirmQuery($select_comment_post_title);
                            		      
                            		      while($row = mysqli_fetch_assoc($select_comment_post_title)) {
                            		          $post_id = $row['post_id'];
                            		          $comment_post_title = $row['post_title'];
                            		      }
                            		    
                            		    ?>  
                            		    <!-- If we click a link we will go to the specific post -->                          		    
                            		    <td><a href="../post.php?p_id=<?php echo $post_id; ?>"><?php echo $comment_post_title; ?></a></td>
                            		    
                            		    <td><?php echo $comment_date; ?></td>
                            		    <td><a href=<?php echo "comments.php?approve=$comment_id"?>>Approve</a></td>
                        				<td><a href=<?php echo "comments.php?unapprove=$comment_id"?>>Unapprove</a></td>
                        				<td><a href=<?php echo "comments.php?delete=$comment_id"?>>Delete</a></td>
                        			</tr>
                        		<?php } ?>                		
                        		
                        		<?php 
                        		  // THIS IS FOR UNAPPROVE
                        		  // If a comment is unapprove then we won't see it in post.php
                        		if(isset($_GET['unapprove'])) {
                        		    
                        		    $the_comment_id = $_GET['unapprove'];
                        		    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$the_comment_id}";
                        		    $update_query = mysqli_query($connection, $query);
                        		    confirmQuery($update_query);
                        		    
                        		    header("Location: comments.php");
                        		    
                        		}
                        		?>
                        		
                        		<?php 
                        		  // THIS IS FOR APPROVE
                        		  // If a comment is approve then we will see it in post.php
                        		if(isset($_GET['approve'])) {
                        		    
                        		    $the_comment_id = $_GET['approve'];
                        		    
                        		    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$the_comment_id}";
                        		    $update_query = mysqli_query($connection, $query);
                        		    confirmQuery($update_query);
                        		    
                        		    header("Location: comments.php");
                        		    
                        		}
                        		?>
                        		
                        		<?php deleteComments(); ?>                      		
                        	</tbody>
                        </table>