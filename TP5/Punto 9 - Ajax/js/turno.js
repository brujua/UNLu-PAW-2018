$(document).ready(function () {
    $('form#turno-form').submit( function (e) {
        e.preventDefault();
       console.log('algo anda');
        var postForm ={
            titulo:$('input[name=titulo]').val(),
            nombre:$('input[name=nombre]').val(),
            email:$('input[name=email]').val(),
            telefono:$('input[name=telefono]').val(),
            colorPelo:$('input[name=colorPelo]').val(),
            edad:$('input[name=edad]').val(),
            talle:$('input[name=talle]').val(),
            altura:$('select[name=altura]').val(),
            fecha_nacimiento:$('input[name=fecha_nacimiento]').val(),
            horario:$('select[name=horario]').val(),
        };

        $.ajax({
            url: "cargaTurno.php",
            type: "post",
            data: postForm,
            dataType:'json',
            success : function (data) {
                console.log(data);
                /*if(!data.nroTurno){
                    h3 = $('<h3>');
                    h3.text('Error en la carga de turno');
                    $('#system-msgs').append(h3);
                }
                else
                {*/
                    h3 = $('<h3>');
                    h3.text('Turno Cargado Exitosamente');
                    span = $('<span class="succes-msg"></span>');
                    span.text('Su Número de Turno es: '+data.nroTurno);
                    $('#system-msgs').append(h3,span);
                /*}*/
            }
        });



        /*console.log('se viene el ajax')
        $.ajax({
          dataType:"json",
           type:'post',
           url: 'cargaTurno.php',
           data:{
                titulo:$('input[name=titulo]').val(),
                nombre:$('input[name=nombre]').val(),
               email:$('input[name=email]').val(),
               telefono:$('input[name=telefono]').val(),
               colorPelo:$('input[name=colorPelo]').val(),
               edad:$('input[name=edad]').val(),
               talle:$('input[name=talle]').val(),
               altura:$('input[name=altura]').val(),
               fecha_nacimiento:$('input[name=fecha_nacimiento]').val(),
               horario:$('input[name=horario]').val(),
           }
        }).done(function (data) {
            console.log('done');
            /!*console.log(data);*!/
            let result = JSON.parse(data);
            h3 = $('<h3>');
            h3.text('Turno Cargado Exitosamente');
            span = $('<span class="succes-msg"></span>');
            span.text('Su Número de Turno es: '+result.nroTurno);
            $('#system-msgs').append(h3,span);
        });*/
    })

});
