// JavaScript Document
var today = new Date();
var hourNow = today.getHours();
var greeting;
var el = document.getElementById('output');

if (hourNow > 18) {
	greeting = '<h4>Good Evening!</h4>';
} else if (hourNow > 12) {
	greeting = '<h2>Good Afternoon!</h2>';
} else if (hourNow > 0) {
	greeting = '<h3>Good Morning!</h3>';
} else {
	greeting = '<p>Welcome!</p>';
}

el.innerHTML = greeting;