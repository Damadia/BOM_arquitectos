// Main 

// Global variables

let logIn = false;

/* jquery interactive*/
$(document).ready(function(){
	logInController();
});



/* js functions */
function logInController()
{
	if (logIn)
		document.getElementsByClassName("logInBox")[0].children[1].innerText = "SALIR SESIÓN";
	else
		document.getElementsByClassName("logInBox")[0].children[1].innerText = "INICIAR SESIÓN";
}
