<?php

Class Post {

 
  private $pdo; // set the database connection object as a private property of the class
  private $table = "posts";
  

  
   // Constructor method to initialize the database connection
    public function __construct($pdo) {
        $this->pdo = $pdo; 
    }

     // Create a new blog post
    public function createPost($title, $content , $author_id) {
        // Prepare the SQL statement with placeholders for the values to be inserted
        $query = "INSERT INTO ".$this->table ."(title, content,author_id) VALUES (:title, :content, :author_id)";
       
        // Use a try-catch block to handle any exceptions that may occur during the query execution
        try {
            // Prepare the SQL statement for execution
            $stmt = $this->pdo->prepare($query);

            // Bind the values to the placeholders in the prepared statement
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':author_id', $author_id);
             
            // Execute the prepared statement
            $stmt->execute();

            // Return the ID of the newly created post
            return true;
        } catch(PDOException $e) {
            // Handle any exceptions that may occur during the query execution
            echo $e->getMessage();
            return false;
        }
    }

    
      // Read all blog posts
public function readAllPosts() {

       // Prepare the SQL statement to select all posts
   $query = 'SELECT ' . $this->table . '.* , users.username FROM ' . $this->table . ' LEFT JOIN users
    ON(' . $this->table . '.author_id = users.id
    )ORDER BY ' . $this->table . '.created_at DESC' ;
    


    // Use a try-catch block to handle any exceptions that may occur during the query execution
        try {
            // Prepare the SQL statement for execution
            $stmt = $this->pdo->prepare($query);

            // Execute the prepared statement
            $stmt->execute();

            // Fetch the results as an associative array
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Return the results
            return $results;
        } catch(PDOException $e) {
            // Handle any exceptions that may occur during the query execution
            echo $e->getMessage();
            return false;
        }



    

    }
    



}


?>