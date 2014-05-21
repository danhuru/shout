<!DOCTYPE html>
<html>


<head>
    <script src="js/fb_login.js" ></script>
    <script src="js/fb_load_sdk.js" ></script>
    <script src="js/fb_custom.js" ></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/login.css'); ?>"">
</head>
<body>


<div id="header">

    <div id="header_logo">
        <img src="<?php echo base_url('images/header_logo.jpg');?>">
    </div>
    <br>
    <div id ="motto">Discover valuable people. Easy.</div>
</div>


<?php $bck=rand(1,6);
$image= base_url('images/background'.$bck.'.jpg');
$textborder="";
if ($bck >= 4 && $bck <=6) $color="darkgreen";
if ($bck == 2) {$color="white"; $textborder="text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black";}
if ($bck == 1 || $bck == 3) $color="black";
?>

<div id="main" style="background-image: url('<?php echo $image;?>')">

    <br>
    <Br>

    <div id="mainbox">

        <br>

        <div id="mainbox_contents"">

        <div id="heading1" style="color:<?php echo $color;?>; <?php echo $textborder;?> "><strong>You have a business profile. But what about your hobbies?</strong></div>
        <br>
        <div id="heading2" style="color:<?php echo $color;?>; <?php echo $textborder;?> "><strong>Build your hobbies card in a couple of minutes!</strong></div>
        <br>
        <br>
        <br>

        <div id="step1">
            <p id="step">1</p>

            <p id="step_description"> Create a profile </p>

            <div class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="false" data-auto-logout-link="true"></div>

            <p id="step_details">    Login, add your hobbies, include some details </p>
        </div>
        <div id="arrow">
            <img id="arrowimg" width="50px" src="<?php echo base_url('images/arrow-black_50.png');?>"></div>
        <div id="step2">

            <p id="step">2</p>

            <p id="step_description"> Get endorsed by friends </p>

            <p id="step_details">  Invite friends to endorse you for your hobbies and personality </p>
        </div>

        <div id="arrow">
            <img id ="arrowimg" width="50px"  src="<?php echo base_url('images/arrow-black_50.png');?>"></div>
        <div id="step3">
            <p id="step">3</p>

            <p id="step_description"> Share it anywhere you want </p>

            <p id="step_details"> Link your profile in your CV, blog, social media accounts. Use it to find other people.  </p>

        </div>

    </div>

</div>

<div id="footer">@2014. Webuildshout.com</div>


</body>

</html>