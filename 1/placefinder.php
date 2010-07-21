<?php

 header('content-type: text/javascript');

 $appid = 'YD-bs4vWJU_JXrmPwSfQ8yStcfWoDA5n51J';

 echo 'placefinder.datain("';

 $latlon = $_GET['latlon'];

 /**
   * Yahoo! PlaceFinder Guide 
   * http://developer.yahoo.com/geo/placefinder/guide/index.html
   * 
   */
 $url='http://where.yahooapis.com/geocode?q='.$latlon.'&gflags=ACR&flags=QRGSTXP&appid='.$appid;

 $output = get($url);

 $data = unserialize($output);

 $found = false;

 //if we have results then begin
 if($data['ResultSet']['Result'][0]) {

    //hold the data in $set
    $set = $data['ResultSet']['Result'][0];

    //begin markup <UL>
    echo'<ul>';

    //for each key from array execute
    foreach(array_keys($set) as $s) {

        if($set[$s] != '') {

           if(!$found && strpos($s,'line') !== false) {
               $found = true;
               $name = $set[$s];
           } 
                    
           //if the key is array then loop through it
           if(is_array($set[$s])) {

             echo'<li><span>'.ucfirst($s).':</span><ul>';

               foreach(array_keys($set[$s]) as $x) {

                  if($set[$s][$x] != '') {

                     echo'<li><span>'.ucfirst($x).'</span>'.$set[$s][$x].'</li>';

                  }//endif

               }//end foreach

               echo'</ul></li>';

           //otherwise not array then display
           } else {

             echo'<li><span>'.ucfirst($s).'</span>'.$set[$s].'</li>';
           }

        }//end if

    }//end foreach

    echo'</ul>'; 

 }//end if

 echo'","'.$latlon.'","'.$name.'")'; 

 function get($url) {

     $ch = curl_init();
     curl_setopt($ch,CURLOPT_URL,$url);
     curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
     curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
     $data = curl_exec($ch);
     curl_close($ch);
     if(empty($data)) {return 'Error! Sistem unvailable.';}
            else {return $data;}
 }

?>