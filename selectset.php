<html>

<head>
    <link href="lib/css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css/button.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="lib/jquery-3.2.0.min.js" type="text/javascript"></script>
</head>


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
                <div class="col-sm-2">
<!--                    <div id="my_bus" class="bus center-block"></div>-->
                </div>
                <div class="col-sm-8">
                    <div>
                        <h3>All Routes</h3>
                        <table class="table table-hover">
                            <tr>
                                <th>Bus ID</th>
                                <th>Total Seat</th>
                                <th>Type</th>
                                <th>Departure Date</th>
                                <th>Departure Time</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            include ('db.php');

                            $source = $_POST['source'];
                            $dest = $_POST['dest'];
                            $d_date = $_POST['date'];

                            $result = mysql_query("SELECT route_id FROM route WHERE source='$source' AND dest='$dest'");

                            while ($row = mysql_fetch_array($result))
                            {
                                $routeid = $row['route_id'];

                                $query = mysql_query("SELECT * FROM bus where dep_date = '$d_date' AND route_id = '$routeid'");
                                while ($rows = mysql_fetch_array($query))
                                {
                                    echo '<tr>';
                                    echo '<td>'.$rows['bus_id'].'</td>';
                                    echo '<td>'.$rows['seat_total'].'</td>';
                                    echo '<td>'.$rows['type'].'</td>';
                                    echo '<td>'.$rows['dep_date'].'</td>';
                                    echo '<td>'.$rows['dept_time'].'</td>';
                                    echo '<td><a href="seatreserve.php?id='.$rows['bus_id'].'&dep_date='.$rows['dep_date'].'">Proceed</a></td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="col-sm-2">

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
<!---->
<!--<script>-->
<!---->
<!--    // Already Reserved Seats-->
<!---->
<!--    var reservedseat = [12, 24, 36, 48];-->
<!---->
<!---->
<!--    // Selected seats array;-->
<!---->
<!--    var selectedSeat = [];-->
<!---->
<!---->
<!--    // Total bus very important object-->
<!---->
<!--    var bus = $('#my_bus');-->
<!---->
<!---->
<!--    // Initializing seats also checking reserved seat based on reservedseat array-->
<!---->
<!--    for (var x = 1; x <= 48; x++) {-->
<!--        var seatId = "seat" + x;-->
<!--        if (reservedseat.includes(x)) {-->
<!--            bus.append('<button id="' + seatId + '" class="seat sold_seat">' + x + '</button>');-->
<!--        } else {-->
<!--            bus.append('<button id="' + seatId + '" class="seat">' + x + '</button>');-->
<!--        }-->
<!--    }-->
<!---->
<!--    // seat click event listener-->
<!---->
<!--    bus.on('click', 'button', function (evt) {-->
<!--        var seat = $(this);-->
<!--        var seatNo = seat.html();-->
<!--        if (seat.hasClass('active_seat')) {-->
<!--            seat.removeClass('active_seat');-->
<!--            var pos = selectedSeat.indexOf(seatNo.toString());-->
<!--            selectedSeat.splice(pos, 1);-->
<!--        } else {-->
<!--            seat.addClass("active_seat");-->
<!--            selectedSeat.push(seatNo.toString());-->
<!--        }-->
<!--        $('#seats').val(selectedSeat.toString());-->
<!--    });-->
<!--</script>-->
<script src="lib/js/bootstrap.js"></script>
<!--<script src="seat.js"></script>-->
</html>
