<html>

<head>

    <script type="text/javascript" src="/shout/js/home.js"></script>
    <script type="text/javascript" src="/shout/js/viewprofile.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/home.css'); ?>">

         <!-- styles needed by jScrollPane -->
    <link rel="STYLESHEET" type="text/css" href="<?php echo base_url('css/jquery.jscrollpane.css'); ?>">
    <!-- latest jQuery direct from google's CDN -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- the mousewheel plugin - optional to provide mousewheel support -->
    <script type="text/javascript" src="/shout/js/jquery.mousewheel.js"></script>
    <!-- the jScrollPane script -->
    <script type="text/javascript" src="/shout/js/jquery.jscrollpane.min.js"></script>

    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>


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

        <div id="mainbox_contents">


            <br>

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
            <div id="newspanel">
                <div id="titles">News feed
                    <div id="select">

                        <input type="checkbox" id="chkmsg" class="checkbox" value="1" checked> Messages
                        <input type="checkbox" id="chkend" class="checkbox" value="2" checked> Endorsements

                    </div>

                </div>
                <div id="newsfeed">

                <br>

                <?php
/*
                $i=0;
                if ($events){
                foreach ($events as $event)
                {

                    $i++;
                    echo '<div id="event">';

                    if ($i%2==1)

                    {

                    echo '<div id="user_pic">';
                    echo '<img id="user_profile_pic" src="'.base_url('images/unknown.jpg').'"</img>';
                    echo '</div>';
                    echo '<div id="triangle1"></div>';
                    echo '<div id="event_desc1">';
                    echo '<div id="userid">'.$event['event_id'].'</div>';
                    switch ($event['event_type']) {
                            case 1:

                                if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b> endorsed you for a hobby</div>';
                                else  echo '<div id="event_detail"><b id="username">Someone (anonymous)</b> endorsed you for a hobby</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 2:
                                if($event['user_name_initiator'])  echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b> subscribed to a referral about you</div>';
                                else echo '<div id="event_detail"><b id="username">Someone (anonymous)</b> subscribed to a referral about you</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 3:
                                if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b> said you one of you hobbies is</div>';
                                else '<div id="event_detail"><b id="username">Someone (anonymous)</b> said you one of you hobbies is</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 4:
                                if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b>  said about you</div>';
                                else echo '<div id="event_detail"><b id="username">Someone (anonymous)</b>  said about you</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 5:
                                echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b>  sent you a message</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['message_status']==1) echo '<div id="status" class="status">Viewed</div>'; else echo '<div id="status" class="status">View message</div>';
                                break;
                            default:

                        }

                    }

                    else
                    {
                    echo '<div id="event_desc2">';
                    echo '<div id="userid">'.$event['event_id'].'</div>';
                    switch ($event['event_type']) {
                            case 1:
                                if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b> endorsed you for a hobby</div>';
                                else  echo '<div id="event_detail"><b id="username">Someone (anonymous)</b> endorsed you for a hobby</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 2:
                                if($event['user_name_initiator'])  echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b> subscribed to a referral about you</div>';
                                else echo '<div id="event_detail"><b id="username">Someone (anonymous)</b> subscribed to a referral about you</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 3:
                                if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b> said you one of you hobbies is</div>';
                                else '<div id="event_detail"><b id="username">Someone (anonymous)</b> said you one of you hobbies is</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 4:
                                if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b>  said about you</div>';
                                else echo '<div id="event_detail"><b id="username">Someone (anonymous)</b>  said about you</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 5:
                                echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b>  sent you a message</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['message_status']==1) echo '<div id="status" class="status">Viewed</div>'; else echo '<div id="status" class="status">View message</div>';
                                break;
                            default:

                        }

                    echo '</div>';
                    echo '<div id="triangle2"></div>';
                    echo '<div id="user_pic">';
                    echo '<img id="user_profile_pic" src="'.base_url('images/unknown.jpg').'"</img>';

                    }

                    echo '</div>';
                    echo '</div>';

                }
                }
*/
                ?>

            </div>
            </div>
            <div id="endorsement_panel">

                <div id="hobbieshome">
                    <div id="titles">My hobbies</div>

                    <br>

                <?php

                    for($i=0;$i<count($hobbies) && $i<4 ;$i++)
                {
                    $hobby=$hobbies[$i];
                    echo '<div id="hobbyhome">'.ucfirst($hobby['hobby']).'</div>';

                    echo '<div id="endorse_nr1home">';
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

                    echo '<div id="show_nr_endorsementhome">';
                    echo $hobby['endorsements'];
                    echo '</div>';

                    echo "<br>";
                    echo "<br>";
                    echo '<div id="detailshome">'.$hobby['details'].'</div>';
                    echo "<br>";
                    echo "<br>";
                }
                if (count($hobbies)>5) echo '<div id="view_hobbies" class="viewmore">View more</div>';
                ?>

            </div>

                <div id="aboutmehome">
                    <div id="titles">My personality</div>

<br>

                <?php
                for($i=0;$i<count($aboutme) && $i<4 ;$i++)
                {
                    $about=$aboutme[$i];
                    $rand=rand(1,4);
                    $circle= base_url('images/circle'.$rand.'.png');

                    echo '<div id="abouthome" style="background-image: url('.$circle.')">';
                    echo '<text id="whathome">'.ucfirst($about['aboutme']).'</text>';

                    echo '<div id="endorse_nr2home">';
                    echo $about['endorsements'];
                    echo '</div>';

                    if ($about['author']<>'you')
                    {
                        echo "<i>from </i>";
                        echo $about['author'];
                    }

                    echo '</div>';
                }
                if (count($aboutme)>4) echo '<div id="view_aboutme" class="viewmore">View more</div>';


                ?>


            </div>

            </div>

        </div>

    </div>
</div>

</body>


</html>