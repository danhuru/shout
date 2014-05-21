<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/header.css'); ?>">
<script src="/shout/js/jquery-1.11.0.min.js"></script>
<script src="/shout/js/topmenu.js"></script>

<div id="header">

    <div id="header_logo">
       <a href="/shout/home"> <img id="header_image" src="<?php echo base_url('images/header_logo2.jpg');?>"> </a>
    </div>
    <div id ="rightmenu">

        <a href="search.php"><img width=42px height=42px onmouseover="icon_switch(this,'search_hover.jpg')" onmouseout="icon_switch(this,'search.jpg')" src="<?php echo base_url('images/search.jpg');?>"></img></a>
        <a href="search.php"><img width=42px height=42px onmouseover="icon_switch(this,'messages_hover.jpg')" onmouseout="icon_switch(this,'messages.jpg')" src="<?php echo base_url('images/messages.jpg');?>"></img></a>
        <a href="search.php"><img width=42px height=42px onmouseover="icon_switch(this,'alert_hover.jpg')" onmouseout="icon_switch(this,'alert.jpg')" src="<?php echo base_url('images/alert.jpg');?>"></img></a>
        <a href="search.php"><img width=42px height=42px onmouseover="icon_switch(this,'settings_hover.jpg')" onmouseout="icon_switch(this,'settings.jpg')" src="<?php echo base_url('images/settings.jpg');?>"></img></a>

    </div>
    <div id ="mainmenu" onclick="dropdown()">

        <a style="color:black;">

            <div id="pic_small">
                <img id="pic_small" src="<?php echo $data[0]['pic_small'];?>">

                </img>

            </div>

            <div id="name_small">
                <?php echo $data[0]['name'];?>
            </div>

            <div id="dropdown">
                <img src="<?php echo base_url('images/dropdown.jpg');?>">
                </img>
            </div>
        </a>

        <div id="mainmenu_expanded" onmouseout="dropdown_fade()">

            <div id="link" onmouseover="dropdown()" onclick="redirect('viewprofile')">View profile</div>
            <div id="link" onmouseover="dropdown()" onclick="redirect('editprofile')">Edit profile</div>

        </div >

    </div>


</div>