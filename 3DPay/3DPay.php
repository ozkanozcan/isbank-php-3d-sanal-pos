<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>3D Pay Sample Page</title>
    <style type="text/css">
        body
        {
            border-style: none;
            color: #6B7983;
            font-family: Tahoma,Arial,Verdana,Sans-Serif;
            font-size: 12px;
            font-weight: normal;
        }
        
        tableClass
        {
            margin: 0;
        }
        td
        {
            color: #6B7983;
            font-family: Tahoma,Arial,Verdana,Sans-Serif;
            font-size: 12px;
            font-weight: normal;
            vertical-align: top;
            background: none repeat scroll 0 0 #FFFFFF;
            border-color: #C3CBD1;
            border-style: solid;
            border-width: 0 1px 1px 0;
            padding: 8px 20px;
        }
        h3
        {
            margin: 0px 0px 6px 0px;
            font-size: 14px;
            font-weight: bold;
            color: #518ccc;
        }
        h1
        {
            font-family: Calibri, Tahoma, Arial, Verdana, Sans-Serif;
            font-size: 24px;
            font-weight: normal;
            color: #51596a;
        }
        .buttonClass
        {
            background: none repeat scroll 0 0 #2B5576;
            border: 1px solid #346B96;
            color: #FFFFFF;
            font-size: 11px;
            font-weight: bold;
            padding: 1px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php

$clientId = "100200000";			//Merchant Id defined by bank to user
$amount = "9.95";					//Transaction amount
$oid = "";							//Order Id. Must be unique. If left blank, system will generate a unique one.

$okUrl = "http://localhost:88/3DPay/3DPayResultPage.php";		//URL which client be redirected if authentication is successful
$failUrl = "http://localhost:88/3DPay/3DPayResultPage.php";	//URL which client be redirected if authentication is not successful

$rnd = microtime();				//A random number, such as date/time
$currencyVal = "949";			//Currency code, 949 for TL, ISO_4217 standard
$storekey = "123456";			//Store key value, defined by bank.
$storetype = "3d_pay";			//3D authentication model
$lang = "en";					//Language parameter, "tr" for Turkish (default), "en" for English 
$instalment = "";				//Instalment count, if there's no instalment should left blank
$transactionType = "Auth";		//transaction type	

$hashstr = $clientId . $oid . $amount . $okUrl . $failUrl .$transactionType. $instalment .$rnd . $storekey;

$hash = base64_encode(pack('H*',sha1($hashstr)));

?>
    <form method="post" action="https://entegrasyon.asseco-see.com.tr/fim/est3Dgate">
    <center>
        <h1>
            3D Pay Sample Page</h1>
        <table class="tableClass">
            <tr class="trHeader">
                <td>
                    Credit Card Number:
                </td>
                <td>
                    <input type="text" name="pan" size="20" />
                </td>
            </tr>
            <tr>
                <td>
                    CVV Value:
                </td>
                <td>
                    <input type="text" name="cv2" size="4" value="" />
                </td>
            </tr>
            <tr>
                <td>
                    Expire Month:
                </td>
                <td>
                    <input type="text" name="Ecom_Payment_Card_ExpDate_Month" value="" />
                </td>
            </tr>
            <tr>
                <td>
                    Expire Year:
                </td>
                <td>
                    <input type="text" name="Ecom_Payment_Card_ExpDate_Year" value="" />
                </td>
            </tr>            
            <tr>
                <td>
                    Card Type:
                </td>
                <td>
                    <select name="cardType">
                        <option value="1">Visa</option>
                        <option value="2">MasterCard</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" value="Submit" class="buttonClass" />
                </td>
            </tr>
        </table>
        <input type="hidden" name="clientid" value="<?php echo $clientId; ?>" />
        <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
		<input type="hidden" name="islemtipi" value="<?php echo $transactionType; ?>" />
		<input type="hidden" name="taksit" value="<?php echo $instalment; ?>" />
        <input type="hidden" name="oid" value="<?php echo $oid; ?>" />
        <input type="hidden" name="okUrl" value="<?php echo $okUrl; ?>" />
        <input type="hidden" name="failUrl" value="<?php echo $failUrl; ?>" />
        <input type="hidden" name="rnd" value="<?php echo $rnd; ?>" />
        <input type="hidden" name="hash" value="<?php echo $hash; ?>" />
        <input type="hidden" name="storetype" value="<?php echo $storetype; ?>" />
        <input type="hidden" name="lang" value="<?php echo $lang; ?>" />
        <input type="hidden" name="currency" value="<?php echo $currencyVal; ?>" />
    </center>
    </form>
</body>
</html>
