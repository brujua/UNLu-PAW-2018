var VideoList = {

    flagRandom:false,
    flagBucle:false,
    currentIndex:0,
    videoSrcArr: [],

    init: function () {
        //recupero la lista de videos
        $('li').each(function () {
            VideoList.videoSrcArr.push($(this).find('input.vid-src').attr('value'));
        });
        //agrego el event-listener para detectar cuando termina un video
        $('#videoPlayer').on('ended',function () {
            VideoList.cambiar(true);
        });
        //agrego el event-listener para los botones flechitas
        $('#prev').on('click', function () {
            VideoList.cambiar(false);
        });
        $('#next').on('click', function () {
            VideoList.cambiar(true);
        });
        //agrego los event-listener para los checkbox random y bucle
        $('#random').on('change',function () {
            VideoList.flagRandom = $(this).is(':checked');
        });
        $('#loop').on('change',function () {
            VideoList.flagBucle = $(this).is(':checked');
        });
        // inicio en -1 y avanzo para arrancar en 0
        this.currentIndex=-1;
        this.cambiar(true);
    },

    /* -- cambia el video, forward es booleano que indica si se avanza o se retrocede --
    * -- la funcion tiene encuenta si estan prendidos los flags random y bucle --  */
    cambiar: function (forward) {
        //deselecciono el actual en la lista
        this.unselectAll();
        // si estamos en modo random
        if(this.flagRandom){
            this.seleccionar(this.randomIndex());
        } else {
            //si estoy en el ultimo
            if(this.currentIndex ===(this.videoSrcArr.length-1) && forward){
                //si es bucle vuelvo al primero, sino no hago nada
                if(this.flagBucle){
                    this.seleccionar(0);
                    console.log('pasamo')
                }
            } else {
                let nextIndex = forward ? this.currentIndex+1 : this.currentIndex-1;
                this.seleccionar(nextIndex);
            }

        }
    },

    seleccionar: function (index) {
        this.currentIndex=index;
        let src=this.videoSrcArr[index];
        let getVideo = document.getElementById('videoPlayer');
        let getSrc = document.getElementById('videoSource');
        //actualizo el video
        getSrc.setAttribute("src",src);
        getVideo.load();
        getVideo.play();
        getVideo.volume=0.5;

        //selecciono el item en la lista
        $('li').each(function () {
            if($(this).find('input.vid-src').attr('value')===src){
                $(this).attr('class','selected');
            }
        });
    },

    unselectAll: function () {
        $('li').each(function () {
            $(this).removeAttr('class');
        });
    },
    /* Devuelve un index random dentro los valores del array de src*/
    randomIndex: function () {
        return Math.floor(Math.random()*this.videoSrcArr.length);
    },
};
