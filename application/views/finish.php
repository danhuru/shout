<html>
<meta charset="UTF-8">
<head>

    <script src="/shout/js/fb_login.js" ></script>
    <script src="/shout/js/fb_load_sdk.js" ></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/finish.css'); ?>"">
    <script src="/shout/js/finish.js" ></script>

</head>

<body>



<div id="header">

    <div id="header_logo">
        <img src="<?php echo base_url('images/header_logo.jpg');?>">
    </div>
    <br>
    <div id ="motto">Discover valuable people. Easy.</div>
    <div id ="breadcrumb">3. Share it</div>
</div>

<?php $bck=rand(1,6);
$image= base_url('images/background'.$bck.'.jpg');
?>

<div id="main" style="background-image: url('<?php echo $image;?>')">
    <br>
    <br>
    <div id="mainbox">
        <br>

        <br>
        <br>
        <div id="mainbox_contents">
            <p id="step_description"> Your profile is finished! </p>
            <br>
            <br>

            <div id="text_content">
            <p id="step_details">Here is the public link to your profile:

            <a href="<?php echo 'profile/'.$data['PROFILE_URL'];?>">shout/profile/<?php echo $data['PROFILE_URL'];?></a>

            </p>
            <p id="step_details">You can add the link on your CV, blog, social network profile or anywhere you want. </p>
            <p id="step_details">When your friends endorse you, you will receive alerts on your home page so that you can approve them. </p>
<br>
            <p id="step_details">Share these news on your preferred social network: </p>
            <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-type="button" data-width="50"></div>
            <div class="twitter-share-button"><a href="https://twitter.com/share" class="twitter-share-button" data-related="jasoncosta" data-lang="en" data-size="medium" data-count="none">Tweet</a></div>
            </div>


            <div id="button">

                    <input id="finish" class="button" type="button" name="submit" value="Finish" >

            </div>
        </div>
    </div>
</div>



<div id="footer">@2014. Webuildshout.com</div>


</body>
</html>