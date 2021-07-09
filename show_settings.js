// Study Tracker - display relevant timer settings, version 1.3, Kim Pham

function show() {
	var countdown = document.getElementById("check");
	var settings = document.getElementById("settings");
	if (countdown.checked == true){
		settings.style.display = "block";
	} else {
		settings.style.display = "none";
	}
}