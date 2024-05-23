document.getElementById('libmil').style.display='none';
document.getElementById('tlib').style.display='none';
function adlibmil(a){
	if (a==1602) {
		document.getElementById('libmil').style.display='inline-block';
		document.getElementById('tlib').style.display='inline-block';
	}else{
		document.getElementById('libmil').style.display='none';
		document.getElementById('dismil').value = "0";
		document.getElementById('numlib').value = "0";
		document.getElementById('tlib').style.display='none';
	}
}