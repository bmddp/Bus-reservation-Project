<?php
$bus = $_GET['id'];
$dep_date = $_GET['dep_date'];
include ('db.php');

$result = $query = mysql_query("SELECT seat_total, res_seat FROM bus where dep_date = '$dep_date' AND bus_id = '$bus'");

while ($row = mysql_fetch_array($result))
{
    $total_seat = $row['seat_total'];
    $reserved = $row['res_seat'];
}

$reserved_seat = explode(',', $reserved);

?>
<html>
<head>
<link href="lib/css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />
<link href="lib/button.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery-3.2.0.min.js" type="text/javascript"></script>
<head>
        <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Logo</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="gallery.php">Gallery</a></li>
                        <li><a href="history.php">History</a></li>
                        <li><a href="routes.php">Routes</a></li>
                        <li><a href="location.php">location</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                    <!--                <ul class="nav navbar-nav navbar-right">-->
                    <!--                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>-->
                    <!--                </ul>-->
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div id="my_bus" class="bus center-block"></div>
                </div>
                <div class="col-sm-4">

                    <div id="stylized" class="myform">

                        <form id="form" name="form" action="save.php" method="post"  onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Bus Number</label>
                                <input type="text" class="form-control"  value="<?php
                                echo $bus ?>" name="busnum" readonly/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date</label>
                                <input type="text" class="form-control"  name="date" value="<?php
                                echo $dep_date ?>" readonly/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Seat Number</label>
                                <input type="text" class="form-control"  name="setnum"  id="seats" readonly/>
                            </div>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">

                </div>
            </div>
            <hr>
        </div>

        <footer class="container-fluid text-center">
            <h4>+01XXX-XXXXXX &bull; <a href="contact.php">Mirpur, Dhaka-1211</a></h4>
            <p>Hours of Operation&nbsp;&nbsp;&bull;&nbsp;&nbsp;Mon - Sun: 10:00 am - 12:00 am</p>
            <p>&copy; Copyright 2017 Simple Bus Reservation | All Rights Reserved <br /></p>
        </footer>

        </body>

<script>

    // Already Reserved Seats

    var reservedseat = [];
    <?php foreach($reserved_seat as $key => $val){ ?>
        reservedseat.push('<?php echo $val; ?>');
    <?php } ?>

    console.log(reservedseat.toString());

    // Selected seats array;

    var selectedSeat = [];


    // Total bus very important object

    var bus = $('#my_bus');


    // Initializing seats also checking reserved seat based on reservedseat array

    for (var x = 1; x <= 48; x++) {
        var seatId = "seat" + x;
        if (reservedseat.includes(x.toString())) {
            bus.append('<button id="' + seatId + '" class="seat sold_seat">' + x + '</button>');
        } else {
            bus.append('<button id="' + seatId + '" class="seat">' + x + '</button>');
        }
    }

    // seat click event listener

    bus.on('click', 'button', function (evt) {
        var seat = $(this);
        var seatNo = seat.html();
        if (seat.hasClass('active_seat')) {
            seat.removeClass('active_seat');
            var pos = selectedSeat.indexOf(seatNo.toString());
            selectedSeat.splice(pos, 1);
        } else {
            seat.addClass("active_seat");
            selectedSeat.push(seatNo.toString());
        }
        $('#seats').val(selectedSeat.toString());
    });
</script>
<script src="lib/js/bootstrap.js"></script>
</html>
