<html>

<head>

    <script src="/shout/js/jquery-1.11.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/viewprofile.css'); ?>">
    <script src="/shout/js/viewprofile.js" ></script>

</head>

<body>



<?php $bck=rand(1,6);
$image= base_url('images/background'.$bck.'.jpg');
?>

<div id="overlay"></div>
<div id="popup_hobbies" class="popup">
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
    echo '<div id="details">'.$hobby['details'].'</div>';
    echo "<br>";
    echo "<br>";
    }
    ?>
    </div>
<div id="popus_aboutme" class="popup">
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

<div id="main" style="background-image: url('<?php echo $image;?>')">

    <div id="mainbox">

        <!--    <div id="loggedin">Logged in as <?php echo $data[0]['name'];?>.</div> -->

        <div id="mainbox_contents">

            <br>
            <br>


            <div id="profile_info">

                <img id="profile_pic" src="<?php echo $data['PIC_BIG'];?>"</img>

                <div id="profile_name"><?php echo $data['USER_NAME'];?> </div>

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

                for($i=0;$i<5;$i++)

                {
                    $hobby=$hobbies[$i];
                    echo '<div id="hobby">'.ucfirst($hobby['hobby']).'</div>';

                    echo '<div id="endorse_nr1">';

                    for ($j=1;$j<=$hobby['endorsements'];$j++)

                    {
                        echo '<img src='.base_url('images/endorse_nr.png').' width="25px" >';
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

                if (count($hobbies)>5) echo '<div id="view_hobbies" class="viewmore">View more</div>';

                ?>

            </div>

            <div id="aboutme">

                <div id="profile_name">My personality</div>

                <br>

                <?php

                for ($i=0;$i<4;$i++)
                {
                    $about=$aboutme[$i];
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


                if (count($aboutme)>4) echo '<div id="view_aboutme" class="viewmore">View more</div>';

                ?>


            </div>
        </div>



    </div>

</div>



</body>


</html>