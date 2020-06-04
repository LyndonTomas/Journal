<html>
    <head>
        <title>Update Entry</title>
        <link rel="icon" href="images/logo.png">
        <link rel="stylesheet" href="style.css">
        <!-- Boostrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- ckeditor -->
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
                <li class="breadcrumb-item active" aria-current="page"><a class="link" href="display.php">Entries</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Entry</li>
            </ol>
            </nav>
            <br>
        <center>
            <h2 class="page-title">Update Record</h2>
        </center>
        <!-- Update Mechanism -->
        <?php
    include('init.php');
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $guest_id = $_GET['id'];
        // echo "$guest_id";
        $statement = mysqli_prepare($conn, 'SELECT * FROM journal WHERE ID = ?');
        mysqli_stmt_bind_param($statement, 'i', $guest_id);
        if(mysqli_stmt_execute($statement)) {
            $result = mysqli_stmt_get_result($statement);
            $guest = mysqli_fetch_assoc($result);
        }
    }
        else{
            $guest_id = $_POST['id'];
            $title = $_POST['title'];
            $J_Entry = $_POST['Journal_Entry'];
            $statement = mysqli_prepare($conn, 'UPDATE journal SET title = ?, entry = ? WHERE id = ?');
            mysqli_stmt_bind_param($statement, 'ssi', $title, $J_Entry, $guest_id);
            if(mysqli_stmt_execute($statement)){
                header ('Location: display.php');
            }
            else{
                $error_message = "Guest update failed. Try again!";
            }
        }
        ?>

<div class="journal-entry"> <form action="journal-update.php" method="POST">
<input type="hidden" name="id" value="<?php echo $guest_id ?>">

    <!-- Title -->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Title:</span>
            </div>
                <input value="<?php echo $guest['title']?>" name="title" type="text" class="form-control" placeholder="Title of entry" aria-label="Username" aria-describedby="basic-addon1">
        </div>
    <!-- Journal Entry -->
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Journal Entry</span>
            </div>
                <textarea id="my_editor" value=""   name="Journal_Entry" class="form-control" aria-label="With textarea"><?php print $guest['entry']; ?></textarea>
                <!-- Script for texteditor here (CKEditor)-->
                <script>
                    CKEDITOR.replace('my_editor');
                </script>
            </div>
        <br>
        <button class="btn btn-primary btn-lg btn-block" type="submit" value="submit">UPDATE</button>
    </form>
    </div> 
    <br>
    <br>
</body>
</html>