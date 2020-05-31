<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>3D Pay Hosting Result Page</title>
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
        .trHeader td
        {
            color: #FFA92D;
            font-weight: bold;
        }
        span
        {
            margin: 0px 0px 6px 0px;
            font-size: 14px;
            font-weight: bold;
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
    </style>
</head>
<body>
    <h1>
        3D Pay Hosting Result Page</h1>
    <table class="tableClass">
        <tr>
            <td>
                <h3>
                    3D Authentication Result:&nbsp;</h3>
            </td>
            <td>
                <span>
                    <?php
					
					$storekey="123456";
					
					$hashparams = $_POST["HASHPARAMS"];
					$hashparamsval = $_POST["HASHPARAMSVAL"];
					$hashparam = $_POST["HASH"];					
					$paramsval="";
					$index1=0;
					$index2=0;

					while($index1 < strlen($hashparams))
					{
						$index2 = strpos($hashparams,":",$index1);
						$vl = $_POST[substr($hashparams,$index1,$index2- $index1)];
						if($vl == null)
						$vl = "";
						$paramsval = $paramsval . $vl; 
						$index1 = $index2 + 1;
					}					
					$hashval = $paramsval.$storekey;

					$hash = base64_encode(pack('H*',sha1($hashval)));
					if ($hashparams != null)
					{
						if($paramsval != $hashparamsval || $hashparam != $hash) 	
						{
							echo "<font color=\"red\">Security warning. Hash values mismatch. </font>";
						}
						else
						{
							if($mdStatus =="1" || $mdStatus == "2" || $mdStatus == "3" || $mdStatus == "4")
							{ 	
								echo "<font color=\"green\">3D Authentication is successful. </font>";
							}
							else						
							{
								echo "<font color=\"red\">3D authentication unsuccesful. </font>";
							}
						}
					}
					else
					{
						echo "<font color=\"red\">Hash values error. Please check parameters posted to 3D secure page. </font>";
					}					
					?>
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <h3>
                    3D Parameters:</h3>
            </td>
        </tr>
        <tr class="trHeader">
            <td>
                <b>Parameter Name:</b>
            </td>
            <td>
                <b>Parameter Value:</b>
            </td>
        </tr>
		<?php
			foreach($_POST as $key => $value)
			{
				echo "<tr><td>".$key."</td><td>".$value."</td></tr>";
			}
		?>
    </table>
        <br />
        <br />
	 <h3>Payment Result</h3><br /><br />
	 <table class="tableClass">
	 <tr><td><h3> Payment Result:&nbsp;</h3></td><td><span>
	 <?php
		
		$mdStatus=$_POST['mdStatus'];       //Result of the 3D Secure authentication. 1,2,3,4 are successful; 5,6,7,8,9,0 are unsuccessful.
		
		if($mdStatus =="1" || $mdStatus == "2" || $mdStatus == "3" || $mdStatus == "4")
		{ 			   
		   $Response = $_POST["Response"];	
		   
		   if ( $Response == "Approved")
			{
				echo "<font color=\"green\">Your payment is approved.</font>";
			}
			else			
			{
				echo "<font color=\"red\">Your payment is not approved.</font>";
			}
		}	
		else
		{
			echo "<font color=\"red\">3D Authentication is not successful.</font>";
		}	
	 ?>
			</span>
		</td>
	</tr>	 
	<tr>
	 <tr> 
	<td><b>Parameter Name:</b></td> 
	<td><b>Parameter Value:</b></td> 
	</tr> 
	<?php
		$paymentParameters = array("AuthCode","Response","HostRefNum","ProcReturnCode","TransId","ErrMsg"); 
		for($i=0;$i<6;$i++)
		{
			$param = $paymentParameters[$i];
			echo "<tr><td>".$param."</td><td>".$_POST[$param]."</td></tr>";

		}
?>
	</table>   
</body>
</html>