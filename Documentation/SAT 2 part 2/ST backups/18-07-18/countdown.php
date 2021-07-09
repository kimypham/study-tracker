<!-- Study Tracker - Count down timer, version 1.2, Kim Pham -->
<!-- Original base code from user Zen00 on Overclock.net (http://www.overclock.net/forum/143-web-coding/1354355-javascript-start-stop-pause-button-setinterval.html) -->

<audio id="beep" loop>
	<source src="./sounds/short-quick-ring.mp3" type="audio/mpeg">
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
		//document.getElementById("status").innerHTML = 'Timer has started'; // for developmental purposes
		document.getElementById("startstop").innerHTML = "Stop";
		document.getElementById("color").style.backgroundColor = "#C86F58";	// red
		started = 1;
		timer = setInterval(updateTimer, 1000);
	}
	else if(started == 1) {
		//document.getElementById("status").innerHTML = 'Timer has stopped';
        var endTime = Date.now();
        difference += (endTime - startTime)* 0.001;
		document.getElementById("output").value = difference;
		document.getElementById("startstop").innerHTML = "Resume";
		document.getElementById("color").style.backgroundColor = "#58C898"; // green
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
	}
	else if(started == 2) {
		resetTimer();
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
		<?php	
		if ($_SESSION['timerRing'] == 'on') {?>
			sound.play();
		<?php } ?>
		<?php	
		if ($_SESSION['timerNotif'] == 'on') {?>
			showNotification();
		<?php } ?>
		clearInterval(timer);
		//document.getElementById("status").innerHTML = 'Timer is finished!';
		document.getElementById("startstop").innerHTML = "Start over";
		var endTime = Date.now();
		difference += (endTime - startTime)* 0.001;
		//document.getElementById("output").innerHTML = 'Time between button press in seconds ' + difference;
		document.getElementById("output").value = difference;
		document.getElementById("color").style.backgroundColor = "#58C898"; // green
		started = 2;
	}
}

function resetTimer() {
	if (started == 1) {		// saves time if timer is running
		//document.getElementById("status").innerHTML = 'Timer has stopped';
		var endTime = Date.now();
		difference += (endTime - startTime)* 0.001;
		document.getElementById("output").value = difference;
	}
	document.getElementById("startstop").innerHTML = "Start";
	document.getElementById("color").style.backgroundColor = "#58C898"; // green
	clearInterval(timer);
	started = 0;
	hours = <?php echo $_SESSION['hours']?>;
	minutes = <?php echo $_SESSION['minutes']?>;
	seconds = 0;
	milliseconds = 0;
	started = 0;
	//difference = 0;
	document.getElementById("seconds").innerHTML = pad(seconds);
	document.getElementById("minutes").innerHTML = pad(minutes);
	document.getElementById("hours").innerHTML = pad(hours);
	//document.getElementById("output").value = 0;
	sound.pause();
}

// Timer notification function base code from David Walsh Blog (https://davidwalsh.name/notifications-api)
function showNotification() {
	if (window.Notification) {
		Notification.requestPermission(function(status) { 
			console.log('Status: ', status);
			var n = new Notification("Time's up", { body: "Remember to take frequent breaks!", icon:'./images/relax.png' }); 
			setTimeout(function(){ n.close() }, 5000);
			});
		} else {
			alert("Your browser doesn't support notifications.");
		}
	}
// Padding function from user Bakudan on StackOverflow (https://stackoverflow.com/questions/5517597/plain-count-up-timer-in-javascript)
function pad (val) {return val > 9 ? val : "0" + val;}
</script>