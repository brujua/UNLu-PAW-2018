var console = console || {},
  document = document || {},

MemoTest = {
	cantidadMaxNiveles: 2,
	div: null,
	barraEstado: null,
	estado: null,

	start: function(contenedor)	{
		"use strict";
		this.div = document.getElementById(contenedor);
		this.menuPrincipal(this.div);
	},

	remove: function(div){
		while (div.firstChild) {
 		   div.removeChild(div.firstChild);
		}
	},

	menuPrincipal: function(div){
		MemoTest.remove(this.div);
		var p1 = document.createElement("h3"),
		tit1 = document.createTextNode("Un jugador");
		var p2 = document.createElement("h3"),
		tit2 = document.createTextNode("Dos Jugadores");
		p1.appendChild(tit1);
		p2.appendChild(tit2);

      	p1.addEventListener("click", function (event) {
      		MemoTest.iniciarUnjugador();
     	})
      	p2.addEventListener("click", function (event){
      		MemoTest.iniciarDosjugador();
      	})
      	div.appendChild(p1);
      	div.appendChild(p2);
	},

	iniciarUnjugador: function(){
		this.remove(this.div);
		Estado.iniciarEstado(1,1,3);
		this.estado = Estado;
		console.log(Estado);
		this.addTablero(this.div, 3);
		var p1 = document.createElement("div");
		this.barraEstado = p1;
		this.div.appendChild(p1);
		this.addBarraEstado();
	},


	iniciarDosjugador: function (){
		this.remove(this.div);
		Estado.iniciarEstado(2,1,3);
		this.estado = Estado;
		console.log(Estado);
		this.addTablero(this.div, 3);
		var p1 = document.createElement("div");
		this.barraEstado = p1;
		this.div.appendChild(p1);
		this.addBarraEstado();
	},

	addTablero: function (div, tamaño){
		var tb=document.createElement("table");
		var n = [];

		// Genero los numeros aleatorios
		// cantidad = tamaño * (tamaño+1) / 2
		for (var i = 0; i<(tamaño*(tamaño+1))/2; i++){
			num = Math.floor(Math.random()*100);
			n[i] = num;
			n[(tamaño*(tamaño+1))-i-1] = num;
		}

		//DESORDENO LOS NUMEROS
		for (var i=0; i<n.length;i++){
			//GENERO UN ENTERO ALEATORIO ENTRE i Y EL LARGO DEL VECTOR
			var ni = Math.floor(Math.random() * (n.length-i))+i;
			var aux = n[i];
			n[i] = n[ni];
			n[ni] = aux;
		}

		//CREO EL TABLERO
		indice = 0;
		for (var i = 0; i < tamaño; i++) {
			var tr=document.createElement("tr");
			for (var j = 0; j < tamaño+1; j++) {
				var td=document.createElement("td");
				td.innerHTML="?";
				td.setAttribute('data-num', n[indice]);
				indice++;
				td.addEventListener("click", function(event){
					MemoTest.invertirCarta();
				})
				tr.appendChild(td);
			}
			tb.appendChild(tr);
		}
		div.appendChild(tb);

	},

	addBarraEstado: function(){
		this.remove(this.barraEstado);
		var p1 = document.createElement("div");
		this.barraEstado = p1;
		this.div.appendChild(p1);
		var nivel = document.createElement("p");
		var t1 = document.createTextNode("Nivel: "+this.estado.nivel+"			Turno: Jugador "+(this.estado.turno+1));
		var punt = document.createElement("h4");
		var t2 = document.createTextNode("Puntajes");
		nivel.appendChild(t1);
		punt.appendChild(t2);
		this.barraEstado.appendChild(nivel);
		this.barraEstado.appendChild(punt);
		for (var i = 0; i<this.estado.cantidadJugadores;i++){
			var jug = document.createElement("p");
			var j1 = document.createTextNode("Jugador "+(i+1)+": "+this.estado.puntajes[i]);
			this.barraEstado.appendChild(j1);
		}
	},

	invertirCarta: function(){
		if (event.target.innerHTML=="?") {	//PREGUNTO SI LA CARTA ESTA INVERTIDA
			if (Estado.cartaInvertida==null){  //PREGUNTO SI YA HAY UNA CARTA INVERTIDA
				this.invertir(event.target);
				Estado.cartaInvertida = event.target;
			}else{
				if(Estado.cartaInvertida!==event.target){
					this.invertir(event.target);
					console.log(event.target);
					console.log(Estado.cartaInvertida);
					if(this.compararCartas(Estado.cartaInvertida, event.target)){
						Estado.puntajes[Estado.turno] = Estado.puntajes[Estado.turno] + 1;
						Estado.restantes--;
						Estado.cartaInvertida = null;
						console.log(Estado);
						if(Estado.restantes==0){
							if (Estado.nivel>=this.cantidadMaxNiveles){
								alert("El jugador "+Estado.getGanador()+" ha ganado");
								MemoTest.menuPrincipal(this.div);
							}else{
								Estado.siguienteNivel();
								console.log(Estado);
								this.remove(this.div);
								this.addTablero(this.div, 2+Estado.nivel);
								this.addBarraEstado();
							}
						}
					}else{
						var m = event.target;
						var m1 = Estado.cartaInvertida;
						setTimeout(function() {
							MemoTest.invertir(m);
							MemoTest.invertir(m1);
						},1000);
						Estado.cartaInvertida = null;

						console.log(Estado);
					}
					Estado.siguienteTurno();
					this.addBarraEstado();
				}
			}
		}
	},

	invertir: function(carta){
		var aux = carta.innerHTML;
		carta.innerHTML = carta.getAttribute("data-num");
		carta.setAttribute("data-num", aux);

	},

	compararCartas: function(carta1, carta2){
		if (carta1.innerHTML==carta2.innerHTML)
			return true;
		else
			return false;
	}
};
