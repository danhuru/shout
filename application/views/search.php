<html>

<head>

    <script src="/shout/js/search.js" ></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/search.css'); ?>"">
    <!-- latest jQuery direct from google's CDN -->
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

</head>

<body onload="searchResult('show_me_all')">

<?php $bck=rand(1,6);
$image= base_url('images/background'.$bck.'.jpg');
?>

<div id="main" style="background-image: url('<?php echo $image;?>')">

    <div id="mainbox">

        <div id="mainbox_contents">

            <br>

            <div id="searchbox">

            <input id="search" autocomplete="off" autofocus type="text" size="30" onclick="this.value=''" onkeyup="searchResult(this.value)" value="type a hobby..." >

            </div>

            <div id="titles">Matching profiles</div>

            <div id="resultsbox">

            <div id="showSearchResults">

            </div>

            </div>

         </div>

    </div>

</div>


</body>

<script src="/shout/js/search.js" ></script>

</html>

