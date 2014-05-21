<html>

<head>

    <script type="text/javascript" src="/shout/js/home.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/home.css'); ?>">
         <!-- styles needed by jScrollPane -->
    <link rel="STYLESHEET" type="text/css" href="<?php echo base_url('css/jquery.jscrollpane.css'); ?>">
    <!-- latest jQuery direct from google's CDN -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- the mousewheel plugin - optional to provide mousewheel support -->
    <script type="text/javascript" src="/shout/js/jquery.mousewheel.js"></script>
    <!-- the jScrollPane script -->
    <script type="text/javascript" src="/shout/js/jquery.jscrollpane.min.js"></script>

    <script type="text/javascript" src="/shout/js/home.js"></script>

</head>

<body>

<?php $bck=rand(1,6);
$image= base_url('images/background'.$bck.'.jpg');
?>

<div id="main" style="background-image: url('<?php echo $image;?>')">

    <div id="mainbox">

        <!--    <div id="loggedin">Logged in as <?php echo $data[0]['name'];?>.</div> -->

        <div id="mainbox_contents">


            <br>

            <div id="profile_info">

                <img id="profile_pic" src="<?php echo $data[0]['pic_big'];?>"></img>
                <div id="profile_name"><?php echo $data[0]['name'];?>
                </div>
                <div id="profile_details">

                    <?php

                    if ($data[0]['sex']) echo ucfirst($data[0]['sex']);
                    if ($data[0]['relationship_status']) echo ', '.$data[0]['relationship_status'];
                    if ($data[0]['friend_count']) echo '<br>Has '.$data[0]['friend_count'].' friends';
                    if ($data[0]['current_location']['name']) echo '<br>Lives in '.$data[0]['current_location']['name'];
                    if (end($schools)) echo '<br>Studied at '.end($schools);
                    if ($data[0]['work'][0]['employer']['name']) echo '<br>Works at '.$data[0]['work'][0]['employer']['name'];

                    ?>

                </div>

            </div>
            <div id="newspanel">
                <div id="titles">News feed</div>
                <div id="newsfeed">
                <br>

                <?php

                $i=0;

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

                    switch ($event['event_type']) {
                            case 1:
                                echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b> endorsed you for a hobby</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status">Confirmed</div>'; else echo '<div id="status">Confirm/Dismiss</div>';
                                break;
                            case 2:
                                echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b> subscribed to a referral about you</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status">Confirmed</div>'; else echo '<div id="status">Confirm/Dismiss</div>';
                                break;
                            case 3:
                                echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b> said you one of you hobbies is</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status">Confirmed</div>'; else echo '<div id="status">Confirm/Dismiss</div>';
                                break;
                            case 4:
                                echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b>  said about you</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status">Confirmed</div>'; else echo '<div id="status">Confirm/Dismiss</div>';
                                break;
                            case 5:
                                echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b>  sent you a message</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['message_status']==1) echo '<div id="status">Viewed</div>'; else echo '<div id="status">View message</div>';
                                break;
                            default:

                        }

                    }

                    else
                    {
                    echo '<div id="event_desc2">';

                    switch ($event['event_type']) {
                            case 1:
                                echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b> endorsed you for a hobby</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status">Confirmed</div>'; else echo '<div id="status">Confirm/Dismiss</div>';
                                break;
                            case 2:
                                echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b> subscribed to a referral about you</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status">Confirmed</div>'; else echo '<div id="status">Confirm/Dismiss</div>';
                                break;
                            case 3:
                                echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b> said you one of you hobbies is</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status">Confirmed</div>'; else echo '<div id="status">Confirm/Dismiss</div>';
                                break;
                            case 4:
                                echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b>  said about you</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status">Confirmed</div>'; else echo '<div id="status">Confirm/Dismiss</div>';
                                break;
                            case 5:
                                echo '<div id="event_detail"><b id="username">'.$event['user_name_initiator'].'</b>  sent you a message</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['message_status']==1) echo '<div id="status">Viewed</div>'; else echo '<div id="status">View message</div>';
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


                ?>

            </div>
            </div>
            <div id="endorsement_panel">

                <div id="hobbies">
                    <div id="titles">My hobbies</div>

                    <br>

                <?php
                foreach ($hobbies as $hobby)
                {
                    echo '<div id="hobby">'.ucfirst($hobby['hobby']).'</div>';

                    echo '<div id="endorse_nr1">';

                    for ($i=1;$i<=$hobby['endorsements'];$i++)

                    {
                        echo '<img src='.base_url('images/endorse_nr.png').' width="25px" >';
                    }
                    echo '</div>';
                    echo '<div id="show_nr_endorsement">';
                    echo $hobby['endorsements'];
                    echo '</div>';
                    echo "<br>";
                    echo "<br>";
                }
                ?>

            </div>

                <div id="aboutme">
                    <div id="titles">My personality</div>

<br>

                <?php
                foreach ($aboutme as $about)
                {
                    $rand=rand(1,4);
                    $circle= base_url('images/circle'.$rand.'.png');

                    echo '<div id="about" style="background-image: url('.$circle.')">';
                    echo '<text id="what">"'.ucfirst($about['aboutme']).'"</text>';

                    echo '<div id="endorse_nr2">';
                    echo $about['endorsements'];
                    echo '</div>';
                    echo '</div>';
                }
                ?>


            </div>

            </div>

        </div>

    </div>
</div>

</body>


</html>