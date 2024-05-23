document.getElementById('discap').style.display='none';
document.getElementById('discon').style.display='none';
function ovid(b){
	if (b==2) {
		document.getElementById('discap').style.display='inline-block';
		document.getElementById('discon').style.display='inline-block';
	}else{
		document.getElementById('discap').style.display='none';
		document.getElementById('discon').style.display='none';
	}
}