<html>
<meta charset="UTF-8">
<head>

    <script src="/shout/js/search.js" ></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/search.css'); ?>"">

</head>


<body onload="showResult('show_me_all')">


<?php $bck=rand(1,6);
$image= base_url('images/background'.$bck.'.jpg');
?>

<div id="main" style="background-image: url('<?php echo $image;?>')">

    <div id="mainbox">


        <div id="mainbox_contents">

                <br>
            <div id="searchbox"><label id="label">Filter by name:</label>
                <input id="filter"type="text" size="30" onkeyup="searchResult(this.value)"> </div>
            <div id="showResults">
                <div id="showSearchResults"></div>
            </div>

            </div>
        </div>
    </div>
</div>






</body>

</html>

