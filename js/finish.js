

$(function(){

          $('#next').click(function(){

            $.get("/shout/finish/set_page/",function(data,status)
            {
                window.location.href='home';
            });

        });

});