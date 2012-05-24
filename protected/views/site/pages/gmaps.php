
<html>    
  <head> 
    <script type="text/javascript" src="protected/extensions/jquery-1.4.4.min.js"></script>        
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script type="text/javascript" src="protected/extensions/gmap3.js"></script> 
    <style>
      body{
        text-align:left;
      }
      #ctrl{
        width: 500px;
        margin:0 auto;
      }
      .gmap3{
        margin: 20px auto;
        border: 1px dashed #C0C0C0;
        width: 500px;
        height: 250px;
      }
    </style>
    
    <script type="text/javascript">
    
      $(function(){

        var myMarkers = new Array();
        var myMarkerNames = new Array();
      
        $("#test").gmap3(
          { action:'init',
            options:{
              center:[-26.2000,28.0667],
              zoom: 12
            },
            events:{
              click: function(map, event){
                addMarker(event);
              }
            }
          }
          );

        function addMarker(event){
          alert(event.latLng);
          myMarkers.push(event.latLng);
          myMarkerNames.push(event.latLng.toString());
        /*  $("#test").gmap3({
            action: 'getAddress',
            latLng: event.latLng,
            callback: function(results){
              myMarkerNames.push(results[1].formatted_address);
            }
          });*/
          $("#test").gmap3({
            action:'addMarker',
            latLng:event.latLng,
            options:{
              draggable:false,
              icon:new google.maps.MarkerImage('http://maps.gstatic.com/mapfiles/icon_green' + String.fromCharCode(myMarkers.length + 64) + '.png')
            }
          });
        }

        $('#submitDistance').click(function(){
          alert(myMarkers);
          $("#test").gmap3({
            action: 'getDistance',
            options:{
              origins: myMarkers,
              destinations: myMarkers,
              travelMode: google.maps.TravelMode.DRIVING
            },
            callback: function(results){
              var data = new Array(results.length); //Create an new 1D array
              for (var i = 0; i < results.rows.length; i++) 
              {
                var rows = results.rows[i].elements;
                data[i]= new Array(rows.length);
                for (var j = 0; j < rows.length; j++) 
                {
                  var element = rows[j];
                  var distance = element.distance.text;
                  var _distance = Math.round(parseFloat(distance.substring(0, distance.indexOf(' '))));
                  data[i][j]=_distance;
                }
              }

              alert(data);
              var kJson = '{ \"noOfCities\" : ' +myMarkers.length+ ', \"distanceMatrix\" : ' +JSON.stringify(data)+ ',  \"names\" : ' +JSON.stringify(myMarkerNames)+ '}';
              $.ajax
                ({
                    type: "POST",
                    //the url where you want to sent the userName and password to
                    url: '?r=site/distancematrix',
                    dataType: 'json',
                    async: false,
                    //json object to sent to the authentication url
                    data: {'json' : kJson},
                    success: function (data) {

                     $('#results').html(data);
                     alert('results submitted');
                    }
                });
            }
          }
          );
        });

		
        
        $('#test-ok').click(function(){
          var addr = $('#test-address').val();
          if ( !addr || !addr.length ) return;
          $("#test").gmap3({
            action:   'getlatlng',
            address:  addr,
            callback: function(results){
              if ( !results ) return;
              $(this).gmap3({
                action:'addMarker',
                latLng:results[0].geometry.location,
                map:{
                  center: true
                }
              });
            }
          });
        });
        
        $('#test-address').keypress(function(e){
          if (e.keyCode == 13){
            $('#test-ok').click();
          }
        });

        $('#getResult').click(function() {
      	      $.get('?r=site/getresults',
              	      function(data) {
          	      		var results = JSON.parse(data);
          	      		var places = results.navigationPath;
          	      		alert(results.optimalPath);
          	      	 for (var i = 0; i < places.length; i++) {
              	      	 var lat = parseFloat(places[i].substring(1, places[i].indexOf(",")));
              	      	 alert(lat);
              	      	 alert(places[i].substring(
                              	      	places[i].indexOf(" ")+1, 
                              	      	places[i].length-1
                              	      	 ));
              	      	 var lng = parseFloat(
              	      			places[i].substring(
                              	      	places[i].indexOf(" ")+1, 
                              	      	places[i].length-1
                              	      	 ));
	          	      	$("#test").gmap3({
	          	            action:'addMarker',
	          	            latLng:new google.maps.LatLng(lat,lng),
	          	            options:{
	          	              draggable:true,
	          	              icon:new google.maps.MarkerImage('http://maps.gstatic.com/mapfiles/icon_green' + String.fromCharCode(i + 65) + '.png')
	          	            }
	          	          });
          	      	 }
		    	    	  for (var i = 0; i < places.length-1; i++) {
		                      $('#test').gmap3(
		                        { action:'getRoute',
		                          options:{
		                            origin: places[i],
		                            destination:places[i+1],
		                            travelMode: google.maps.DirectionsTravelMode.DRIVING
		                          },
		                          callback: function(results){
		                            if (!results) return;
		                            $(this).gmap3(
		                              { action:'addDirectionsRenderer',
		                                options:{
		                                  preserveViewport: true,
		                                  draggable: false,
		                                  directions:results,
		                                  markerOptions:{ 
			                                  visible: false
			                                  }
		                                }
		                              }
		                            );
		                          }
		                        }
		                      );
		    	    	  }
  	      })});


        
      });

      

    </script>  
  </head>
    
  <body>
    <div id="ctrl" style="margin-left:5px;">Address : <input type="text" id="test-address" size="50"> 
    <button type="button" style="margin-left:222px;" id="test-ok">Ok</button></div>  
    <div id="test" style="margin-left:5px;" class="gmap3"></div>
     Fill in an address, a marker will be added and the map will be centered on it <br />
    <input type="button" style="margin-left:185px;" id="submitDistance" value="Calculate Route">
    <input type="button" id="getResult" value="get results">
    <div id="results"></div>
  </body>
</html>