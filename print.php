
<?php
include('db.php');
$id=$_GET['id'];
$setnum=$_GET['setnum'];
$result = mysql_query("SELECT * FROM customer WHERE transactionum='$id'");
while($row = mysql_fetch_array($result))
	{
		$trasactionnum = $row['transactionum'];
		$name = $row['fname'].' '.$row['lname'];
		$address = $row['address'];
		$contact = $row['contact'];
		$total = $row['payable'];
	}
$results = mysql_query("SELECT * FROM reserve WHERE transactionnum='$id'");
while($rows = mysql_fetch_array($results))
	{
		$ggagaga=$rows['bus'];
		$resulta = mysql_query("SELECT * FROM route WHERE id='$ggagaga'");
		while($rowa = mysql_fetch_array($resulta))
			{
			$route = $rowa['route'];
			$class = $rowa['type'];
			$time=$rowa['time'];
            $perseat = $rowa['price'];
			}
		$dated = $rows['date'];
		
	}

?>
<link href="ticket.css"  rel="stylesheet" type="text/css" />
<div class="c-modal" id="ticket_content">
    <div id='left-popup' class="c-modal__content">
        <div id='hero-city' class="c-modal__hero">
            <h1><?php echo $name?></h1>
            <h2><?php echo $address.', '.$contact?></h2>
        </div>
        <div id='flight-details' class="c-flight-details">
            <div id='times'>
                <label>Route</label>
                <span><?php echo $route?></span>
                <br>
                <div id='departure-time'>
                    <label>Departure</label>
                    <p><?php echo $time?></p>
                </div>
                <div id='arrival-time'>
                    <label>Date</label>
                    <p><?php echo $dated?></p>
                </div>
            </div>
            <p><?php echo 'Transaction Number: '.$trasactionnum?></p>
        </div>
        <div id='ticket-details'>
            <div id='ticket-options'>
                <label>Class</label>
                <span id='ticket-class'><?php echo $class?></span>
                <label>Seat Numbers</label>
                <span id='ticket-amount'><?php echo $setnum?></span>
            </div>
            <div id='ticket-price'>
                <label>Price per person</label>
                <span id='price'><?php echo $perseat?></span>
                <label>Total price</label>
                <span id='total-price'><?php
                    $allseats = explode(",", $setnum);
                    echo $perseat*count($allseats)?></span>
            </div>
            <button onclick="window.print()">Print This Ticket</button>
        </div>
    </div>
</div>
<h1><a href="index.php" style="color: white">Home</a></h1>


