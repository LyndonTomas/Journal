<html>
<head>
<title>Journal Entries</title>
        <link rel="icon" href="images/logo.png">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- Fontawesome -->
        <script src="https://kit.fontawesome.com/23b708834a.js" crossorigin="anonymous"></script>
    </head>
<link rel="stylesheet" href="style.css">
<body>
    <!-- Search Mechanism -->
<nav class="navbar navbar-light bg-light">
        <form action="" class="form-inline" method="POST">
            <!-- Search -->
            <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
           
            <button class="btn btn-outline-success my-2 my-sm-0" value="submit" type="submit">Search</button> 

            <!-- Logout  -->
            <a class="btn btn-danger" id="logout" href="login_test.php">Logout</a>
        </form>
    </nav>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li  class="breadcrumb-item active" aria-current="page" ><a style="color:#007bff;"; href="display.php">Entries</a></li>
    <li class="breadcrumb-item active" aria-current="page">Text Result</li>
  </ol>
</nav>

    <br>
    <br>
    <center>
        <h2 class="page-title">
            <!-- Just to display the text being searched -->
            Text Result(s) for :  <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $search = $_POST['search'];
                echo $search;
            }
    ?>
        </h2>
    </center>
    <div class="entries">
        <!-- Display Entries from database that has the "text" being searched -->
<?php
    include('init.php');
    $sql = "SELECT * FROM journal WHERE entry  like '%".$search."%' || title like '%".$search."%' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)<= 0){
        echo "No entries found";
    }
    else{
        echo "<table>
            <th>Date & Time</th>
            <th>Title</th>
            <th>Entry</th>
            <th>Option</th>
        ";


        while($row = mysqli_fetch_assoc($result)){
            echo "<tr><td style='display:none;'>".$row["ID"]."</td><td>".$row["time_entry"]."</td>"
            
            ."<td>".$row["title"]."</td>"
            
            ."<td>".$row["entry"]."</td>".
            
            "<td>"."<a class='btn btn-success' href='journal-update.php?id=$row[ID]'>"."<i class='fas fa-edit'></i>"."</a>"

            ." <a class='btn btn-danger' href='delete-entry.php?id=$row[ID]'>"."<i class='fas fa-trash-alt'></i>"."</td>"."</a>";
        }
        echo "</table>";
    }
?>
<br>
<br>
<a href="journal.php" class="btn btn-primary btn-lg btn-block">Add New Entry</a>
    </div>
</body>
</html>