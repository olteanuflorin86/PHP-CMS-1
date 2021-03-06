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
                            <small>Author</small>
                        </h1>
                        
                        <div class="col-xs-6">
                        
                            <?php 
                                /*
                                 * // THIS IS MOVED INTO admin/functions.php - insert_categories
                                 * 
                                //THIS IS FOR POST A CATEGORY IN DB
                                if(isset($_POST['submit'])) {
                                    //echo "Submited category";
                                    $cat_title = $_POST['cat_title'];
                                    // VALIDATIONS:
                                    if($cat_title == "" || empty($cat_title)) {
                                        echo 'This field should not be empty';
                                     } else {
                                        echo $cat_title;
                                        $query = "INSERT INTO categories(cat_title) ";
                                        $query .= "VALUE('{$cat_title}') ";
                                        
                                        $create_category_query = mysqli_query($connection, $query);
                                    
                                        if(!$create_category_query) {
                                            // if it doesn't work we kill the script and we will show the error
                                            die('QUERY FAILED' . mysqli_error($connection));
                                        }
                                     }
                                }
                         		*/
                            
                                insert_categories();
                            ?>                        

                        	<form action="" method="post">
                        		<div class="form-group">
                        			<label for="cat_title">Add Category</label>
                        			<input type="text" class="form-control" name="cat_title">
                        		</div>
                        		<div class="form-group">
                        			<input class="btn btn-primary" type="submit" name="submit" value = "Add category"> 
                        		</div>                        	
                        	</form>   
                        	
                        	<?php  // UPDATE AND INCLUDE QUERY
                        	
                        	if(isset($_GET['edit'])) {
                        	    
                        	    $cat_id = $_GET['edit'];
                        	    
                        	    include "includes/update_categories.php";
                        	}
                        	
                        	?>    
                        	

                        	                    
                        </div>
                                
                        <div class="col-xs-6">
                        	<table class="table table-bordered table-hover">
                        		<thead>
                        			<tr>		
                        				<th>Id</th>
                        				<th>Category Title</th>
                        			</tr>
                        		</thead>
                        		<tbody>
                        			<tr>
                        			<?php 
                        			
                        			 /*
                        			  * // THIS IS MOVED INTO admin/functions.php - findAllCategories
                        			  * 
                        			// FIND ALL CATEGORIES QUERY
                        			$query = 'SELECT * FROM categories';
                        			$select_categories = mysqli_query($connection, $query); 
                        			
                        			while($row = mysqli_fetch_assoc($select_categories)) {
                        			    $cat_id = $row['cat_id'];
                        			    $cat_title = $row['cat_title'];
                        			    echo "<tr>";
                        			    echo "<td>{$cat_id}</td>";
                        			    echo "<td>{$cat_title}</td>";
                        			    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                        			    // delete is the key, $cat_id is the value
                        			    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                        			    echo "</tr>";
                        			}
                        			*/
                        			 findAllCategories();
                        			
                        			?>
                        			
                        			<?php 
                        			 
                        			/*
                        			 * // THIS IS MOVED INTO admin/functions.php - findAllCategories
                        			 * 
                        			 // THIS IS FOR DELETE A CATEGORY IN DB
                        			if(isset($_GET['delete'])) {
                        			    $the_cat_id = $_GET['delete'];
                        			    
                        			    // DELETE A CATEGORY QUERY
                        			    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
                        			    $delete_query = mysqli_query($connection, $query); 
                        			    // we want the page to refresh after DELETE so we'll see the difference - with header()
                        			    header("Location: categories.php");
                        			    
                        			}
                        			*/
                        			deleteCategories()
                        			
                        			?>
                        			</tr>
                        		</tbody>
                        	</table>
                        </div>
        
    
                        
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        
  <?php  include "includes/footer.php"; ?>