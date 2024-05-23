document.getElementById('grpetn').style.display='none';
document.getElementById('tetn').style.display='none';
function ovit(b){
	if (b==1) {
		document.getElementById('grpetn').style.display='inline-block';
		document.getElementById('tetn').style.display='inline-block';
	}else{
		document.getElementById('grpetn').style.display='none';
		document.getElementById('tetn').style.display='none';
	}
}