<?php

function insert_categories() {
    
    // We will make $connection variable global so we can access the DB
    // When we use a function and we need a variable to be available we can bring it with global keyword
    global $connection;
    
    //THIS IS FOR POST A CATEGORY IN DB
    if(isset($_POST['submit'])) {
        //echo "Submited category";
        $cat_title = $_POST['cat_title'];
        // VALIDATIONS:
        if($cat_title == "" || empty($cat_title)) {
            echo 'This field should not be empty';
        } else {
            //echo $cat_title;
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$cat_title}') ";
            
            $create_category_query = mysqli_query($connection, $query);
            
            if(!$create_category_query) {
                // if it doesn't work we kill the script and we will show the error
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}

function findAllCategories() {
    
    // We will make $connection variable global so we can access the DB
    // When we use a function and we need a variable to be available we can bring it with global keyword
    global $connection;
    
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
}

function deleteCategories() {
    
    // We will make $connection variable global so we can access the DB
    // When we use a function and we need a variable to be available we can bring it with global keyword
    global $connection;
    
    // THIS IS FOR DELETE A CATEGORY IN DB
    if(isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        
        // DELETE A CATEGORY QUERY
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        // we want the page to refresh after DELETE so we'll see the difference - with header()
        header("Location: categories.php");
        
    }
}

function deletePosts() {
    
    // We will make $connection variable global so we can access the DB
    // When we use a function and we need a variable to be available we can bring it with global keyword
    global $connection;
    
    // THIS IS FOR DELETE A CATEGORY IN DB
    if(isset($_GET['delete'])) {
        $the_post_id = $_GET['delete'];
        
        // DELETE A CATEGORY QUERY
        $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
        $delete_query = mysqli_query($connection, $query);
        // we want the page to refresh after DELETE so we'll see the difference - with header()
        header("Location: posts.php");
        
    }
}

function deleteComments() {
    
    // We will make $connection variable global so we can access the DB
    // When we use a function and we need a variable to be available we can bring it with global keyword
    global $connection;
    
    // THIS IS FOR DELETE A CATEGORY IN DB
    if(isset($_GET['delete'])) {
        $the_comment_id = $_GET['delete'];
        
        // DELETE A CATEGORY QUERY
        $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
        $delete_query = mysqli_query($connection, $query);
        // we want the page to refresh after DELETE so we'll see the difference - with header()
        header("Location: comments.php");
        
    }
}

function confirmQuery($result) {
    
    global $connection;
    
    if(!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

?>
