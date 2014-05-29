<html>

<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/create.css'); ?>"">
    <script src="/shout/js/jquery-1.11.0.min.js"></script>
    <script src="/shout/js/create.js"></script>
</head>

<body>

<div id="jquerypopup">


</div>



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


                    <div id="addhobbies">

                        <div id="titles">Add a hobby *</div >

                        <input type="text" id="addhobby" autocomplete="off" value="type here..."></input>

                        <div id="addhobbiessuggestions">

                            e.g. tennis, reading...


                        </div>


                    </div>

                    <div id="showhobbies">

                    <div id="titles_small">My hobbies </div>

                    </div>

                    <div id="addaboutmes">

                        <div id="titles">Say something about you *</div>

                        <input type="text" id="addaboutme" autocomplete="off" value="type here..."></input>

                        <div id="addaboutmesuggestions">

                            e.g. great listener, always punctual...

                        </div>

                        <input id="addaboutmebutton" class="smallbutton"  value="Add"></input>

                    </div>

                    <div id="showaboutme">

                    <div id="titles_small">My personality </div>

                    </div>




                <div id="bckpic">

                        <div id="titles">Background picture (optional)</div>


                        <form name="multiform" id="multiform" action="do_upload" method="POST" enctype="multipart/form-data">
                         (.jpg olny) <input type="file" name="userpic" />
                        </form>

                        <input type="button" id="multi-post" class="smallbutton" value="Upload"></input>

                        <div id="multi-msg"></div>



                    </div>

                <div id="button">
                    <input id="formprofilebutton" class="button" type="button" value="Next">
                </div>

            </div>



        </div>
    </div>
</div>



<div id="footer">@2014. Webuildshout.com</div>


</body>


</html>