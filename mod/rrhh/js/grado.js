document.getElementById('grupo').style.display='none';
document.getElementById('fecgra').style.display='none';
function ovit(b){
	if (b==1) {
		document.getElementById('grupo').style.display='inline-block';
		document.getElementById('fecgra').style.display='inline-block';
	}else{
		document.getElementById('grupo').style.display='none';
		document.getElementById('fecgra').style.display='none';
	}
}