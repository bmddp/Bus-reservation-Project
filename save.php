<?php
session_start();
include('db.php');
$busnum=$_POST['busnum'];
$setnum=$_POST['setnum'];
$date=$_POST['date'];

$userid = $_SESSION['SESS_ID'];

$selectedseat = explode(',', $setnum);

$n_seat = count($selectedseat);

$result = mysql_query("SELECT route_id, type, res_seat FROM bus where dep_date = '$date' AND bus_id = '$busnum'");


while ($row = mysql_fetch_array($result))
{
    $route = $row['route_id'];
    $bustype = $row['type'];
    $reserved = $row['res_seat'];
}

$all_reserved = $reserved.','.$setnum;


$price_query = mysql_query("Select price from price where route_id='$route' AND class='$bustype'");

while ($prow = mysql_fetch_array($price_query))
{
    $unitprice = $prow['price'];

}

$totalPrice = $n_seat * $unitprice;


mysql_query("INSERT INTO ticket (route_id, user_id, bus_id, dept_date, seats, total_price)
VALUES ('$route', '$userid', '$busnum', '$date', '$setnum', '$totalPrice')");

mysql_query("Update bus Set res_seat = '$all_reserved' Where bus_id='$busnum' and route_id='$route'");

//header("location: print.php?id=$confirmation&setnum=$setnum");
header("location: tickethistory.php");

?>
