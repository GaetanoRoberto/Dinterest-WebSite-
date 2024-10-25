var el = document.getElementById("err");

if(el.innerHTML!=""){
    document.getElementById("input_username").style.borderColor="red";
}

function checkPsw(element) {
	var stringa = element.value;

	if(stringa.length < 7){
		document.getElementById("lengthWarning").style.display = "block";
		var length = false;
	}
	else {
		document.getElementById("lengthWarning").style.display = "none";
		var length = true;
	}

	if(!isUpper(stringa)){
		document.getElementById("capsWarning").style.display = "block";
		var upper = false;
	}
	else {
		document.getElementById("capsWarning").style.display = "none";
		var upper = true;
	}

	if(stringa == ""){
		document.getElementById("checkEmpty").style.display = "block";
		var empty = false;
	}
	else{
		document.getElementById("checkEmpty").style.display = "none";
		var empty = true;
	}

	if(upper && length && empty){
		document.getElementById("input_password").style.borderColor= "green";

	} else {
		document.getElementById("input_password").style.borderColor= "red";
	}
}

function checkMail(element){
    var stringa = element.value;
    if(stringa!="")
        document.getElementById("input_email").style.borderColor="green";
    else
        document.getElementById("input_email").style.borderColor="red";
}

function validaModulo(modulo) {
	var pass = modulo.input_password.value;
	var repass = modulo.repeated_input.value;
	var user = modulo.input_username.value;
    var mail = modulo.input_email.value;
	if(pass.length >= 7 && isUpper(pass) && pass != "" && pass == repass && user.length>=6 && mail!="")
		return true;
	else
		return false;
}

function isUpper(str) {
	for(var i = 0; i<str.length; i++) {
		if (str.charAt(i) >= 'A' && str.charAt(i) <= 'Z')
			return true;
	}
	return false;
}

function checkUsn(usn) {
	var el = usn.value;

	if(el.length < 6){
		document.getElementById("input_username").style.borderColor = "red";
		document.getElementById("warningUser").style.display = "block";
	}
	else{
		document.getElementById("input_username").style.borderColor = "green";
		document.getElementById("warningUser").style.display = "none";
	}
}

function checkRepsw(psw) {

	var el = document.getElementById("input_password").value;

	if(el != psw.value){
		document.getElementById("checkRpwd").style.display = "block";
		document.getElementById("repeated_input").style.borderColor= "red";
	}
	else if(el == ""){
		document.getElementById("checkRpwd").style.display = "none";
		document.getElementById("repeated_input").style.borderColor= "white";
	}
	else{
		document.getElementById("checkRpwd").style.display = "none";
		document.getElementById("repeated_input").style.borderColor= "green";
	}

}

function checkTopic(){
    var group = document.getElementById("checkboxgroup").getElementsByTagName("input");
    var limit = 3;
    for(var i =0; i <group.length;i++){
        group[i].onclick=function(){
            var count=0;
            for(var i=0;i<group.length;i++){
                count+=(group[i].checked) ? 1:0;
            }
            if(count>limit){
                alert("Puoi selezionare solo " +limit+" topic");
                this.checked=false;
            }
        }
    }
}