<html>
    <head>
        <title>My Journal</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function success(){
                alert("Your entry was stored in the database");
            }
        </script>
        <link rel="icon" href="images/logo.png">
        <script src="ckeditor/ckeditor.js"></script>
        
    </head>
    <body>
    
<nav class="navbar navbar-light bg-light">
        <form action="tsearch.php" class="form-inline" method="POST">
            <!-- Search -->
            <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
           
            <button class="btn btn-outline-success my-2 my-sm-0" value="submit" type="submit">Search</button> 

            <!-- Logout  -->
            <a class="btn btn-danger" id="logout" href="login_test.php">Logout</a>
        </form>
    </nav>
    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><a href="display.php">Entries</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add New Entry</li>
  </ol>
</nav>
    <br>
    <!-- Entry Being Added -->
    <div class="now">
    <?php
    include ("init.php");
    echo "<p>Journal Entry<br>";
    $date = date("m-d-Y");
    echo "$date</p>";
    ?>
    </div>
    <br>
    <center>
            <h2 class="page-title">New Entry</h2>
        </center>

    <div class="journal-entry"> <form action="journal.php" method="POST">
    <!-- Title -->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Title:</span>
            </div>
                <input value="" name="title" type="text" class="form-control" placeholder="Title of entry" aria-label="Username" aria-describedby="basic-addon1">
        </div>
    <!-- Journal Entry -->
        <center>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Journal Entry</span>
            </div>
                <textarea id="my_editor" placeholder="Journal Entry" value="" name="Journal_Entry" class="form-control ckeditor" aria-label="With textarea"></textarea>
                <!-- Script for texteditor here -->
                <script>
                    CKEDITOR.replace('my_editor');
                </script>
        </div>
        </center>
        <br>
        <button class="btn btn-primary btn-lg btn-block" type="submit" value="submit">SUBMIT</button>
        <!-- Placing the entry and title database -->
        <?php
            if($_SERVER['REQUEST_METHOD'] =='POST'){
                $title = $_POST['title'];
                $J_Entry = $_POST['Journal_Entry'];

                $statement = mysqli_prepare($conn, 'INSERT INTO journal (title, entry) VALUES (?, ?)');
                mysqli_stmT_bind_param($statement, 'ss', $title, $J_Entry);
                if(mysqli_stmt_execute($statement)){
                    echo '<script type="text/javascript">success();</script>';
                }
                else{
                    $error_message = "Guest login failed. Try again.";
                }
            }
        ?>
    </form>
    </div>

    <br>
    <br>
    <br>
    <br>
           
    </body>
</html>
