<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/popups_loggedin.css'); ?>">

<script src="/shout/js/popups.js"></script>


<div id="overlay"></div>
<div id="popup_hobbies" class="popup">
    <?php
    for($i=0;$i<count($hobbies);$i++)

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

    ?>
</div>
<div id="popup_aboutme" class="popup">
    <?php

    for($i=0;$i<count($aboutme);$i++)
    {
        $about=$aboutme[$i];
        $rand=rand(1,4);
        $circle= base_url('images/circle'.$rand.'.png');
        $endorsement=base_url('images/endorse_nr.png');

        echo '<div id="about">';
        echo '<div id="aboutme_id">'.$about['aboutme_id'].'</div>';
        echo '<div id="circle"> <img src="'.$circle.'" width="140px" ></div>';
        echo '<div id="what">"'.ucfirst($about['aboutme']).'"</div>';
        echo '<div id="img2"><img src="'.$endorsement.'" width="40px"></div>';
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

    ?>

</div>
<div id="popup_message" class="popup_endorse">

 <div id="mainmessage">

     <div id="messsagetext">
         <textarea id="content">type message here...</textarea>
     </div>
     <div id="sendmessage">

         <button id="send" class="smallbutton">Send</button>

     </div>

 </div>

</div>
<div id="popup_already_endorsed" class="popup_endorse">

    You already endorsed this!

</div>
<div id="popup_endorse_success" class="popup_endorse">
</div>
<div id="popup_message_success" class="popup_endorse">
</div>
<div id="popup_add_hobby" class="popup">

    <div id="addhobbies">

        <div id="titles">Suggest a hobby to <?php echo $data['USER_NAME'];?></div >

        <input type="text" id="addhobby" autocomplete="off" value="type here..."></input>

        <div id="addhobbiessuggestions">

            e.g. tennis, reading...


        </div>


    </div>


    <div id="showhobbies"> </div>


    <div id="addaboutmes">

        <div id="titles">Say something about <?php echo $data['USER_NAME'];?> </div>

        <input type="text" id="addaboutme" autocomplete="off" value="type here..."></input>

        <div id="addaboutmesuggestions">

            e.g. great listener, always punctual...

        </div>

        <input id="addaboutmebutton" type="button" class="smallbutton"  value="Add"></input>

    </div>

    <div id="showaboutme">


    </div>

    <div id="button">
        <input id="submitprofile" class="smallbutton" type="button" value="Finish">
    </div>

</div>
