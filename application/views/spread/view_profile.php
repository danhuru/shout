<html>

<head>
    <script src="/shout/js/create_profile.js"></script>
    <script src="/shout/js/jquery-1.11.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/preview.css'); ?>">
</head>

<body>



<div id="header">

    <div id="header_logo">
        <img src="<?php echo base_url('images/header_logo.jpg');?>">
    </div>
    <br>
    <div id ="motto">Discover valuable people. Easy.</div>
    <div id ="breadcrumb">1. Create a profile</div>
</div>

<?php $bck=rand(1,6);
$image= base_url('images/background'.$bck.'.jpg');
?>

<div id="main" style="background-image: url('<?php echo $image;?>')">
    <br>
    <br>
    <div id="mainbox">

    <!--    <div id="loggedin">Logged in as <?php echo $data[0]['name'];?>.</div> -->

        <div id="mainbox_contents">

            <br>
            <br>

            <div id="profile_info">

               <img id="profile_pic" src="<?php echo $data[0]['pic_big'];?>"
                <br>

                <div id="profile_details">

                <h2><?php echo $data[0]['name'];?> </h2>

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
                    <h3>My hobbies</h3>
                <hr>
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
                             echo '<div id="details">'.$hobby['details'].'</div>';
                             echo "<br>";
                             echo "<br>";
                         }
                          ?>

            </div>

            <div id="aboutme">
                <h3>My personality</h3>
                <hr>
                <br><br>

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

        <div id="button">
            <form action="invite" method="post">
                <input class="button" type="submit" name="submit" value="Next">
            </form>
        </div>

    </div>

</div>



<div id="footer">@2014. Webuildshout.com</div>


</body>


</html>