<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="style.css">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="icon" href="images/logo.png">
    </head>

    <body>
        <br><br>
    <center>
        <h2 class="page-title">Lyndon's Journal</h2>
    </center>
        <br>
        <center>
            <!-- Log In -->
            <div class="log">
            <form method="POST" action="login_test.php">

                <h1 style="color:white;">Log In</h1>

            <!-- Username -->
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Username</span>
                    </div>
                    <input name="username" type="text" class="form-control" placeholder="username" aria-label="Username" aria-describedby="basic-addon1">
                </div>
        
                <br>
                <br>
            <!-- Password -->
            <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Password</span>
                    </div>
                    <input name="password" type="password" class="form-control" placeholder="password" aria-label="Username" aria-describedby="basic-addon1">
                </div>


                <br>
                <br>
                <?php
                include('init.php');
                
                    // Verification
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $password = $_POST['password'];
                        $PASS = false;
                        if(empty($password) || $password == ""){
                            echo "<p class='warning'>Password is a MUST</p>";
                        }
                        else{
                            $statement = "SELECT password FROM login";
                            $result = mysqli_query($conn, $statement);
                            while($row = mysqli_fetch_assoc($result)){
                                if($password == $row['password']){
                                    $PASS = true;
                                }
                            }
                            if($PASS == true){
                                header("Location: display.php");
                            }else if($PASS == false){
                                echo "<p class='warning'>Invalid password</p>";
                            }
                        }

                        
                    }

                ?>
                <!-- SUBMIT -->
            <button class="btn btn-primary btn-lg btn-block" type="submit" value="submit">Login</button>
            <br>
        </form>
            </div>
        </center>
        
    </body>
</html>