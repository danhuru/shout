<html>

<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/create.css'); ?>"">
    <script src="/shout/js/jquery-1.11.0.min.js"></script>
    <script src="/shout/js/create.js"></script>
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
           <div id="mainbox_contents">

            <div id="profile_info">

                <img id="profile_pic" src="<?php echo $data['PIC_BIG'];?>"></img>
                <div id="profile_name"><?php echo $data['USER_NAME'];?>
                </div>
                <div id="profile_details">

                <?php

                if ($data['USER_SEX']) echo ucfirst($data['USER_SEX']);
                if ($data['RELATIONSHIP']) echo ', '.$data['RELATIONSHIP'];
                if ($data['FRIEND_COUNT']) echo '<br>Has '.$data['FRIEND_COUNT'].' friends';
                if ($data['CURRENT_LOCATION']) echo '<br>Lives in '.$data['CURRENT_LOCATION'];
                if ($data['CURRENT_EDUCATION']) echo '<br>Studied at '.$data['CURRENT_EDUCATION'];
                if ($data['CURRENT_WORK']) echo '<br>Works at '.$data['CURRENT_WORK'];

                ?>
                </div>

            </div>

            <div id="profile_form">
                <form action="create_profile/commit_form" id="create_profile" method="post">

                    <div id="addhobbies">

                        <label>Add a hobby</label>
                        <br><br>
                        <input type="text" id="addhobby"></input>


                        <div id="addhobbiessuggestions">

                         e.g. tennis, reading...

                        </div >


                        <input class="smallbutton" type="submit" name="submit" value="Add">



                    </div>



                    <div id="showhobbies">

                    <p>My hobbies</p>

                    </div>

                    <div id="addaboutmes">

                        <label>Say something about you</label>
                        <br><br>
                        <input type="text" id="addaboutme" />
                        <input class="smallbutton" type="submit" name="submit" value="Add">

                    </div>

                    <div id="showaboutme">

                    <p>My personality</p>

                    </div>

                    <div id="bckpic">

                        <label>Background picture</label><br><br>
                        <input id="bckpic" type="file" name="pic" accept="image/*">

                    </div>

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