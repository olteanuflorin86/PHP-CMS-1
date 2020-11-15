<?php 

    include "../functions.php";

    if(isset($_POST['create_user'])) {
        
        // The data below we get from the form:
        
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        //$user_date = date('d-m-y');
        
        
        // We also put the informations into the DB:        
        $query = "INSERT INTO users".
                "(username, user_password, user_firstname, user_lastname, user_email, user_role) ".
                "VALUES('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_role}')";
        
        $add_user_query = mysqli_query($connection, $query);  
        confirmQuery($add_user_query);

    }

?>

<!-- we have multiport/form-data because we work with an image -->
<form action="" method="post" enctype="multipart/form-data">

	<?php 
	
	if(isset($_POST['create_user'])) {
	    // we added a CSS class to the link below / we can also add bootstrap class if we import it
	    echo "User Created: " . " " . "<a href='users.php' style='color:green;'>View Users</a>";
	}
	
	?>
	
	<div class="form-group">
		<label for="user_firstname">Firstname</label>
		<input type=text class="form-control" name="user_firstname">
	</div>	
	
	<div class="form-group">
		<label for="user_lastname">Lastname</label>
		<input type=text class="form-control" name="user_lastname">
	</div>

	<div class="form-group">
		<label for="user_role">User Role</label><br>	
		<select name="user_role" id="">		
			<option value="subscriber">Select Options</option>
			<option value="admin">Admin</option>
			<option value="subscriber">Subscriber</option>
		</select>
	</div>

	<!-- 
	<div class="form-group">
		<label for="user_image">Image</label>
		<input type=file name="user_image">
	</div>
	-->
		
	<div class="form-group">
		<label for="username">Username</label>
		<input type=text class="form-control" name="username">
	</div>
	
	<div class="form-group">
		<label for="user_email">Email</label>
		<input type=email class="form-control" name="user_email">
	</div>
	
	<div class="form-group">
		<label for="user_password">Password</label>
		<input type=password class="form-control" name="user_password">
	</div>
	
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create_user" value="Add User">
	</div>
	
</form>