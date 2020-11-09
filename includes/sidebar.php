            <div class="col-md-4">          
            	

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                        <!-- /.input-group -->
                    </form> <!-- search form -->
                </div>
                
                <!-- Login -->
                <div class="well">
                    <h4>Login</h4>
                    <!-- the values submitted will be sent to login.php page -->
                    <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Username" name="username">
                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Enter Password" name="password">
                            <span class="input-group-btn">
                            	<button class="btn btn-primary" type="submit" name="login">Submit</button>
                            </span>
                        </div>
                        <!-- /.input-group -->
                    </form> <!-- search form -->
                </div>
                

                <!-- Blog Categories Well -->
                
                <?php                     
       
                    $query = 'SELECT * FROM categories LIMIT 10';
                    $select_categories_sidebar = mysqli_query($connection, $query);

                ?>    
                
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            
                            	<?php 

                            	   while($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                            	        $cat_id = $row['cat_id'];
                                	    $cat_title = $row['cat_title'];
                                	    
                                	    echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                            	    
                            	   }
                            	
                            	?>
                            	
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
				<?php include "widget.php"; ?>

            </div>