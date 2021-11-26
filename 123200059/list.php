<?php

session_start();

if(!isset($_SESSION["login"])){
    header("location: login.php");
    exit;
}

    include 'database.php';
    $data = query("SELECT * FROM inventory");
    $tot_inve = 0;
?>

<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Web Based Inventory Application</title>
  </head>
  <body>
    
  <footer class="bg-primary text-white">
    <div class="container">
      <div class="row pt-3">
        <div class="col text-center">
          <h1>LIST OF INVENTORY</h1>
          <h1>EVERYTHING OFFICE</h1>
        </div>
      </div>
    </div>
  </footer>
    
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="list.php">Inventory List</a>
        </li>
        <li class="nav-item dropdown">
                <div class="dropdown">
          <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          List per Category
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="list_category.php?category=Buildings">Buildings</a>
            <a class="dropdown-item" href="list_category.php?category=Vehicles">Vehicles</a>
            <a class="dropdown-item" href="list_category.php?category=Office%20Inventory">Office Inventory</a>
            <a class="dropdown-item" href="list_category.php?category=Electronic">Electronic</a>
          </div>
        </div>
        </li>
      </ul>
    </div>
    <a class="btn btn-primary fixed-right" href="logout.php" role="button">Logout</a>
  </div>
  </nav>


  <br>
  <a href="add.php" class="btn btn-primary">+Add</a>
  <div class="container" style="padding: 30px;">
    <table class="table table-striped" id="table">
        <thead>
            <tr>
                <th class="table-primary">No</th>
                <th class="table-primary">Code</th>
                <th class="table-primary">Name of goods</th>
                <th class="table-primary">Amount</th>
                <th class="table-primary">Unit</th>
                <th class="table-primary">Coming Date</th>
                <th class="table-primary">Category</th>
                <th class="table-primary">Status</th>
                <th class="table-primary">Unit Price</th>
                <th class="table-primary">Total Price</th>
                <th class="table-primary">Action</th>

            </tr>
        </thead>
            <?php $i = 1; ?>
            <tbody>
            <?php foreach( $data as $row) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row["item_id"] ?></td>
                <td><?= $row["item_name"] ?></td>
                <td><?= $row["amount"] ?></td>
                <td><?= $row["unit"] ?></td>
                <td><?= $row["arrival_date"] ?></td>
                <td><?= $row["category"] ?></td>
                <td><?= $row["item_status"] ?></td>
                <td><?php 
                        $number = $row["price"];
                        $price = number_format($number, 2, ',', '.');
                        echo "Rp. " . $price;?>
                </td>
                <?php
                    
                    $total = $row["price"] * $row["amount"];
                    $number = $total;
                    $pricepull = number_format($number, 2, ',', '.');
                    $tot_inve += $total;
                ?>
                <td>Rp. <?= $pricepull ?></td>

                <td><a href="delete.php?item_id=<?= $row['item_id'];?>" class="btn btn-primary">Delete</a> 
                <a href="edit.php?item_id=<?= $row['item_id'];?>" class="btn btn-primary">Edit</a></td>
            </tr>
            
            <?php $i++; ?>
            <?php endforeach; ?>
            
            </tbody>
        <br>
    </table>
    Total Inventory = Rp. 
                <?php
                  $number = $tot_inve;
                  $pricesopull = number_format($number, 2, ',', '.');
                ?>
                <?= $pricesopull ?>
    <br>
    <br>
    <br>
  </div>
    
 


  <footer class="bg-primary text-white">
    <div class="container">
      <div class="row pt-3">
        <div class="col text-center">
          <p>Inventory Web 2021</p>
        </div>
      </div>
    </div>
  </footer>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
   
  </body>
</html>