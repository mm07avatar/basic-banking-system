<?php
  include 'config.php';

  if(isset($_POST['submit']))
  {
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from customers where sno=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from customers where sno=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    
    if (($amount)<0)
    {
      echo '<script type="text/javascript">';
      echo 'alert("Oops! Invalid Amount")';
    echo '</script>';  
  }


  

  else if($amount > $sql1['balance']) 
  {
    echo '<script type="text/javascript">';
    echo 'alert("Insufficient Balance")';
  echo '</script>';  
}



else if($amount == 0)
{
  echo '<script type="text/javascript">';
  echo 'alert("Zero Balance")';
echo '</script>';    
}


else {

  $newbalance = $sql1['balance'] - $amount;
  $sql = "UPDATE customers set balance=$newbalance where sno=$from";
  mysqli_query($conn,$sql);



  $newbalance = $sql2['balance'] + $amount;
  $sql = "UPDATE customers set balance=$newbalance where sno=$to";
  mysqli_query($conn,$sql);

  $sender = $sql1['name'];
  $receiver = $sql2['name'];
  $sql = "INSERT INTO translogs(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
  $query=mysqli_query($conn,$sql);

  if($query){
   echo "<script> alert('Transaction Successful');
   window.location='transLog.php';
 </script>";

}

$newbalance= 0;
$amount =0;
}

}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>MX Bank</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Ubuntu" rel="stylesheet">

  <!-- CSS Stylesheets -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <script defer src="https://use.fontawesome.com/releases/v5.3.0/js/all.js"></script>

  <!-- Bootstrap Scripts -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>

  <section class="colored-section" id="title">

    <div class="container-fluid">

      <!-- Nav Bar -->

      <nav class="navbar navbar-expand-lg navbar-dark">

        <a class="navbar-brand" href="index.html"><i class="fas fa-landmark bank-img"></i>MX Bank</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="customers.php">Customers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="transLog.php">Transaction Logs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="fundTransfer.php">Transfer Fund</a>
            </li>
          </ul>

        </div>
      </nav>
    </div>

  </section>

  <section>
    <h1 class="cus-title">Transaction</h1>

    <div class="container">
      <?php
        include 'config.php';
        $sid=$_GET['id'];
        $sql = "SELECT * FROM customers where sno=$sid";
        $result=mysqli_query($conn,$sql);
        if(!$result)
        {
          echo "Error : ".$sql."<br>".mysqli_error($conn);
        }
        $rows=mysqli_fetch_assoc($result);
      ?>
      <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
          <table class="table table-bordered table-prop">
            <tr class="table-prop">
              <th class="text-center">ACCOUNT NO.</th>
              <th class="text-center">NAME</th>
              <th class="text-center">EMAIL</th>
              <th class="text-center">BALANCE</th>
            </tr>
            <tr>
              <td class="py-2"><?php echo $rows['act_no'] ?></td>
              <td class="py-2"><?php echo $rows['name'] ?></td>
              <td class="py-2"><?php echo $rows['email'] ?></td>
              <td class="py-2"><?php echo "&#x20B9; ".$rows['balance'] ?></td>
            </tr>
          </table>
        </div>
        <br><br>

        <div class="row">
          <div class="col-6">
            <label class="transferTo"><b>Transfer To :</b></label>
            <select name="to" class="form-control" required>
              <option value="" disabled selected>Select</option>
              <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM customers where sno!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                  echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
                ?>
                <option class="table" value="<?php echo $rows['sno'];?>" >

                  <?php echo $rows['name'] ;?> (Account No: 
                  <?php echo $rows['act_no'] ;?> ) 

                </option>
                <?php 
                } 
              ?>
            </select>
          </div>

          <div class="col-6">
            <label class="amount"><b>Amount :</b></label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
          </div>
        </div>
        <div class="text-center">
          <button class="btn mt-3 transfer-btn" name="submit" type="submit" id="transfer">Transfer</button>
        </div>
      </form>
    </div>

  </section>


  <!-- Footer -->
  <hr>
  <footer class="white-section" id="footer">
    <div class="container-fluid">
      <i class="social-icon fab fa-facebook-f"></i>
      <i class="social-icon fab fa-twitter"></i>
      <i class="social-icon fab fa-instagram"></i>
      <i class="social-icon fas fa-envelope"></i>
      <p>© Copyright 2022 MX Bank</p>
    </div>
  </footer>


</body>

</html>
