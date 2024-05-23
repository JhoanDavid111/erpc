function ocultar(nu,alto){
	if(document.getElementById("inser")){
	    if(nu==1){
	    	document.getElementById("inser").style.display = "block";
	    	// document.getElementById("inser").style.position = "relative";
	     //    document.getElementById("inser").style.width = "100%";
	     //    document.getElementById("inser").style.height = alto;
	     //    document.getElementById("inser").style.transition = "all 1s";
	     //    document.getElementById("inser").style.opacity = "1";
	     //    document.getElementById("inser").style.left = "0px";
	        document.getElementById("ocu").style.display = "block";
	        document.getElementById("mos").style.display = "none";
	    }else{
	    	document.getElementById("inser").style.display = "none";
	    	// document.getElementById("inser").style.position = "absolute";
	    	// document.getElementById("inser").style.width = "0px";
	    	// document.getElementById("inser").style.height = "0px";
	    	// document.getElementById("inser").style.transition = "all 2s";
	    	// document.getElementById("inser").style.opacity = "0";
	    	// document.getElementById("inser").style.left = "-1000px";
	    	document.getElementById("ocu").style.display = "none";
	        document.getElementById("mos").style.display = "block";
	        window.scroll(0,0);
	    }
	}
}

function anonima(a){
    let txt;
    if(a==1) txt = "none"; else txt = "initial";
    for (var i=1; i <= 4; i++)
        document.getElementById("go"+i).style.display = txt;
    if(a==1)
    	document.getElementById("bals").disabled = true;
    else
    	document.getElementById("bals").disabled = false;
}
