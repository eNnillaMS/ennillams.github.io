//Simple Time of Day script to determine which theme I want to load.
var hour = new Date().getHours(), img, color;
if (hour >= 21 || hour < 3){
	img = 'themes/TOD/Night.jpg';
} else if (hour >= 3 && hour < 9){
	img = 'themes/TOD/Dawn.jpg';
} else if (hour >= 9 && hour < 15){
	img = 'themes/TOD/Day.jpg';
} else if (hour >= 15 && hour < 21){
	img = 'themes/TOD/Dusk.jpg';
}
var i = new Image();
i.onload = function(){
	var e = document.body;
	e.style.backgroundImage = 'url("' + img + '")';
};
i.src = img;