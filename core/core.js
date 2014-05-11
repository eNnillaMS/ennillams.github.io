window.onresize = function(){
	if (document.body != null){
		a = screen.width / screen.height;
		if (a < 1.6){
			document.body.style.backgroundSize = "auto 100%";
		} else {
			document.body.style.backgroundSize = "100% auto";
		}
	} else setTimeout(function() {window.onresize();}, 333);
}
window.onresize();

//Simple Tooltip function to show a tooltip over certain objects.
//Objects must have the following events in their tags:
//    onmouseover='tooltip.pop(this, "TOOLTIP_TEXT_HERE")' onmouseleave='tooltip.hide()'
//where TOOLTIP_TEXT_HERE obviously gets replaced with whatever you want in the tooltip.
//You can also obviously store your text in a variable elsewhere, say in the header, or in an XML.
//Other than the minute styling handled here, appearance is all handled in 'core.css', under '#_tooltip'.
var ttX = 0, ttY = 0, ttH, ttD, fadeIN = null;
setTimeout(function(){
	document.body.onmousemove = function(){
		ttX = event.clientX + 20;
		ttY = event.clientY + window.scrollY;
		tooltip.move();
	}
}, 500);
var tooltip = new function(){
	this.pop = function(text){
		e = document.getElementById("_tooltip");
		if (e == null){
			document.body.innerHTML += "<div id='_tooltip'>" + text + "</div>";
			e = document.getElementById("_tooltip");
		} else {
			clearTimeout(ttH);
			clearTimeout(ttD);
			clearTimeout(fadeIN);
			ttH = ttD = fadeIN = null;
		}
		e.style.top = ttY + "px";
		e.style.left = ttX + "px";
		if (fadeIN == null){
			fadeIN = setTimeout( function(){
				e.style.opacity = 1;
			}, 500);
		}
	}
	this.move = function(){
		e = document.getElementById("_tooltip");
		if (e != null){
			e.style.top = ttY + "px";
			e.style.left = ttX + "px";
		}
	}
	this.hide = function(){
		ttH = setTimeout( function(){
			tt = document.getElementById("_tooltip")
			tt.style.opacity = 0;
			ttD = setTimeout( function(){
				tt.remove();
				clearTimeout(ttH);
				clearTimeout(ttD);
				clearTimeout(fadeIN);
				ttH = ttD = fadeIN = null;
			}, 500);
		}, 500);
	};
};


//redPages is the handler for page changes. By calling the functions contained within, the page should fade out it's main
//panel, and then proceed to load other page pieces from the PHP/MySQL server at home so that we can continue to use
//GitHub's system to host my page and still have the security of a real webpage.
var xhr = new XMLHttpRequest();
var url = "http://206.116.115.47:8080/hexn/home.php";
xhr.open("POST", url, false);
xhr.send();
if (xhr.status != 200){
	url = "http://hexanet.info/fail.html";
	xhr.open("POST", url, false);
	xhr.send();
	document.body.innerHTML = xhr.response;
} else {
	var page = window.location.href;
	if (page.indexOf("#") != -1){
		var curr = page.substr(page.indexOf("#") + 1);
	} else {
		var curr = "home";
	}
	var redPages = new function(){
		this.NETERR = function(){
			url = "http://hexanet.info/fail.html";
			xhr.open("POST", url, false);
			xhr.send();
			document.body.innerHTML = xhr.response;
		}
		this.home = function(){
			var e = document.getElementById("page");
			e.style.opacity = 0;
			var xhr = new XMLHttpRequest();
			var url = "http://206.116.115.47:8080/hexn/home.php";
			xhr.open("POST", url, false);
			xhr.send();
			if (xhr.status == 200) e.innerHTML = xhr.response;
			else redPages.NETERR();
			e.style.opacity = 1;
			curr = "home";
		}
		this.projects = function(){
			var e = document.getElementById("page");
			e.style.opacity = 0;
			var xhr = new XMLHttpRequest();
			var url = "http://206.116.115.47:8080/hexn/projects.php";
			xhr.open("POST", url, false);
			xhr.send();
			if (xhr.status == 200) e.innerHTML = xhr.response;
			else redPages.NETERR();
			e.style.opacity = 1;
			curr = "projects";
		}
		this.forums = function(){
			var e = document.getElementById("page");
			e.style.opacity = 0;
			var xhr = new XMLHttpRequest();
			var url = "http://206.116.115.47:8080/hexn/forums.php";
			xhr.open("POST", url, false);
			xhr.send();
			if (xhr.status == 200) e.innerHTML = xhr.response;
			else redPages.NETERR();
			e.style.opacity = 1;
			curr = "forums";
		}
		this.chat = function(){
			var e = document.getElementById("page");
			e.style.opacity = 0;
			var xhr = new XMLHttpRequest();
			var url = "http://206.116.115.47:8080/hexn/chat.php";
			xhr.open("POST", url, false);
			xhr.send();
			if (xhr.status == 200) e.innerHTML = xhr.response;
			else redPages.NETERR();
			e.style.opacity = 1;
			curr = "chat";
		}
		if (curr == "home") redPages.home();
		else if (curr == "projects") redPages.projects();
		else if (curr == "forums") redPages.forums();
		else if (curr == "chat") redPages.chat();
	}
}