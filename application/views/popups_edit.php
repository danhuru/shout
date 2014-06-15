<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/popups_edit.css'); ?>">

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

        echo '<div id="delete_hobby" class="delete">Delete</div>';

        echo "<br>";
        echo "<br>";
        echo '<div id="initial">';
        echo '<div id="details">'.$hobby['details'].'</div>';
        echo '<div id="edit_details" class="edit">Edit</div>';
        echo '</div>';
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

        if ($about['author']<>'you')
        {
            echo '<div id="text">';
            echo "<i>said </i>";
            echo $about['author'];
            echo '</div>';
        }
        echo '<div id="delete_aboutme" class="delete">Delete</div>';
        echo '</div>';
    }
    ?>

</div>

<div id="popup_delete" class="popup_endorse">

    <div id="mainmessage">

        <div id="messsagetext">

            Are you sure you want to delete this?

        </div>
        <div id="buttonsdiv">
            <div id="okbutton">

                <button id="ok" class="smallbutton">Yes</button>

            </div>
            <div id="nobutton">

                <button id="cancel" class="smallbutton">No</button>

            </div>
        </div>
    </div>


</div>

