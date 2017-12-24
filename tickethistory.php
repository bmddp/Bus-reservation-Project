<?php
session_start();
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
                <div class="col-lg-12">
                    <div>
                        <h3>All Ticket</h3>
                        <table class="table table-hover">
                            <tr>
                                <th>Ticket ID</th>
                                <th>Route ID</th>
                                <th>User ID</th>
                                <th>Bus ID</th>
                                <th>Deperture Date</th>
                                <th>Seat</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            include 'db.php';
                            
                            $user_id = $_SESSION['SESS_ID'];

                            $results = mysql_query("SELECT * FROM ticket WHERE user_id='$user_id'");
                            while($rows = mysql_fetch_array($results))
                            {
                                echo '<tr>';
                                echo '<td>'.$rows['ticket_id'].'</td>';
                                echo '<td>'.$rows['route_id'].'</td>';
                                echo '<td>'.$rows['user_id'].'</td>';
                                echo '<td>'.$rows['bus_id'].'</td>';
                                echo '<td>'.$rows['dept_date'].'</td>';
                                echo '<td>'.$rows['seats'].'</td>';
                                echo '<td>'.$rows['total_price'].'</td>';
                                 echo '<td><a href="del_ticket.php?ticketid='.$rows['ticket_id'].'">Cancel</a></td>';
                                echo '</tr>';
                            }
                            ?>
                        </table>
                    </div>
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
