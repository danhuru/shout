<html>
<meta charset="UTF-8">
<head>

    <script src="/shout/js/invite.js" ></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/invitefriends.css'); ?>"">

</head>


<body onload="showResult('show_me_all')">

<?php $bck=rand(1,6);
$image= base_url('images/background'.$bck.'.jpg');
?>

<div id="main" style="background-image: url('<?php echo $image;?>')">
<div id="mainbox">

<br>
<div id="mainbox_contents">
<p id="step_description"> Invite your facebook friends to endorse you! </p>
<br>
<p id="filter"><label id="label">Filter by name: </label>
<input id="filter"type="text" size="150" onkeyup="showResult(this.value)"> </p>
<div id="showfriends">
<div id="showfriendsresults"></div>
</div>

</div>
 </div>
</div>



</body>

</html>

