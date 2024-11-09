<?php
    $this->load->view('paygateway/pay_conn');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AL-BARKAAT - Malik Muhammad Islam English School</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="<?php echo assets('bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <!-- Theme style -->
        <link href="<?php echo assets('dist/css/AdminLTE.min.css')?>" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins-->
        <link href="<?php echo assets('dist/css/skins/_all-skins.min.css')?>" rel="stylesheet" type="text/css" />
    </head>

    <body style="background-color: #ccc;">
<?php 
    switch ($respcode) {
        case "0" : $result = "Transaction Successful"; break;
        case "?" : $result = "Transaction status is unknown"; break;
        case "E" : $result = "Referred"; break;
        case "1" : $result = "Transaction Declined"; break;
        case "2" : $result = "Bank Declined Transaction"; break;
        case "3" : $result = "No Reply from Bank"; break;
        case "4" : $result = "Expired Card"; break;
        case "5" : $result = "Insufficient funds"; break;
        case "6" : $result = "Error Communicating with Bank"; break;
        case "7" : $result = "Payment Server detected an error"; break;
        case "8" : $result = "Transaction Type Not Supported"; break;
        case "9" : $result = "Bank declined transaction (Do not contact Bank)"; break;
        case "A" : $result = "Transaction Aborted"; break;
        case "B" : $result = "Fraud Risk Blocked"; break;
		    case "C" : $result = "Transaction Cancelled"; break;
        case "D" : $result = "Deferred transaction has been received and is awaiting processing"; break;
        case "E" : $result = "Transaction Declined - Refer to card issuer"; break;
		    case "F" : $result = "3D Secure Authentication failed"; break;
        case "I" : $result = "Card Security Code verification failed"; break;
        case "L" : $result = "Shopping Transaction Locked (Please try the transaction again later)"; break;
        case "M" : $result = "Transaction Submitted (No response from acquirer)"; break;
		    case "N" : $result = "Cardholder is not enrolled in Authentication scheme"; break;
        case "P" : $result = "Transaction has been received by the Payment Adaptor and is being processed"; break;
        case "R" : $result = "Transaction was not processed - Reached limit of retry attempts allowed"; break;
        case "S" : $result = "Duplicate SessionID (Amex Only)"; break;
        case "T" : $result = "Address Verification Failed"; break;
        case "U" : $result = "Card Security Code Failed"; break;
        case "V" : $result = "Address Verification and Card Security Code Failed"; break;
        default  : $result = "Unable to be determined"; 
    }

?>
<!-- First Container -->
<div class="container-fluid" style="padding-top: 10%;">
    <div class="row">
      <div class="col-xs-12">
        <p style="font-size: 18px;text-align: center;font-weight: bold;">Your application is submitted successfully, Incase of any findings school will update you on your registered mobile no/E-mail. </p>
        <p style="font-size: 18px;text-align: center;font-weight: bold;">Note: Please keep regular check on your registered mobile no for updates related to your application.</p>

      </div>
    </div>
    <br/>
    <div class="col-sm-4 col-sm-offset-4">
    <div class="panel panel-primary" style="border-color: #c9766e">
      <div class="panel-heading" style="background-color: #c9766e;border-color: #c9766e">
        <h4 class="text-center">Transaction Details</h4>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-6">
            <h5 style="font-weight: bold;">Application Id : </h5>
          </div>
          <div class="col-sm-6">
            <h5><?php echo $app_no?></h5>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <h5 style="font-weight: bold;">Candidate Name :</h5>
          </div>
          <div class="col-sm-6">
            <h5><?php echo $child_name?></h5>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <h5 style="font-weight: bold;">Unique Code :</h5>
          </div>
          <div class="col-sm-6">
            <h5><?php echo $barcode?></h5>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <h5 style="font-weight: bold;">Payment Status :</h5>
          </div>
          <div class="col-sm-6">
            <h5><?php echo $result?></h5>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-6">
            <?php if ($respcode != 0): ?>
              <a class="btn btn-primary" href="<?= base_url('chome/student_reg_form')."/".$user_id?>" style="background-color: #c9766e;border-color: #c9766e;width: 100%;">Go Back</a>
            <?php else: ?>
                <a class="btn btn-primary" href="<?= base_url('chome/print_application')."/".$user_id?>" target="_blank" style="background-color: #c9766e;border-color: #c9766e;width: 100%;">Download Appln Form</a>

            <?php endif ?>
          </div>
          <div class="col-sm-6">
              <a class="btn btn-warning" href="<?= base_url('clogin/logout')?>" style="width: 100%;">close</a>
            
          </div>
        </div>
      </div>
    </div>
      
    </div>

   <!--  <?php 
        if($respcode == "0"):
    ?>    
        <h1>Thank You, Vishal</h1>
        <h2 class="margin">Payment is successfull</h2>
        <h3>We will contact you </h3>
    <?php
        else:
    ?>
        <h1>Error : <?php echo $result?></h1>      
        <h3>Please try again later</h3>        
    <?php endif;?> -->
    
  
</div>


<!-- Footer -->
<!-- <footer class="container-fluid bg-4 text-center">
  <p><a class="btn btn-default" href="<?= base_url('chome/student_reg_form')."/".$user_id?>">Go Back</a></p> 
</footer> -->

</body>
</html>
