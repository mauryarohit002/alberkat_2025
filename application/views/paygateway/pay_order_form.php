
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head><title>Virtual Payment Client Example</title>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <style type='text/css'>
        H1       { font-family:Arial,sans-serif; font-size:20pt; color:#08185A; font-weight:600; margin-bottom:0.1em}
        H2       { font-family:Arial,sans-serif; font-size:14pt; color:#08185A; font-weight:100; margin-top:0.1em}
        H2.co    { font-family:Arial,sans-serif; font-size:24pt; color:#08185A; margin-top:0.1em; margin-bottom:0.1em; font-weight:100}
        H3.co    { font-family:Arial,sans-serif; font-size:16pt; color:#FFFFFF; margin-top:0.1em; margin-bottom:0.1em; font-weight:100}
        BODY     { font-family:Verdana,Arial,sans-serif; font-size:10pt; color:#08185A background-color:#FFFFFF }
        TR       { height:25px; }
        TR.shade { height:25px; background-color:#CED7EF }
        TR.title { height:25px; background-color:#0074C4 }
        TD       { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#08185A }
        P        { font-family:Verdana,Arial,sans-serif; font-size:10pt; color:#FFFFFF }
        P.blue   { font-family:Verdana,Arial,sans-serif; font-size:7pt;  color:#08185A }
        P.red    { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#FF0066 }
        P.green  { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#00AA00 }
        DIV.bl   { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#0074C4 }
        LI       { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#FF0066 }
        INPUT    { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#08185A; background-color:#CED7EF; font-weight:bold }
        SELECT   { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#08185A; background-color:#CED7EF; font-weight:bold }
        TEXTAREA { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#08185A; background-color:#CED7EF; font-weight:normal; scrollbar-arrow-color:#08185A; scrollbar-base-color:#CED7EF }
        A:link   { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#08185A }
        A:visited{ font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#08185A }
        A:hover  { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#FF0000 }
        A:active { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#FF0000 }
    </style>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<!-- start branding table -->
<!-- <table width='100%' border='2' cellpadding='2' bgcolor='#0074C4'>
    <tr>
        <td bgcolor='#CED7EF' width='90%'><h2 class='co'>&nbsp;MasterCard Virtual Payment Client Example</h2></td>
    </tr>
</table> -->
<!-- end branding table -->
<!-- <center><h2>Simply input those required fields to change the functionality.</h2></center> -->


<!-- The "Pay Now!" button submits the form and gives control to the form 'action' parameter -->
<form action="<?= base_url('chome/pay_form_action')?>" method="post" accept-charset="UTF-8" id="pay_order_form" hidden>
<input type="hidden" name="Title" value = "PHP VPC 3 Party Transacion">

<!-- get user input -->
<table width="80%" align="center" border="0" cellpadding='0' cellspacing='0'>

<tr class="shade">
    <td align="right"><strong><em>Virtual Payment Client URL:&nbsp;</em></strong></td>
    <td><input name="virtualPaymentClientURL" size="65" value="https://migs.mastercard.co.in/vpcpay" maxlength="250" readonly/></td>
</tr>
<tr><td colspan="2">&nbsp;<hr width="75%">&nbsp;</td></tr>
<tr class="title">
    <td colspan="2" height="25"><p><strong>&nbsp;Basic 3-Party Transaction Fields</strong></p></td>
</tr>
<tr>
    <td align="right"><strong><em> VPC Version: </em></strong></td>
    <td><input name="vpc_Version" value="1" size="20" maxlength="8" readonly/></td>
</tr>
<tr class="shade">
    <td align="right"><strong><em>Command Type: </em></strong></td>
    <td><input name="vpc_Command" value="pay" size="20" maxlength="16" readonly/></td>
</tr>
<tr>
    <td align="right"><strong><em>Merchant AccessCode: </em></strong></td>
    <td><input name="vpc_AccessCode" value="<?= $params['mer_acc_code']?>" size="20" maxlength="8" readonly/></td>
</tr>
<tr class="shade">
    <td align="right"><strong><em>Merchant Transaction Reference: </em></strong></td>
    <td><input name="vpc_MerchTxnRef" value="<?= $params['mer_trans_ref']?>" size="20" maxlength="40" readonly/></td>
</tr>
<tr>
    <td align="right"><strong><em>MerchantID: </em></strong></td>
    <td><input name="vpc_Merchant" value="<?= $params['mer_id']?>" size="20" maxlength="16" readonly/></td>
</tr>
<tr class="shade">
    <td align="right"><strong><em>Transaction OrderInfo: </em></strong></td>
    <td><input name="vpc_OrderInfo" value="<?= $params['order_no']?>" size="20" maxlength="34" readonly/></td>
</tr>
<tr>
    <td align="right"><strong><em>Purchase Amount: </em></strong></td>
    <td><input name="vpc_Amount" value="<?= $params['reg_amt']?>" maxlength="10" readonly/></td>
</tr>
<tr class="shade">
    <td align="right"><strong><em>Receipt ReturnURL: </em></strong></td>
    <td><input name="vpc_ReturnURL" size="65" value="<?= base_url('chome/recp_return_url')?>" maxlength="250" readonly/></td>
</tr>
<tr>
    <td align="right"><strong><em>Payment Server Display Language Locale: </em></strong></td>
    <td>
        <input name="vpc_Locale" value="en" maxlength="250" readonly/>
        <!-- <select name="vpc_Locale"><option SELECTED>en</option></select> -->
    </td>
</tr>
<tr class="shade">
    <td align="right"><strong><em>Currency: </em></strong></td>
    <td>
        <input name="vpc_Currency" value="INR" maxlength="250" readonly/>
        <!-- <select name="vpc_Currency"><option SELECTED>INR</option></select> -->
    </td>
</tr>

 <tr>    <td colspan="2">&nbsp;</td></tr>
<tr>
    <td>&nbsp;</td>
    <td><input type="submit" NAME="SubButL" value="Pay Now!"></td>
</tr>
<tr><td colspan="2">&nbsp;<hr width="75%">&nbsp;</td>
</tr>

<!-- <tr>
    <td colspan="2">
        <p class='blue'><strong><em><u>Note</u>:</em></strong><br/>
            Any information passed through the customer's browser
            can potentially be modified by the customer, or even by third parties to
            fraudulently alter the transaction data. Therefore all transactional
            information should <strong>not</strong> be passed through the browser in
            a way that could potentially be modified (e.g. hidden form fields).
            Transaction data should only be accepted once from a browser at the
            point of input, and then kept in a way that does not allow others
            to modify it (e.g. database, server session, etc.). Any transaction
            information displayed to a customer, such as amount, should be passed
            only as display information and the actual transactional data should be
            retrieved from the secure source last thing at the point of processing
        the transaction.</p>
       
    </td>
</tr> -->

<tr>
    <td width="40%">&nbsp;</td>
    <td width="60%">&nbsp;</td>
</tr>

</table>

</form>

<script>
  $(document).ready(function(){

  $("#pay_order_form").submit();
//   // location.href = base_url+"welcome/redir_url";
 });
</script>
</body>

<head>
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="0" />
</head>
</html>
