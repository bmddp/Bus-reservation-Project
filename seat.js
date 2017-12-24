/*
* Author: fahimshahrierrasel
* Date  : 01/04/2017
* Time  : 01:45:37 PM
* Path  : fahim/Desktop/seatbooking
*/

// Already Reserved Seats
var reservedseat = [12, 24, 36, 48];

// Selected seats array;
var selectedSeat = [];

// Temporay seat selection viwer;
var seatSelection = $('#seat_selection');

// Total bus very important object
var bus = $('#my_bus');

// Initializing seats also checking reserved seat based on reservedseat array
for (var x = 1; x <= 48; x++) {
    var seatId = "seat" + x;
    if (reservedseat.includes(x)) {
        bus.append('<button id="' + seatId + '" class="seat sold_seat">' + x + '</button>');
    } else {
        bus.append('<button id="' + seatId + '" class="seat">' + x + '</button>');
    }
}

// seat click event listener
$('#my_bus').on('click', 'button', function (evt) {
    var seat = $(this);
    var seatNo = seat.html();

    if (seat.hasClass('active_seat')) {
        seat.removeClass('active_seat');
        seatSelection.append(seatNo + ' is now deselected.<br>');
        var pos = selectedSeat.indexOf(seatNo.toString());
        selectedSeat.splice(pos, 1);
    } else {
        seat.addClass("active_seat");
        seatSelection.append(seatNo + ' is now selected.<br>');
        selectedSeat.push(seatNo.toString());
    }

});

// Submit button for seat planner
$('#submit').click(function () {
    seatSelection.text("This seats are selected: " + selectedSeat);
});
