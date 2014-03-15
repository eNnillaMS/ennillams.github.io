//Simple Time of Day script to determine which theme I want to load.
var day = new Date();
var hour = day.getHours();
var e = document.getElementById("_theme");
if (hour >= 21 || hour < 3) e.href = '_themes/Night.css';
else if (hour >= 3 && hour < 9) e.href = '_themes/Morning.css';
else if (hour >= 9 && hour < 15) e.href = '_themes/Day.css';
else if (hour >= 15 && hour < 21) e.href = '_themes/Dusk.css';