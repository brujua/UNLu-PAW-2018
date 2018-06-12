document.addEventListener("DOMContentLoaded", function() {	
	function getHora(){
		if (window.XMLHttpRequest) {
			// code for modern browsers
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
			      	document.getElementById('hora').innerHTML =xhttp.responseText;			      	
				}else if( this.status == 404){
					alert("Servidor no responde, Reintentando...");
					
				}					  
			}
			xhttp.open("GET", "model/getHora.php", true);
			xhttp.send();			   
		}else {
			// code for old IE browsers
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}				
	};

	setInterval(function() {
		getHora();
	}, 1000); 
	
});