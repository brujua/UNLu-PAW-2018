var personalizer = {
    //Banderas para saber el estado de los elementos
    paleteDefault : true,
    infViewDefault : true,

    changeColorPalete: function () {
        if(this.paleteDefault){
            this.paleteDefault=false;
            $('body').css('background-color',"#808080");
            $('.linknav').css('background-color',"#808080");
            $('.linknav').css('color',"black");
            $('.sidenav').css('background-color',"#808080");
            $('header').css('color',"black");
            $('main').css('background',"white");
        } else {
            this.paleteDefault=true;
            $('body').css('background-color',"#0E0B16");
            $('.linknav').css('background-color',"#0E0B16");
            $('.linknav').css('color',"white");
            $('.sidenav').css('background-color',"#0E0B16");
            $('header').css('color',"aliceblue");
            $('main').css('background',"linear-gradient(141deg, #808080 0%, #8D8D8D 51%, #808080 75%)");
        }
    },

    changeInformationView: function () {
        let infBox = $('.imgBox');
        if(this.infViewDefault){
            this.infViewDefault=false;
            infBox.css('flex-direction','column');
            infBox.css('margin','auto');
            infBox.css('width','30%');
        } else {
            this.infViewDefault=true;
            infBox.css('flex-direction','row');
            infBox.css('width','100%');
        }
    },

};
