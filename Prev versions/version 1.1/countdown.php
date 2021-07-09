<!-- Study Tracker - Count down timer, version 1.1, Kim Pham -->
<!-- Original base code from user Zen00 on Overclock.net (http://www.overclock.net/forum/143-web-coding/1354355-javascript-start-stop-pause-button-setinterval.html) -->

<audio id="beep">
	<source src="./sounds/beep.wav" type="audio/mpeg">
</audio>

<script>
var hours = <?php echo $_SESSION['hours']?>;
var minutes = <?php echo $_SESSION['minutes']?>;
var seconds = 0;
var milliseconds = 0;
var started = 0;
var difference = 0;

var sound = document.getElementById("beep");


function startTimer() {
	if (started == 0) {		// if timer is not running, start from the start
		startTime = Date.now();
		document.getElementById("status").innerHTML = 'Timer has started'; // for developmental purposes
		//document.getElementById("output").innerHTML = '';
		
		document.getElementById("startstop").innerHTML = "STOP";
		started = 1;
		timer = setInterval(updateTimer, 1000);
	}
	else {
		document.getElementById("status").innerHTML = 'Timer has stopped';
        var endTime = Date.now();
        difference += (endTime - startTime)* 0.001;
		//document.getElementById("output").innerHTML = 'Time between button press in seconds ' + difference;
		document.getElementById("output").value = difference;
		document.getElementById("startstop").innerHTML = "RESUME";
		clearInterval(timer);
		started = 0;
		
		// milliseconds are used (but not shown to the user) to ensure accuracy of the timer if the buttons are rapidly pressed
		milliseconds = difference - (60 - seconds);
		if (milliseconds < -1){		// for use if the seconds is 00
			milliseconds = milliseconds + 60;
		}
		if (milliseconds > 1){
			--seconds;
			document.getElementById("seconds").innerHTML = pad(seconds);
			if (seconds < 0){		// to prevent the seconds having a negative value
				--minutes;
				document.getElementById("minutes").innerHTML = pad(minutes);
				seconds = 59;
				document.getElementById("seconds").innerHTML = pad(seconds);
			}
		}
		//document.getElementById("milliseconds").innerHTML = milliseconds;
	}
}

function updateTimer() {
	--seconds;
	document.getElementById("seconds").innerHTML = pad(seconds);
	if (seconds < 0){
		--minutes;
		document.getElementById("minutes").innerHTML = pad(minutes);
		seconds = 59;
		document.getElementById("seconds").innerHTML = pad(seconds);
	}
	if (minutes < 0){
		--hours;
		document.getElementById("hours").innerHTML = pad(hours);
		minutes = 59;
		document.getElementById("minutes").innerHTML = pad(minutes);
	}
	
	// Timer runs out
	if (hours + minutes + seconds <= 0) {
		showNotification();
		clearInterval(timer);
		document.getElementById("status").innerHTML = 'Timer is finished!';
		var endTime = Date.now();
		difference += (endTime - startTime)* 0.001;
		//document.getElementById("output").innerHTML = 'Time between button press in seconds ' + difference;
		document.getElementById("output").value = difference;
	}
}

function resetTimer() {
	if (started == 1) {		// only runs if 
		document.getElementById("status").innerHTML = 'Timer has stopped';
		var endTime = Date.now();
		difference += (endTime - startTime)* 0.001;
		//document.getElementById("output").innerHTML = 'Time between button press in seconds ' + difference;
		document.getElementById("output").value = difference;
	}
	document.getElementById("startstop").innerHTML = "START";
	clearInterval(timer);
	started = 0;
	hours = <?php echo $_SESSION['hours']?>;
	minutes = <?php echo $_SESSION['minutes']?>;
	seconds = 0;
	milliseconds = 0;
	started = 0;
	difference = 0;
	document.getElementById("seconds").innerHTML = pad(seconds);
	document.getElementById("minutes").innerHTML = pad(minutes);
	document.getElementById("hours").innerHTML = pad(hours);
	document.getElementById("output").value = 0;
}

// Timer notification function base code from David Walsh Blog (https://davidwalsh.name/notifications-api)
function showNotification() {
	if (window.Notification) {
		Notification.requestPermission(function(status) { 
			console.log('Status: ', status);
			var n = new Notification("Time's up", { body: "Remember to take frequent breaks!", icon:'./images/relax.png' }); 
			sound.play();
			setTimeout(function(){ n.close() }, 7000);
			});
		} else {
			alert("Your browser doesn't support notifications.");
		}
	}

// Padding function from user Bakudan on StackOverflow (https://stackoverflow.com/questions/5517597/plain-count-up-timer-in-javascript)
function pad (val) {return val > 9 ? val : "0" + val;}
</script>