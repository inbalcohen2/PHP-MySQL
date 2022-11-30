
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel=stylesheet href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container my-5">
        <h2>List of clients </h2>
        <a class="btn btn-primary" href="/myshop/create.php" role="button">New Client</a>
        <br> 
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead> 
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password="";
                $database = "myshop";

                //create connection to database mysql
                $connection = new mysqli($servername, $username, $password, $database);

                //chack connection
                if($connection->connect_error){
                    die("connection failed:" .$connection->connect_error);
                }

                //otherwise read all rows from database table
                $sql= "SELECT * FROM clients";
                //this is the result of the query
                $result = $connection->query($sql);
         
                if(!$result){
                    die("Invalid query: " .$connection->error);
                }

                //otherwise 
                while($row = $result->fetch_assoc()){
                    //In a loop we will read the rows from the database and all the data of a row should be displayed in an HTML table
                    echo " <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a class= 'btn btn-primary btn-sm' href='/myshop/edit.php?id=$row[id]'>Edit</a>
                        <a class= 'btn btn-primary btn-sm' href='/myshop/delete.php?id=$row[id]'>Delete</a>
                    </td>
                </tr>";
                }
                ?>
               
            </tbody>
        </table>
    </div>
</body>
</html>