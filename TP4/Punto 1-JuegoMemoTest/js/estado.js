Estado = {
	nivel: null,
	cantidadJugadores: null,
	turno: null,
	puntajes: [],
	cartaInvertida: null,
	restantes: null,

	iniciarEstado : function(cantJugadores, nivel, tamaño){
		this.nivel = nivel;
		this.restantes = (tamaño*(tamaño+1))/2;
		this.cantidadJugadores = cantJugadores;
		this.turno = 0;
		for (var i = 0; i < this.cantidadJugadores; i++){
			this.puntajes[i] = 0;
		}
	},

	siguienteTurno: function(){
		this.turno =  (this.turno+1) % this.cantidadJugadores;
	},

	getGanador: function(){
		 aux = this.max(this.puntajes);
		 console.log(aux);
		 ganador =  this.puntajes.indexOf(aux);
		 console.log(ganador);
		 return (ganador+1);
	},

	max: function(values){
		max = 0;
		for(var i=0,len=values.length;i<len;i++){
    		if(max < values[i])
        		max = values[i];
    	}
    	return max;
	},

	siguienteNivel: function(){
		this.nivel++;
		nuevoTamaño = 2+this.nivel;
		this.restantes = (nuevoTamaño*(nuevoTamaño+1))/2;
	}

};
