<html>

<head>

    <script src="/shout/js/search.js" ></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/search.css'); ?>"">

    <!-- styles needed by jScrollPane -->
    <link rel="STYLESHEET" type="text/css" href="<?php echo base_url('css/jquery.jscrollpane.css'); ?>">
    <!-- latest jQuery direct from google's CDN -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- the mousewheel plugin - optional to provide mousewheel support -->
    <script type="text/javascript" src="/shout/js/jquery.mousewheel.js"></script>
    <!-- the jScrollPane script -->
  <!--  <script type="text/javascript" src="/shout/js/jquery.jscrollpane.min.js"></script> -->




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

</html>

