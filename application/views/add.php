<html>

<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/add.css'); ?>"">
    <script src="/shout/js/jquery-1.11.0.min.js"></script>
    <script src="/shout/js/add.js"></script>
</head>

<body>

<?php

if($data['BCK_PIC']==0) {

$bck=rand(1,6);
$image= base_url('images/background'.$bck.'.jpg');

}
else $image=base_url('images/upload/bckpic_'.$data['USER_ID'].'jpg');
?>

<div id="main" style="background-image: url('<?php echo $image;?>')">
    <div id="mainbox">
        <br>
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


                    <div id="addhobbies">

                        <div id="titles">Add a hobby</div >

                        <input type="text" id="addhobby" autocomplete="off" value="type here..."></input>

                        <div id="addhobbiessuggestions">

                            e.g. tennis, reading...


                        </div>


                    </div>

                    <div id="showhobbies">

                    <div id="titles_small">My hobbies </div>

                    </div>

                    <div id="addaboutmes">

                        <div id="titles">Say something about you</div>

                        <input type="text" id="addaboutme" autocomplete="off" value="type here..."></input>

                        <div id="addaboutmesuggestions">

                            e.g. great listener, always punctual...

                        </div>

                        <input id="addaboutmebutton" type="button" class="smallbutton"  value="Add"></input>

                    </div>

                    <div id="showaboutme">

                    <div id="titles_small">My personality </div>

                    </div>




                <div id="bckpic">

                        <div id="titles">Change background picture</div>


                        <form name="multiform" id="multiform" action="create/do_upload" method="POST" enctype="multipart/form-data">
                         (.jpg olny) <input type="file" name="userpic" />
                        </form>

                        <input type="button" id="multi-post" class="smallbutton" value="Upload"></input>

                        <div id="multi-msg"></div>



                    </div>

                <div id="usepic">


                    <input type="checkbox" id="checkusedefault" class="checkbox" value="1" <?php if ($data['BCK_PIC']==0) echo 'checked';?> > Use default backgrounds

                    <text id="settings"></text>

                </div>


                <div id="button">
                    <input id="submitprofile" class="button" type="button" value="Add">
                    <br>
                    <p id="cancelbutton"><a href="editprofile">Cancel</a></p>
                </div>







            </div>



        </div>
    </div>
</div>


</body>


</html>