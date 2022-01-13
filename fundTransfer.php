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
              <a class="nav-link active" href="#">Transfer Fund</a>
            </li>
          </ul>

        </div>
      </nav>
    </div>

  </section>

  <section>
    <h1 class="cus-title">Transfer Funds</h1>

    <?php
    include 'config.php';
    $sql = "SELECT * FROM customers";
    $result = mysqli_query($conn,$sql);
    ?>

    <div class="container">
      <div class="row">
        <div class="col">
          <div class="table-responsive-sm">
            <table class="table table-bordered table-prop">
              <thead class="table-prop">
                <tr>
                  <th scope="col" class="text-center">S.NO.</th>
                  <th scope="col" class="text-center">NAME</th>
                  <th scope="col" class="text-center">EMAIL</th>
                  <th scope="col" class="text-center">BALANCE</th>
                  <th scope="col" class="text-center">ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                while($rows=mysqli_fetch_assoc($result)){
                  ?>
                  <tr class="table-prop">
                    <td><?php echo $rows['sno'] ?></td>
                    <td><?php echo $rows['name']?></td>
                    <td><?php echo $rows['email']?></td>
                    <td><?php echo "&#x20B9; ".$rows['balance']?></td>
                    <td><a href="fundToCustomer.php?id= <?php echo $rows['sno'] ;?>"> <button type="button" class="btn trans">Transfer</button></a></td>
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
