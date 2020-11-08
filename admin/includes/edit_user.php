<?php

    // THIS IS FOR SHOWING OUR CURRENT VALUES BEFORE EDIT IN THE FORM BELOW
    
    if(isset($_GET['u_id'])) {
        $the_user_id = $_GET['u_id'];
        // This is empty: echo $_GET['edit_post'];
        
        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
        $select_users_by_id = mysqli_query($connection, $query);  
        
        while($row = mysqli_fetch_assoc($select_users_by_id)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }
        
        //echo $_GET['p_id'];
    }
  
?>


<?php 

    // THIS IS FOR UPDATE A POST IN DB
    
    if(isset($_POST['update_user'])) {

        $username = $_POST['username'];
        $user_password = $_POST['user_password'];        
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        /*
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        */
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role']; 
        
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
                "WHERE user_id = {$the_user_id} ";
        //echo $query;
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
		<label for="user_firstname">Firstname</label>
		<!-- we can write at value without isset.. but maybe it is better this way -->
		<input value="<?php if(isset($user_firstname)) {echo $user_firstname;} ?>" type="text" class="form-control" name="user_firstname">
	</div>
	
	<div class="form-group">
		<label for="user_lastname">Lastname</label>
		<input value="<?php if(isset($user_lastname)) {echo $user_lastname;} ?>" type="text" class="form-control" name="user_lastname">
	</div>
	
	<div class="form-group">
		<label for="user_role">User Role</label><br>	
		<select name="user_role" id="">			
			<option value="subscriber"><?php echo $user_role; ?></option>
			<?php 
			if($user_role === 'admin') {
			    echo "<option value='subscriber'>subscriber</option>";
			} 
			else {
				echo "<option value='admin'>admin</option>";
			}
			?>		
		</select>
	</div>
		
	<div class="form-group">
		<label for="username">Username</label>
		<input value="<?php if(isset($username)) {echo $username;} ?>" type="text" class="form-control" name="username">
	</div>
	
	<div class="form-group">
		<label for="user_email">Email</label>
		<input value="<?php if(isset($user_email)) {echo $user_email;} ?>" type="email" class="form-control" name="user_email">
	</div>	
	
	<div class="form-group">
		<label for="user_password">Password</label>
		<input value="<?php if(isset($user_password)) {echo $user_password;} ?>" type="password" class="form-control" name="user_password">
	</div>		
	
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="update_user" value="Update User">
	</div>
	
</form>