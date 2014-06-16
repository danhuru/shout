<html>

<head>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/404.css'); ?>">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="/shout/js/popups_session.js"></script>

</head>

<body>

<?php

$bck=rand(1,6);
$image= base_url('images/background'.$bck.'.jpg');

?>

<div id="main" style="background-image: url('<?php echo $image;?>')">
    <div id="mainbox">
        <br>
        <br>

        <div id="showmessage" class="popup_endorse">

           We're sorry. It seems we're unable to find this page..


        </div>

    </div>
</div>


</body>


</html>