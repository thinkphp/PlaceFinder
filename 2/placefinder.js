//show me loveto the module pattern
var placefinder = function(){

    /* private data members */
    var counter = 0,
        data = [],
        names = [],
        info = document.getElementById('info'),
        map = new YMap(document.getElementById('map')),
        form = document.getElementById('f'),
        locsform = document.getElementById('f2'),
        isLive = false;

        //private method member
        function startMap() {
             map.addTypeControl();
             map.addZoomLong();
             map.addPanControl();
             map.drawZoomAndCenter("bucharest,ro", 3);             
        };

        /* here we attach a handler for submit event at 'form' element form */
        form.onsubmit = function() {
  
             //remove old script tag injection from head
             if(document.getElementById('placefinderseed')) {
                 var old = document.getElementById('placefinderseed');
                     old.parentNode.removeChild(old);
             }

             //get the location value
             var location = document.getElementById('location').value;
             //get ready url
             var url = 'placefinder.php?q='+location;  
             //create an element 'script'
             var s = document.createElement('script');
                 //attach an attribute 'id'
                 s.setAttribute('id','placefinderseed');     
                 //attach an attribute 'type'
                 s.setAttribute('type','text/javascript');     
                 //attach an attribute 'url'
                 s.setAttribute('src',url);
                 //append in header document.html
                 document.getElementsByTagName('head')[0].appendChild(s);
             //return false
          return false;   
        };

        //this is a function that is executed when we make a script tag injection and receive data from 
        //API PlaceFinder dataset
        function datain(data,latlon,name) {
               //get latitude and longitude in vars lat and lon
               var lat = latlon.split(',')[0], lon = latlon.split(',')[1];
               //if history form is ready then attach a class
               if(!isLive) {
                   locsform.className = 'live';
               }

               /*
                 //for FF,Opera and Chrome but no IE
                 locsform.getElementsByTagName('select')[0].innerHTML += '<option value="'+latlon+'">'+name+'</option>';
                 document.getElementById('earlier').innerHTML += '<option value="'+latlon+'">'+name+'</option>';
               */
                 //variant 2 is better
                 var option = document.createElement('option');
                     option.setAttribute('value',latlon);
                     var text = document.createTextNode(name);
                     option.appendChild(text);
                     document.getElementById('earlier').appendChild(option);
 
               //get ready the point
               var point = new YGeoPoint(lat,lon);
               //get ready the marker for this point
               var newMarker = new YMarker(point); 
                   //attach a label for this marker on the map
                   newMarker.addLabel(++placefinder.counter);

                //attach a listener for click event marker
                YEvent.Capture(newMarker,EventsList.MouseClick, function(e){
                       //grab innerHTML marker and update the infos
                       var count = e.thisObj.dom.getElementsByTagName('div')[0].innerHTML;
                           placefinder.info.innerHTML = '<h2>'+placefinder.names[count]+' #' + (count) + '</h2>' + 
                                            placefinder.data[count];    
                });  
 
               //add new marker on map
               map.addOverlay(newMarker);
               //draw zoom and best center
               map.drawZoomAndCenter(point,2);
               //save the data for each address
               placefinder.data[placefinder.counter] = data;
               placefinder.names[placefinder.counter] = name;
               //update the information in element info
               info.innerHTML = '<h2>'+name+' #'+placefinder.counter+'</h2>' + data; 
        };  

        //attach a listener for submit event at the element 'locsform'
        locsform.onsubmit = function() {

               var sel = this.getElementsByTagName('select')[0];
               var latlon = sel.options[sel.selectedIndex].value.split(',');
               var lat = latlon[0], lon = latlon[1];
               var p = new YGeoPoint(lat,lon);
               var current = sel.selectedIndex+1;
               placefinder.info.innerHTML = '<h2>'+placefinder.names[current]+' #' + current + '</h2>' + 
                                            placefinder.data[current];     
               map.panToLatLon(p);           
           return false;             
        }; 

    //return an object and transform private methods in public methods
    return {startMap: startMap,datain: datain,data: data,names: names, counter: counter,info: info};
}(); 
placefinder.startMap();
