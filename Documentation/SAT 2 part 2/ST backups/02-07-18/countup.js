// Study Tracker - Count down timer, version 1.2, Kim Pham
// Original base code from user Zen00 on Overclock.net (http://www.overclock.net/forum/143-web-coding/1354355-javascript-start-stop-pause-button-setinterval.html)

var hours = 0;
var minutes = 0;
var seconds = 0;
var milliseconds = 0;
var started = 0;
var difference = 0;

var on = 0;

function startTimer() {
	if (started == 0) {
		startTime = Date.now();
		//document.getElementById("status").innerHTML = 'Timer has started';
		document.getElementById("startstop").innerHTML = "Stop";
		document.getElementById("color").style.backgroundColor = "#C86F58";	// red
		started = 1;
		timer = setInterval(updateTimer, 1000);
	}
	else if(started == 1){
		//document.getElementById("status").innerHTML = 'Timer has stopped';
        var endTime = Date.now();
        difference += (endTime - startTime)* 0.001;
		document.getElementById("output").value = difference;
		document.getElementById("startstop").innerHTML = "Resume";
		document.getElementById("color").style.backgroundColor = "#58C898"; // green
		clearInterval(timer);
		started = 0;
		
		// milliseconds are used (but not shown to the user) to ensure accuracy of the timer if the buttons are rapidly pressed
		milliseconds = difference - seconds;
		if (milliseconds > 1){
			++seconds;
			document.getElementById("seconds").innerHTML = pad(seconds);
		}
		//document.getElementById("milliseconds").innerHTML = milliseconds;
	}
}

function updateTimer() {
	++seconds;
	document.getElementById("seconds").innerHTML = pad(seconds);
	if (seconds == 60){
		++minutes;
		document.getElementById("minutes").innerHTML = pad(minutes);
		seconds = 0;
		document.getElementById("seconds").innerHTML = pad(seconds);
	}
	if (minutes == 60){
		++hours;
		document.getElementById("hours").innerHTML = pad(hours);
		minutes = 0;
		document.getElementById("minutes").innerHTML = pad(minutes);
	}
}

function resetTimer() {
	if(started == 1) {
		//document.getElementById("status").innerHTML = 'Timer has stopped';
		var endTime = Date.now();
		difference += (endTime - startTime)* 0.001;
		//document.getElementById("output").innerHTML = 'Time between button press in seconds ' + difference;
		document.getElementById("output").value = difference;
	}
	document.getElementById("startstop").innerHTML = "Start";
	document.getElementById("color").style.backgroundColor = "#58C898"; // green
	clearInterval(timer);
	hours = 0;
	minutes = 0;
	seconds = 0;
	milliseconds = 0;
	started = 0;
	//difference = 0;
	document.getElementById("seconds").innerHTML = pad(seconds);
	document.getElementById("minutes").innerHTML = pad(minutes);
	document.getElementById("hours").innerHTML = pad(hours);
	//document.getElementById("output").value = 0;
}

// Padding function from user Bakudan on StackOverflow (https://stackoverflow.com/questions/5517597/plain-count-up-timer-in-javascript)
function pad (val) {return val > 9 ? val : "0" + val;}

function change_color() {
	if (on == 0) {
		
		on = 1;
	}
	else if(on == 1){
		
		on = 0;
	}
}