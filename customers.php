<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    </style>
    <title>Customers</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">S.BANK</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="index.php" >Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="customers.php">Transfer Money</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="transaction.php">Transaction History</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="https://internship.thesparksfoundation.info/" >Contact Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php
    include 'config.php';
    $sql = "select * from users";
    $result = mysqli_query($conn,$sql);
?>




    <div class="container">
        <h2 class="text-center pt-4" > List of customer</h2>
        <br>
        <div class="row">
            <div class="col">
                <div class="table-responsive-sm">
                    <table class="table table  table-striped  large"
                       >
                        <thead >
                            <tr>
                                <th scope="col" class="text-center py-2">Account no.</th>
                                <th scope="col" class="text-center py-2">Name</th>
                                <th scope="col" class="text-center py-2">E-Mail</th>
                                <th scope="col" class="text-center py-2">Balance(in Rs.)</th>
                                <th scope="col" class="text-center py-2">Transfer</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                    while($rows=mysqli_fetch_assoc($result)){
                ?>
                            <tr >
                                <td class="py-2 text-center"><?php echo $rows['id'] ?></td>
                                <td class="py-2 text-center"><?php echo $rows['name']?></td>
                                <td class="py-2 text-center"><?php echo $rows['email']?></td>
                                <td class="py-2 text-center"><?php echo $rows['balance']?></td>
                                <td><a class="view " href="selected.php?id= <?php echo $rows['id'] ;?>" X>
                                    Transfer
                                </a></td>
                            </tr>
                            <?php
                    }
                ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   

  
</body>
</html>