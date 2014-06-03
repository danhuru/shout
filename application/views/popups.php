<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/popups.css'); ?>">
<script src="/shout/js/popups.js"></script>

<div id="overlay"></div>
<div id="popup_hobbies" class="popup">
    <?php
    foreach ($hobbies as $hobby)
    {
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

        echo "<br>";
        echo "<br>";
        echo '<div id="details">'.$hobby['details'].'</div>';
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

            echo '<div id="about" style="background-image: url('.$circle.')">';
            echo '<text id="what">"'.ucfirst($about['aboutme']).'"</text>';

            echo '<div id="endorse_nr2">';
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