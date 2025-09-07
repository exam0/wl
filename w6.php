<!DOCTYPE html> 
<html> 
 <head> 
    <title>Create Table and Insert Record</title> 
  </head> 
  <body> 
    <form method="POST"> 
      <h1>Insert Record</h1> 
      <label>Roll NO:</label> 
      <input type="text" name="r" required><br><br>   
      <label>Name:</label> 
      <input type="text" name="n" required><br><br> 
      <label>Age:</label> 
      <input type="number" name="a" required><br><br> 
      <input type="submit" value="Submit"> 
    </form> 
    <?php 
    // Check if the form has been submitted using POST method 
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
      // Retrieve form data 
      $r = $_POST['r']; 
      $n = $_POST['n']; 
      $a = $_POST['a']; 
      // Establish MySQL database connection 
      $con = mysqli_connect("localhost", "root", "", "stdu");  
      // Check if the connection failed 
      if (!$con) { 
        die("Database connection failed: " . mysqli_connect_error()); 
      } 
 // Prepare an SQL statement to prevent SQL injection 
      $stmt = $con->prepare("INSERT INTO student (rollno, name, age) VALUES (?, ?, ?)"); 
      $stmt->bind_param("isi", $r, $n, $a); // "i" for integer, "s" for string 
      // Execute the statement and check if the record was inserted 
      if ($stmt->execute()) { 
        echo "<p>Record inserted successfully</p>"; 
      } else { 
        echo "<p>Error inserting record: " . $stmt->error . "</p>"; 
      } 
      // Close the prepared statement and database connection 
      $stmt->close(); 
      $con->close(); 
    } 
    ?> 
  </body> 
</html>