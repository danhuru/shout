<html>

<head>

    <script src="js/fb_login.js" ></script>
    <script src="js/fb_load_sdk.js" ></script>
    <script src="js/fb_custom.js" ></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/popups_session.css'); ?>">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="/shout/js/popups_session.js"></script>

</head>

<body>

<?php $bck=rand(1,6);
$image= base_url('images/background'.$bck.'.jpg');
?>

<div id="main" style="background-image: url('<?php echo $image;?>')">

<div id="popup_reconnecting" class="popup_endorse">

    <div id="current_url"><?php echo $current_url; ?></div>

    Your FB session has expired.
    We're redirecting you to your previous page...


</div>

</div>

</body>


</html>