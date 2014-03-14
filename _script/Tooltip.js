//Simple Tooltip function to show a tooltip over certain objects.
//Objects must have the following events in their tags:
//    onmouseover='tooltip.pop(this, "TOOLTIP_TEXT_HERE")' onmouseleave='tooltip.hide()'
//where TOOLTIP_TEXT_HERE obviously gets replaced with whatever you want in the tooltip.
//You can also obviously store your text in a variable elsewhere, say in the header, or in an XML.
//Other than the minute styling handled here, appearance is all handled in 'core.css', under '#_tooltip'.
var tooltipHide, tooltipDie;
var tooltip = new function(){
	this.pop = function(target, text){
		e = document.getElementById("_tooltip");
		if (e == null){
			document.body.innerHTML += "<div id='_tooltip'>" + text + "</div>";
			e = document.getElementById("_tooltip");
		} else {
			clearTimeout(tooltipHide);
			clearTimeout(tooltipDie);
			tooltipHide = tooltipDie = null;
		}
		e.style.width = (e.offsetWidth - 20) + "px";
		e.style.top = target.offsetTop + "px";
		e.style.left = (((target.offsetWidth - e.offsetWidth) / 2) + target.offsetLeft) + "px";
		setTimeout( function(){
			if (tooltipHide == null){
				e.style.opacity = 1;
				e.style.top = (target.offsetTop + target.offsetHeight + 10) + "px";
			}
		}, 1000);
	};
	this.hide = function(){
		tooltipHide = setTimeout( function(){
			tt = document.getElementById("_tooltip")
			tt.style.opacity = 0;
			tooltipDie = setTimeout( function(){
				tt.remove();
				tooltipHide = tooltipDie = null;
			}, 1000);
		}, 1500);
	};
};
