<html>
<meta charset="UTF-8">
<head>

    <script src="/shout/js/fb_login.js" ></script>
    <script src="/shout/js/fb_load_sdk.js" ></script>
    <script src="/shout/js/invite.js" ></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/invite.css'); ?>"">

</head>


<body onload="showResult('show_me_all')">

<div id="header">

    <div id="header_logo">
        <img src="<?php echo base_url('images/header_logo.jpg');?>">
    </div>
    <br>
    <div id ="motto">Discover valuable people. Easy.</div>
    <div id ="breadcrumb">2. Get endorsed by friends</div>
</div>

<?php $bck=rand(1,6);
$image= base_url('images/background'.$bck.'.jpg');
?>

<div id="main" style="background-image: url('<?php echo $image;?>')">
<br>
<br>
<div id="mainbox">
<br>
<div id="loggedin">Logged in as <?php echo $data[0]['name'];?>.</div>
<br>
<br>
<div id="mainbox_contents">
<p id="step_description"> Get endorsed by your facebook friends! </p>
<br>
<p id="filter"><label id="label">Filter by name:</label>
<input id="filter"type="text" size="30" onkeyup="showResult(this.value)"> </p>
<div id="showfriends">
<div id="showfriendsresults"></div>
</div>
<div id="button">
<form action="finish" method="post">
    <input class="button" type="submit" name="submit" value="Next">
</form>
</div>
</div>
 </div>
</div>



<div id="footer">@2014. Webuildshout.com</div>


</body>

</html>

