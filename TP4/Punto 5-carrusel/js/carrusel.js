

	var clases = ['promo1', 'promo2', 'promo3'];
	var posicion = 0;
	function seguienteImagen(){
		let siguiente = (posicion + 1) % clases.length;
		if(siguiente==clases.length){
			siguiente = 0;
		}
		document.getElementById(clases[posicion]).setAttribute('class', 'oculto');
		document.getElementById(clases[siguiente]).setAttribute('class', 'visible');
		posicion = siguiente;
	}

	function anteriorImagen(){
		let anterior = (posicion - 1);
		if(anterior<0){
			anterior = clases.length - 1;
		}
		document.getElementById(clases[posicion]).setAttribute('class', 'oculto');
		document.getElementById(clases[anterior]).setAttribute('class', 'visible');
		posicion = anterior;
	}
	
	setInterval(function() {
		seguienteImagen();
	}, 3000);
	





