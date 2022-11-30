<?php
$servername = "localhost";
$username = "root";
$password="";
$database = "myshop";

//create connection
$connection = new mysqli($servername, $username, $password, $database);


$name= "";
$email="";
$phone="";
$address="";

$errorMessage = "";
$successMessage = "";


//the data that the server get from the html 
if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    //intialize 
    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];

    do{
        if(empty($name)||empty($email)||empty($phone)||empty($address)){
            $errorMessage = "All the fields are required";
            break;
        }
        //add a new client to database
        $sql= "INSERT INTO clients (name, email, phone, address) " .
                "VALUES ('$name', '$email', '$phone', '$address')";
    
        $result = $connection->query($sql);
 
        if(!$result){
            $errorMessage = "Invalid query: " .$connection->error;
            break;
        }


        $name= "";
        $email="";
        $phone="";
        $address="";

        $successMessage = "Client added corretctly";

        header("location: /myshop/index.php");
        exit;    

    } while(false);
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
    <script> src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"</script>
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