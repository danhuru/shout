<html>

<head>

    <script src="/shout/js/jquery-1.11.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/editprofile.css'); ?>">
    <script src="/shout/js/editprofile.js"></script>

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
            <br>


            <div id="profile_info">

                <img id="profile_pic" src="<?php echo $data[0]['pic_big'];?>"</img>

                <div id="profile_name"><?php echo $data[0]['name'];?> </div>

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

            <div id="hobbies">
                <div id="profile_name">My hobbies</div>

                <br>

                <?php

                $ident=0;

                foreach ($hobbies as $hobby)
                {
                    $ident++;
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

                    echo '<div id="delete_hobby" onclick="delete_hobby(this,\''.$user_id.'\',\''.$hobby['hobby'].'\')">Delete</div>';

                    echo "<br>";
                    echo "<br>";
                    echo '<div>';
                    echo '<div id="details">'.$hobby['details'].'</div>';
                    echo '<div id="edit_details" onclick="edit_details(this,\''.$hobby['details'].'\')">Edit</div>';
                    echo '</div>';
                    echo "<br>";
                    echo "<br>";
                }
                ?>

            </div>

            <div id="aboutme">

                <div id="profile_name">My personality</div>

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

                    if ($about['author']<>'you')
                    {
                        echo "<i>from </i>";
                        echo $about['author'];
                    }

                    echo '</div>';
                }
                ?>


            </div>
        </div>



    </div>

</div>



</body>


</html>