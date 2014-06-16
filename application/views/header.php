<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/header.css'); ?>">
<script src="/shout/js/jquery-1.11.0.min.js"></script>
<script src="/shout/js/fb_load_sdk.js"></script>
<script src="/shout/js/topmenu.js"></script>

<div id="header">

    <div id="header_logo">
       <a href="/shout/home"> <img id="header_image" src="<?php echo base_url('images/header_logo2.jpg');?>"> </a>
    </div>
    <div id ="rightmenu">

        <a href="/shout/search"><img width=42px height=42px src="<?php echo base_url('images/search.jpg');?>"></img></a>
        <a href="/shout/home"><img width=42px height=42px src="<?php echo base_url('images/messages.jpg');?>"></img></a>
        <a href="/shout/home"><img width=42px height=42px src="<?php echo base_url('images/alert.jpg');?>"></img></a>
        <a href="/shout/invitefriends"><img width=42px height=42px src="<?php echo base_url('images/settings.jpg');?>"></img></a>

        <div id="messages"></div>
        <div id="alerts"></div>

    </div>
    <div id ="mainmenu">



        <a style="color:black;">

            <div id="pic_small">
                <img id="pic_small" src="<?php echo $data['PIC_SMALL'];?>">

                </img>

            </div>

            <div id="name_small">
                <?php echo $data['USER_NAME'];?>
            </div>

            <div id="dropdown">
                <img src="<?php echo base_url('images/dropdown.jpg');?>">
                </img>
            </div>
        </a>

        <div id="mainmenu_expanded">

            <div id="link" onclick="redirect('viewprofile')">View profile</div>
            <div id="link" onclick="redirect('editprofile')">Edit profile</div>
            <div id="link" onclick="logout()">Log Out</div>

        </div >


    </div>


</div>