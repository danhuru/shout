<html>

<head>

    <script src="/shout/js/viewprofile.js" ></script>
    <script src="/shout/js/viewprofile_public.js" ></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/viewprofile_public.css'); ?>">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <script src="/shout/js/fb_load_sdk.js" ></script>
    <script src="/shout/js/session_login.js" ></script>

</head>

<body>

<?php $bck=rand(1,6);
$image= base_url('images/background'.$bck.'.jpg');
?>


<div id="main" style="background-image: url('<?php echo $image;?>')">



    <div id="mainbox">



        <div id="mainbox_contents">

            <br>
            <br>


            <div id="profile_info">

                <img id="profile_pic" src="<?php echo $data['PIC_BIG'];?>"</img>

                <div id="profile_name"><?php echo $data['USER_NAME'];?> </div>

                <div id="message_user">

                <div id="message_ico"> <img width="24px" height="24px" src="<?php echo base_url('images/message.png');?>"></img>
                </div>
                <div id="text_message">
                Message
                </div>

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

            <div id="hobbies">
                <div id="profile_name">My hobbies</div>

                <br>

                <?php

                for($i=0;$i<count($hobbies) && $i<5 ;$i++)

                {
                    $hobby=$hobbies[$i];
                    echo '<div>';
                    echo '<div id="hobby_id">'.$hobby['hobby_id'].'</div>';
                    echo '<div id="hobby">'.ucfirst($hobby['hobby']).'</div>';

                    echo '<div id="endorse_nr1">';
                    $j=1;
                    for ($j;$j<=$hobby['endorsements'] && $j<=5;$j++)

                    {
                        echo '<img src='.base_url('images/endorse_nr.png').' width="25px" >';
                    }

                    for ($j;$j<=5;$j++)

                    {
                        echo '<img src='.base_url('images/endorse_nr_grey.png').' width="25px" >';
                    }

                    echo '</div>';

                    echo '<div id="show_nr_endorsement">';
                    echo $hobby['endorsements'];
                    echo '</div>';
                    echo '<div id="endorse" class="endorse">';
                    echo '<img src='.base_url('images/bt_up.png').' width="25px" >';
                    echo '</div>';

                    echo "<br>";
                    echo "<br>";
                    echo '<div id="details">'.$hobby['details'].'</div>';
                    echo "<br>";
                    echo "<br>";
                    echo '</div>';
                }

                if (count($hobbies)>5) echo '<div id="view_hobbies" class="viewmore">View more</div>';

                ?>

            </div>

            <div id="aboutme">

                <div id="profile_name">My personality</div>

                <br>

                <?php

                for($i=0;$i<count($aboutme) && $i<4 ;$i++)
                {
                    $about=$aboutme[$i];
                    $rand=rand(1,4);
                    $circle= base_url('images/circle'.$rand.'.png');
                    $endorsement=base_url('images/endorse_nr.png');


                    echo '<div id="about">';
                    echo '<div id="aboutme_id">'.$about['aboutme_id'].'</div>';
                    echo '<div id="circle"> <img src="'.$circle.'" width="140px" ></div>';
                    echo '<div id="what">"'.ucfirst($about['aboutme']).'"</div>';
                    echo '<div id="img2"><img src="'.$endorsement.'" width="30px"></div>';
                    echo '<div id="endorse_nr2">';
                    echo $about['endorsements'];
                    echo '</div>';

                    echo '<div id="endorse2" class="endorse2"><img src='.base_url('images/bt_up.png').' width="25px" ></div>';

                    if ($about['author']<>'you')
                    {
                        echo '<div id="text">';
                        echo "<i>said </i>";
                        echo $about['author'];
                        echo '</div>';
                    }

                    echo '</div>';
                }


                if (count($aboutme)>4) echo '<div id="view_aboutme" class="viewmore">View more</div>';

                ?>


            </div>
        </div>



    </div>

</div>



</body>


</html>