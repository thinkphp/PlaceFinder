<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
   <title>PlaceFinder - Explorer</title>
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/base/base.css" type="text/css">
   <style type="text/css">
   #intro p {color: #fff;background:#336699;padding: 4px;-moz-border-radius:5px;-webkit-border-radius:5px;}
   form{margin:0 0 10px 0;padding:0;background:#e2feb5;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;padding:1em;}
   h1 span,form{position: absolute;left: -9999px;top:0}
   h1 {background: url(placefinder.jpg) no-repeat scroll 0 0 transparent;line-height: 50px;font-size: 180%;padding-left: 100px;color: #393}
   form.live{position: relative;left: 0}
   #map{width:100%;height:520px;}
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
   <div id="hd" role="banner"><h1><span>PlaceFinder</span> Explorer (find the street address nearest to a point)</h1></div>
   <div id="intro"><p>You can simply double-click on the map below to set a marker and see the information stored in the PlaceFinder dataset.</p></div>
   <div id="bd" role="main">
   <div class="yui-gc">
    <div class="yui-u first">
    <div id="map"></div>	
    </div>
    <div class="yui-u">
    <form id="f">
       <label for="earlier">Earlier Locations</label>
       <select id="earlier" name="earlier"></select>
       <input type="submit" value="Go"> 
    </form>
    <div id="info"></div>	
    </div>
</div>

	</div>
<div id="ft" role="contentinfo"><p>@<a href="http://twitter.com/thinkphp">thinkphp</a> using YUI && Yahoo! Geo Technologies</p></div>
</div>


<script src="http://api.maps.yahoo.com/ajaxymap?v=3.8&appid=YD-bs4vWJU_JXrmPwSfQ8yStcfWoDA5n51J"></script>
<script type="text/javascript">

//show me loveto the module pattern
var placefinder = function(){

    var counter = 0,
        data = [],
        names = [],
        info = document.getElementById('info'),
        map = new YMap(document.getElementById('map')),
        locsform = document.getElementById('f'),	
        locs = document.getElementById('earlier'),
        isLive = false;

        //private method member
        function startMap() {
             map.disablePanOnDoubleClick();
             map.addTypeControl();
             map.addZoomLong();
             map.addPanControl();
             map.drawZoomAndCenter("bucharest,ro", 3);
             YEvent.Capture(map, EventsList.MouseDoubleClick , placefinder.cb);
             
        };

        function cb(_e, _c) {
             placefinder.counter++;
             var currentGeoPoint = new YGeoPoint(_c.Lat,_c.Lon);
             placeMarkerOnMap(currentGeoPoint);
             getPlaceFinderInfos(_c.Lat,_c.Lon);
        };

        function placeMarkerOnMap(geoPoint) {

            var newMarker = new YMarker(geoPoint);
                newMarker.addLabel(placefinder.counter);

                YEvent.Capture(newMarker,EventsList.MouseClick, function(e){
 
                       var count = e.thisObj.dom.getElementsByTagName('div')[0].innerHTML;
                           placefinder.info.innerHTML = '<h2>'+placefinder.names[count]+' #' + (count) + '</h2>' + 
                                            placefinder.data[count];    
                });  

                map.addOverlay(newMarker); 

        };

        function getPlaceFinderInfos(lat,lon) {
             if(document.getElementById('placefinderseed')) {
                 var old = document.getElementById('placefinderseed');
                     old.parentNode.removeChild(old);
             }
             var src = 'placefinder.php?latlon='+lat+','+lon;  
             var s = document.createElement('script');
                 s.setAttribute('type','text/javascript');
                 s.setAttribute('src',src);
                 s.setAttribute('id','placefinderseed');
                 document.getElementsByTagName('head')[0].appendChild(s);
        };

        function datain(data,loc,line) {
             //locs.innerHTML += '<option value="'+loc+'">'+line+'</option>';
             var option = document.createElement('option');
                 option.setAttribute('value',loc);
                 option.appendChild(document.createTextNode(line));
                 locs.appendChild(option);   
 
             if(!isLive) {
                 locsform.className = 'live'; 
             }
             placefinder.data[placefinder.counter] = data;
             placefinder.names[placefinder.counter] = line;
             info.innerHTML = '<h2>'+line+' #'+placefinder.counter+'</h2>' + data; 
        };

        locsform.onsubmit = function() {

              var sel = this.getElementsByTagName('select')[0];
              var latlon = sel.options[sel.selectedIndex].value.split(",");
              var lat = latlon[0], lon = latlon[1];
              var p = new YGeoPoint(lat,lon); 
              var current = sel.selectedIndex+1;
              placefinder.info.innerHTML = '<h2>'+placefinder.names[current]+' #' + current + '</h2>' + 
                                            placefinder.data[current];    
 
              map.panToLatLon(p);           
         return false;
        }

     //transform private methods in public methods
     return{startMap: startMap, cb: cb, counter: counter, datain: datain, data: data, names: names, info: info}; 
}();

placefinder.startMap();
</script>

</body>
</html>
