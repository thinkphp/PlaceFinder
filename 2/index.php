<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
   <title>Yahoo! Geo PlaceFinder - Explorer</title>
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <style type="text/css">
   html,body{font-family: helvetica,arial,sans-serif,verdana;color: #000}
   h1{color:#393;padding:5px;text-align:left;font-size: 30px;}
   form.nonlive{position: absolute;top: 0;left: -9999px}    
   .live{position: relative;left: 0;-moz-border-radius:5px 5px 5px 5px;background:none repeat scroll 0 0 #E2FEB5;margin:0 0 10px;padding:1em;}
   form{margin-top: 15px;margin-bottom: 15px;background: #336699;-moz-border-radius:5px;-border-radius:5px;-webkit-border-radius:5px;padding: 5px}
   #map{width:100%;height:520px;}
   input[type="submit"] {-moz-border-radius:10px 10px 10px 10px;background:none repeat scroll 0 0 #447E40;border:1px solid #447E40;color:#fff;cursor:pointer;padding:0.3em;margin-left: 10px;}
   input[type="submit"]:hover{background: #fff;color: #447E40}
   input[type="text"]{font-size: 20px;width: 300px}
   #f label{color: #fff;font-size: 20px}
   #info ul ul{margin: .7em}
   #info li{list-style:none;font-size:90%;padding:2px 0;}
   #info li span{width:7em;display:block;float:left;}
   #info h2{margin:0 0 10px 0;padding:0;background:#369;color:#fff;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;padding:.2em;}
   #info {height:440px;overflow:auto;}   
   #info ul{-moz-border-radius:5px 5px 5px 5px;background:none repeat scroll 0 0 #e2feb5;margin:0;padding:1em;}
   #ft{font-size:80%;color:#888;text-align:right;margin:2em 0;font-size: 12px}
   #ft p a{color:#93C37D;}
   </style>
</head>
<body>
<div id="doc3" class="yui-t7">
   <div id="hd" role="banner"><h1><img src="placefinder.jpg" alt="cover"/> Explorer (find the coordinates of a street address)</h1></div>
   <div id="bd" role="main">
      <form id="f" name="f"><label for="location">Location: </label><input type="text" name="location" id="location"/><input type="submit" value="Search!"></form>
    <div class="yui-gc">
      <div class="yui-u first">
           <div id="map"></div>
      </div>
      <div class="yui-u">
           <form id="f2" class="nonlive"><label for="earlier">Earlier Locations: </label> <select name="earlier" id="earlier"></select><input type="submit" value="Go"></form>
           <div id="info"></div>
      </div>
   </div>
 </div>
 <div id="ft" role="contentinfo"><p>Created by@<a href="http://twitter.com/thinkphp">thinkphp</a> using YUI, Yahoo! Maps and Yahoo! PlaceFinder</p></div>
</div>

<script src="http://api.maps.yahoo.com/ajaxymap?v=3.8&appid=YD-bs4vWJU_JXrmPwSfQ8yStcfWoDA5n51J"></script>
<script type="text/javascript" src="placefinder.js"></script>
</body>
</html>