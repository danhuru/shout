    $(function(){

        $('#next').click(function(){

            $.get("/shout/preview/set_page/",function(data,status)
            {
                window.location.href='invite';
            });

        });

    });