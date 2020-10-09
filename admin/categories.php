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
                        			
                        			$query = 'SELECT * FROM categories';
                        			$select_categories = mysqli_query($connection, $query);  
                        			
                        			while($row = mysqli_fetch_assoc($select_categories)) {
                        			    $cat_id = $row['cat_id'];
                        			    $cat_title = $row['cat_title'];
                        			    echo "<tr>";
                        			    echo "<td>{$cat_id}</td>";
                        			    echo "<td>{$cat_title}</td>";
                        			    echo "</tr>";
                        			}
                        			
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