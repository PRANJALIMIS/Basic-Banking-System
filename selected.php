<?php
include 'config.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Please enter positive value")';  // showing an alert box.
        echo '</script>';
    }


  
    // constraint to check insufficient balance.
    else if($amount > $sql1['balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Insufficient Balance!")';  // showing an alert box.
        echo '</script>';
    }
    


    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                // deducting amount from sender's account
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);
             

                // adding amount to reciever's account
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sender`, `reciever`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction is Successful');
                                     window.location='transaction.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
        <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="CSS/tables.css">
    <title>Easy Money Transfer</title>
    <style type="text/css">
    button {
        border: black;
        background: #d9d9d9;
    }

    button:hover {
        background-color: grey;
        transform: scale(1.1);
        color: white;
    }
    </style>
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
        <h2 class="text-center pt-4" style="color : black;">Easy Money Transfer</h2>
        <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  users where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
        <form method="post" name="tcredit" class="tabletext"><br>
            <div>
                <table class="table table table-light table-striped widt">
                    <tr>
                        <th class="text-center">Account No.</th>
                        <th class="text-center"> Name</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Balane(in Rs.)</th>
                    </tr>
                    <tr>
                        <td class="py-2 text-center"><?php echo $rows['id'] ?></td>
                        <td class="py-2 text-center"><?php echo $rows['name'] ?></td>
                        <td class="py-2 text-center"><?php echo $rows['email'] ?></td>
                        <td class="py-2 text-center"><?php echo $rows['balance'] ?></td>
                    </tr>
                </table>
            </div>
            <br><br><br>
            <label style="color : black;"><b>Transfer To:</b></label>
            <select name="to" class="form-control" required>
                <option value="" disabled selected>Choose account</option>
                <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM users where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>">

                    <?php echo $rows['name'] ;?> 
                    (Balance:<?php echo $rows['balance'] ;?> )

                </option>
                <?php 
                } 
            ?>
                <div>
            </select>
            <br>
            <br>
            <label style="color : black;"><b>Amount:</b></label>
            <input type="number" class="form-control" name="amount" required>
            <br><br>
            <div class="text-center">
                <button class="btn mt-3" name="submit" type="submit" id="myBtn" style="background-color :blue; padding: 10px; border-radius: 15px;">Transfer Money</button>
            </div>
        </form>
    </div>


  
</body>
</html>