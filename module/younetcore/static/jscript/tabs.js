$(document).ready(function(){
	$(".menu > li").click(function(e){
		switch(e.target.id){
			case "yoursplugin":
				//change status & style menu
				$("#yoursplugin").addClass("active");
				$("#younetplugins").removeClass("active");
				$("#license").removeClass("active");
				//display selected division, hide others
				$("div.yoursplugin").fadeIn();
				$("div.younetplugins").css("display", "none");
				$("div.license").css("display", "none");
			break;
			case "younetplugins":
				//change status & style menu
				$("#yoursplugin").removeClass("active");
				$("#younetplugins").addClass("active");
				$("#license").removeClass("active");
				//display selected division, hide others
				$("div.younetplugins").fadeIn();
				$("div.yoursplugin").css("display", "none");
				$("div.license").css("display", "none");
			break;
			case "license":
				//change status & style menu
				$("#yoursplugin").removeClass("active");
				$("#younetplugins").removeClass("active");
				$("#license").addClass("active");
				//display selected division, hide others
				$("div.license").fadeIn();
				$("div.younetplugins").css("display", "none");
				$("div.yoursplugin").css("display", "none");
			break;
		}
		//alert(e.target.id);
		return false;
	});
});