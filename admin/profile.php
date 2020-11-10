<?php include "includes/header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation.php"; ?> 

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12"> 
                         
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>
                            	<?php if(isset($_SESSION['username'])) {
                            	    echo $_SESSION['username'];                            	    
                            	} else {
                            	    echo 'admin';
                            	}
                            	?>
                           	</small>
                        </h1>
                        
                        <?php 
                        if(isset($_POST['update_profile_user'])) {
                            
                            if(isset($_SESSION['user_id'])) {
                                $profile_user_id = $_SESSION['user_id'];
                            
                                $username = $_POST['profile_username'];
                                $user_password = $_POST['profile_user_password'];
                                $user_firstname = $_POST['profile_user_firstname'];
                                $user_lastname = $_POST['profile_user_lastname'];
                                /*
                                 $post_image = $_FILES['image']['name'];
                                 $post_image_temp = $_FILES['image']['tmp_name'];
                                 */
                                $user_email = $_POST['profile_user_email'];
                                $user_role = $_POST['profile_user_role'];
                                
                                // Now we will the function for the images.
                                // We will move the image from the temporary location to the permamanent one:
                                
                                //move_uploaded_file($post_image_temp, "../images/$post_image");
                                
                                
                                // WO DO THIS SO IF WE "DOUBLE UPDATE" WE WILL HAVE THE RIGHT IMAGE ALWAYS...
                                /*
                                 if(empty($post_image)) {
                                 $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
                                 $get_image_query = mysqli_query($connection, $query);
                                 confirmQuery($get_image_query);
                                 while($row = mysqli_fetch_assoc($get_image_query)) {
                                 $post_image = $row['post_image'];
                                 }
                                 }
                                 */
                                
                                // UPDATE A POST QUERY
                                $query = "UPDATE users SET ".
                                    "username = '{$username}', ".
                                    "user_password = '{$user_password}', ".
                                    "user_firstname = '{$user_firstname}', ".
                                    "user_lastname = '{$user_lastname}', ".
                                    "user_email = '{$user_email}', ".
                                    "user_role = '{$user_role}' ".
                                    "WHERE user_id = {$profile_user_id} ";
                                //echo $query;
                                $_SESSION['username'] = $username;
                                $profile_update_query = mysqli_query($connection, $query);
                                
                                /*
                                 if(!$update_query) {
                                 die("QUERY FAILED" . mysqli_error($connection));
                                 }
                                 */
                                confirmQuery($profile_update_query);
                                header("Refresh:0");
                                }
                        }
                        
                        
                        ?>
                    
                    	<?php
                    	if(isset($_SESSION['username'])) {
                    	    $profile_username = $_SESSION['username'];
                    	    
                    	    $query = "SELECT * FROM users WHERE username = '{$profile_username}' ";
                    	    $select_user = mysqli_query($connection, $query);
                    	    
                    	    if(!$select_user) {
                    	        
                    	        die("QUERY FAILURE" . mysqli_error($connection));
                    	        
                    	    }
                    	    
                    	    while($row = mysqli_fetch_assoc($select_user)) {
                    	        $profile_user_id = $row['user_id'];
                    	        $profile_username = $row['username'];
                    	        $profile_user_password = $row['user_password'];
                    	        $profile_user_firstname = $row['user_firstname'];
                    	        $profile_user_lastname = $row['user_lastname'];
                    	        $profile_user_email = $row['user_email'];
                    	        $profile_user_image = $row['user_image'];
                    	        $profile_user_role = $row['user_role'];
                    	   }
                    	}
                    	
                    	
                    	?>	
                    	
                    	<form action="" method="post" enctype="multipart/form-data">

                        	<div class="form-group">
                        		<label for="profile_user_firstname">Firstname</label>
                        		<!-- we can write at value without isset.. but maybe it is better this way -->
                        		<input value="<?php if(isset($profile_user_firstname)) {echo $profile_user_firstname;} ?>" type="text" class="form-control" name="profile_user_firstname">
                        	</div>
                        	
                        	<div class="form-group">
                        		<label for="profile_user_lastname">Lastname</label>
                        		<input value="<?php if(isset($profile_user_lastname)) {echo $profile_user_lastname;} ?>" type="text" class="form-control" name="profile_user_lastname">
                        	</div>
                        	
                        	<div class="form-group">
                        		<label for="profile_user_role">User Role</label><br>	
                        		<select name="profile_user_role" id="">			
                        			<option value="subscriber"><?php echo $profile_user_role; ?></option>
                        			<?php 
                        			if($profile_user_role === 'admin') {
                        			    echo "<option value='subscriber'>subscriber</option>";
                        			} 
                        			else {
                        				echo "<option value='admin'>admin</option>";
                        			}
                        			?>		
                        		</select>
                        	</div>
                        		
                        	<div class="form-group">
                        		<label for="profile_username">Username</label>
                        		<input value="<?php if(isset($profile_username)) {echo $profile_username;} ?>" type="text" class="form-control" name="profile_username">
                        	</div>
                        	
                        	<div class="form-group">
                        		<label for="profile_user_email">Email</label>
                        		<input value="<?php if(isset($profile_user_email)) {echo $profile_user_email;} ?>" type="email" class="form-control" name="profile_user_email">
                        	</div>	
                        	
                        	<div class="form-group">
                        		<label for="profile_user_password">Password</label>
                        		<input value="<?php if(isset($profile_user_password)) {echo $profile_user_password;} ?>" type="password" class="form-control" name="profile_user_password">
                        	</div>	
                        	
                        	<?php $_SESSION['user_id'] = $profile_user_id; ?>	
                        	
                        	<div class="form-group">
                        		<input class="btn btn-primary" type="submit" name="update_profile_user" value="Update Profile">
                        	</div>
                        	
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php  include "includes/footer.php"; ?>