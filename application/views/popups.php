<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/popups.css'); ?>">
<script src="/shout/js/popups.js"></script>


<div id="overlay"></div>
<div id="popup_hobbies" class="popup">
    <?php
    foreach ($hobbies as $hobby)
    {
        echo '<div id="pop_hobby">'.ucfirst($hobby['hobby']).'</div>';

        echo '<div id="pop_endorse_nr1">';

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

        echo '<div id="pop_show_nr_endorsement">';
        echo $hobby['endorsements'];
        echo '</div>';

        echo "<br>";
        echo "<br>";
        echo '<div id="pop_details">'.$hobby['details'].'</div>';
        echo "<br>";
        echo "<br>";
    }
    ?>
</div>
<div id="popup_aboutme" class="popup">
    <?php
    foreach ($aboutme as $about)
    {
        $rand=rand(1,4);
        $circle= base_url('images/circle'.$rand.'.png');

        echo '<div id="pop_about" style="background-image: url('.$circle.')">';
        echo '<text id="pop_what">"'.ucfirst($about['aboutme']).'"</text>';

        echo '<div id="pop_endorse_nr2">';
        echo $about['endorsements'];
        echo '</div>';

        if ($about['author']<>'you')
        {
            echo "<i>from </i>";
            echo $about['author'];
        }

        echo '</div>';
    }
    ?>

</div>
<div id="popup_endorse" class="popup_endorse">


    <?php

    echo 'Your vote for will add only 0.1 points to '.$data['USER_NAME'].'\'s referrals.';
    echo '<br>';
    echo '<br>';
    echo 'Your endorsement will be more relevant if you login with Facebook.';
    echo '<br>';
    echo '<br>';
    echo '<div id="login_message"> Endorse '.$data['USER_NAME'].' as his friend!</div>';
    echo '<div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="true"></div>';
    echo '<br>';
    echo '<br>';
    echo 'Continue to <text id="endorse_popup1">endorse</text>'.' as anonymous.';
     ?>


</div>
<div id="popup_message" class="popup_endorse">


    <?php
    if ($user_is_logged_in == 0)
    {
        echo 'You must be logged in to send a message!';
        echo '<br>';
        echo '<br>';
        echo '<div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="true"></div>';
    }
    ?>


</div>
<div id="popup_already_endorsed" class="popup_endorse">

    You already endorsed this!

</div>
<div id="popup_endorse_success" class="popup_endorse">
</div>
