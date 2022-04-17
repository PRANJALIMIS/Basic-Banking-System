<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="CSS/tables.css">
    <title>Transactions</title>
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
            <a class="nav-link " href="https://www.thesparksfoundationsingapore.org/contact-us/" >Contact Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
   
  <div class="container">
        <h2 class="text-center pt-4" style="color :purple;">Transaction History</h2>

        <br>
        <div class="table-responsive-sm">
            <table class="table table  table-striped tble">
                <thead >
                    <tr>
                        <th class="text-center table-dark">Sr.No.</th>
                        <th class="text-center table-dark">Sender</th>
                        <th class="text-center table-dark">Reciever</th>
                        <th class="text-center table-dark">Amount</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php

            include 'config.php';

            $sql ="select * from transaction";

            $query =mysqli_query($conn, $sql);

            while($rows = mysqli_fetch_assoc($query))
            {
        ?>

                    <tr>
                        <td class="text-center table-light"><?php echo $rows['s.no']; ?></td>
                        <td class="text-center table-light"><?php echo $rows['sender']; ?></td>
                        <td class="text-center table-light"><?php echo $rows['reciever']; ?></td>
                        <td class="text-center table-light"><?php echo $rows['balance']; ?> </td>
                        

                        <?php
            }

        ?>
                </tbody>
            </table>

        </div>
    </div>

  
</body>
</html>
