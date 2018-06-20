document.addEventListener("DOMContentLoaded", function() {  
        
    testLinks();

    function testLinks() {         
        $('a').each(function(i)  {
            var url = $(this).attr('href');
            var element = $(this); 
            $.ajax({
                url: url, 
                type: 'get',
                method: 'head',
                error: function() {            
                    element.remove();
                },
                success: function() { 
                    element.addClass('link');
                }
            }); 
        });
    }   

});