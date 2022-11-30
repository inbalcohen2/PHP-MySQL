<?php
//connect to the database
$servername = "localhost";
$username = "root";
$password="";
$database = "myshop";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$id="";
$name= "";
$email="";
$phone="";
$address="";

$errorMessage = "";
$successMessage = "";

//  check if received the request using the method GET / POST
if ( $_SERVER['REQUEST_METHOD'] == 'GET' ){
    // GET method :show the data of the client

    if( !isset($_GET["id"])){
        //If the client's ID does not exist, we will direct him to exit the execution of the file
        header("location: /myshop/index.php");
        exit;
    }
    //otherwise read the id of the clients from the request
      $id = $_GET["id"];
      //than read the data client from the database
      $sql="SELECT * FROM clients WHERE id=$id";
      //execute the query
      $result= $connection->query($sql);
      //read the customer's data from the database
      $row= $result->fetch_assoc();

      //If there is no data for that client,
      //refer the client to the index page 
      //and exit the execution of this file
      if(!$row){
        header("location: /myshop/index.php");
        exit;
      }
      //otherwise read the data from the data base
      //store the data from the database into these variables
      $name=$row["name"];
      $email=$row["email"];
      $phone=$row["phone"];
      $address=$row["address"];
}
    
else{
    //POST method: update the data of the client
    $id = $_POST["id"];
    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];
    
    //check there is no empty field
    do{
        if(empty($id) || empty($name)||empty($email)||empty($phone)||empty($address)){
            $errorMessage = "All the fields are required";
            break;
        }
        $sql= "UPDATE clients
              SET name='$name' , email='$email', phone='$phone', address='$address'
              WHERE id= $id";
    
        $result = $connection->query($sql);
 
        if(!$result){
            $errorMessage = "Invalid query: " .$connection->error;
            break;
        }
        $successMessage = "Client added corretctly";

        header("location: /myshop/index.php");
        exit;    
    }while(true);
   }
?>

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
        <h2>New Client</h2>

        <?php
        if( !empty($errorMessage)){
            echo"
            <div class='alert alert -warning alert-dismissble fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-lable='close'></button>
                </div>
                ";
        }
        ?>
        <form method="post">
           <input type= "hidden" name= "id" value="<?php echo $id; ?>"> 
           <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
          </div>  
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
          </div>  
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Phone</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
            </div>
          </div>  
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Address</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
            </div>
          </div> 
          
          <?php
          if( !empty($successMessage)){
            echo "
            <div class='row mb-3'>
                <div class='offset-sm-3 col-3 d-grid'>
                    <div class='alert alert -success alert-dismissble fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-lable='close'></button>
                    </div>
                </div>
            </div>
            ";
    } 
          ?>
          <div class="row mb-3">
            <div class="offset-sm-3 col-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">Cancel</a>
            </div>
          </div>
        </form>

    </div>
</body>
</html>