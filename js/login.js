window.onload = function(){
	var fm =document.getElementsByTagName('form')[0];
	var errNo = document.getElementById("errNo");
	fm.onsubmit = function(){
		if (fm.username.value.length <= 6||fm.password.value.length <= 6) {
			errNo.style.display = "block";
			return false;
		}
		else
		{
			errNo.style.display = "none";
		}
	}
}