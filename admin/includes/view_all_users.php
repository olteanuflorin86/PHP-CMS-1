						<table class="table table-bordered table-hover">
                        	<thead>
                        		<tr>
                        			<th>Id</th>
                        			<th>Username</th>
                        			<th>Firstname</th>  
                        			<th>Lastname</th>                        			
                        			<th>Email</th>
                        			<th>Role</th>                        			
                        		</tr>                        	
                        	</thead>
                        	<tbody>
                        		
                        		<?php 
                        		
                        		// FIND ALL POSTS QUERY
                        		$query = 'SELECT * FROM users';
                        		$select_users = mysqli_query($connection, $query);
                        		
                        		if(!$select_users) {
                        		    
                        		    die("QUERY FAILURE" . mysqli_error($connection));
                        		    
                        		}
                        		
                        		while($row = mysqli_fetch_assoc($select_users)) {
                        		    $user_id = $row['user_id']; 
                        		    $username = $row['username'];
                        		    $user_password = $row['user_password']; 
                        		    $user_firstname = $row['user_firstname']; 
                        		    $user_lastname = $row['user_lastname'];
                        		    $user_email = $row['user_email'];
                        		    $user_image = $row['user_image'];
                        		    $user_role = $row['user_role'];
                        		?>
                        		    
                        		    
                        		    <tr>
                            		    <td><?php echo $user_id; ?></td>
                            		    <td><?php echo $username; ?></td>                          		    
                            		    <td><?php echo $user_firstname; ?></td>
                            		    <td><?php echo $user_lastname; ?></td>
                            		    <td><?php echo $user_email; ?></td>
                            		    <td><?php echo $user_role; ?></td>
                            		    
                            		    
                            		    <?php 
                        		          /*
                            		      $query = "SELECT * FROM posts WHERE post_id={$comment_post_id}";
                            		      $select_comment_post_title = mysqli_query($connection, $query);
                            		      confirmQuery($select_comment_post_title);
                            		      
                            		      while($row = mysqli_fetch_assoc($select_comment_post_title)) {
                            		          $post_id = $row['post_id'];
                            		          $comment_post_title = $row['post_title'];
                            		      }
                            		      */
                            		    ?>  
                            		    
                            		    <td><a href=<?php echo "users.php?change_to_admin=$user_id"?>>Admin</a></td>
                        				<td><a href=<?php echo "users.php?change_to_subscriber=$user_id"?>>Subscriber</a></td>
                        				<td><a href=<?php echo "users.php?source=edit_user&u_id={$user_id}"?>>Edit</a></td>
                        				<td><a href=<?php echo "users.php?delete=$user_id"?>>Delete</a></td>
                        			</tr>
                        		<?php } ?>                		
                        		
                        		<?php 
                        		  // THIS IS FOR UNAPPROVE
                        		  // If a comment is unapprove then we won't see it in post.php
                        		if(isset($_GET['change_to_admin'])) {
                        		    
                        		    $the_user_id = $_GET['change_to_admin'];
                        		    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$the_user_id}";
                        		    $update_query = mysqli_query($connection, $query);
                        		    confirmQuery($update_query);
                        		    
                        		    header("Location: users.php");
                        		    
                        		}
                        		?>
                        		
                        		<?php 
                        		  // THIS IS FOR APPROVE
                        		  // If a comment is approve then we will see it in post.php
                        		if(isset($_GET['change_to_subscriber'])) {
                        		    
                        		    $the_user_id = $_GET['change_to_subscriber'];
                        		    
                        		    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$the_user_id}";
                        		    $update_query = mysqli_query($connection, $query);
                        		    confirmQuery($update_query);
                        		    
                        		    header("Location: users.php");
                        		    
                        		}
                        		?>
                        		
                        		<?php deleteUsers(); ?>                      		
                        	</tbody>
                        </table>