<html>

<head>
   <script src="/shout/js/create_profile.js"></script>
    <script src="/shout/js/jquery-1.11.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/create.css'); ?>"">
</head>

<body>



<div id="header">

    <div id="header_logo">
        <img src="<?php echo base_url('images/header_logo.jpg');?>">
    </div>
    <br>
    <div id ="motto">Discover valuable people. Easy.</div>
    <div id ="breadcrumb">1. Create a profile</div>
</div>

<?php $bck=rand(1,6);
$image= base_url('images/background'.$bck.'.jpg');
?>

<div id="main" style="background-image: url('<?php echo $image;?>')">
    <br>
    <br>
    <div id="mainbox">
        <br>
        <div id="loggedin">Logged in as <?php echo $data['USER_NAME'];?>.</div>
        <br>
        <br>
        <div id="mainbox_contents">

            <div id="profile_info">
                <img src="<?php echo $data['PIC_BIG'];?>"></img>
                <br>
                <h3><?php echo $data['USER_NAME'];?> </h3>
                <Br>
                <?php echo $data['USER_SEX'].', '.$data['RELATIONSHIP'];?>
                <br>
                <?php echo $data['FRIEND_COUNT'].' friends'; ?>
                <br>
                <?php echo $data['CURRENT_LOCATION']; ?>
                <br>
                <?php echo $data['CURRENT_EDUCATION']; ?>
                <br>
                <?php echo $data['CURRENT_WORK']; ?>
            </div>

            <div id="profile_form">
                <form action="create_profile/commit_form" id="create_profile" method="post">
                    <p>
                        <label for='passions'>Passions</label><br><br>
                        <input type="text" id="passions" name="passions" onkeyup="showHint(this.value)"/>
                        <input class="smallbutton" type="submit" name="submit" value="Add">
                    </p>

                    <p>My hobbies</p>

                    <p>
                        <label for='aboutme'>Say something about you</label><br><br>
                        <input type="text" id="aboutme" name="aboutme" ></input>
                        <input class="smallbutton" type="submit" name="submit" value="Add">
                    </p>

                    <p>My personality</p>

                    <p>
                        <label for='bckpic'>Background picture</label><br><br>
                        <input id="bckpic" type="file" name="pic" accept="image/*">

                    </p>

                </form>
            </div>


            <div id="button">
                <form action="preview" method="post">
                    <input class="button" type="submit" name="submit" value="Next">
                </form>
            </div>
        </div>
    </div>
</div>



<div id="footer">@2014. Webuildshout.com</div>


</body>


</html>