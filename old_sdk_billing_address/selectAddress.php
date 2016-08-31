<?php
require_once("lpa.config.php");

?>
<html>
	<head>
		<style type="text/css">
			
			#addressBookWidgetDiv{
				width: 400px; 
				height: 228px;
			}
		</style>
		
		<script type='text/javascript'>
		  window.onAmazonLoginReady = function() {
			amazon.Login.setClientId('<?php echo $clientId; ?>');
		  };
		</script>
		<script type='text/javascript' src='https://static-eu.payments-amazon.com/OffAmazonPayments/de/sandbox/lpa/js/Widgets.js'></script>

	</head>
	<body>
<?php
	if(isset($_GET['access_token'])){
		$accessToken = $_GET['access_token'];
?>
<textarea id="access_token" cols="250" rows="4" onClick="this.setSelectionRange(0, this.value.length)"></textarea>
<script type="text/javascript">
	document.getElementById("access_token").value = "<?php echo $accessToken; ?>";;
</script>
<br />
<div id="addressBookWidgetDiv">
</div> 
	<script>
	var oro = '';
		new OffAmazonPayments.Widgets.AddressBook({
		  sellerId: '<?php echo $merchantId; ?>',
		  onOrderReferenceCreate: function(orderReference) {
				   oro = orderReference.getAmazonOrderReferenceId();
		  },
		  onAddressSelect: function(orderReference) {
			console.log("onAddressSelected");
		  },
		  design: {
			 designMode: 'responsive'
		  },
		  onError: function(error) {
		   // your error handling code
		  }
		}).bind("addressBookWidgetDiv");
	</script>
	
	<a href="/old_sdk_billing_address/success.php?access_token=<?php echo $accessToken; ?>" onclick="location.href=this.href + '&oro=' + oro; return false;">weiter</a>
<?php
	
	}
?>
		
	</body>
</html>