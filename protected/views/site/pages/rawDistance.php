<!DOCTYPE html>

<html>
	<head>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>My Code For The Client Interface</title>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"> </script> 
<!-- Added the places api. Can be used for autocomplete -->

<script type="text/javascript">

  var originsA = new Array();		//Need to use this
  var destinationsA = new Array();	//Need to use this

var originsString;
var destinationsString;
var distMatrix;


function getInputs() 
{
    originsString = document.getElementById('origins').value;
    destinationsString = document.getElementById('destinations').value;
   originsA = originsString.split("|");
   destinationsA = destinationsString.split("|");
}

function show_alert()		//Used for testing
{
getInputs();		//pop var
//alert('Got input');
dms();
//alert('usd dms');


}


function dms()
{
var origin1 = new google.maps.LatLng(55.930385, -3.118425);
var origin2 = "Greenwich, England";
var destinationC = "Stockholm, Sweden";
var destinationD = new google.maps.LatLng(50.087692, 14.421150);

var destinationA = origin1;
var destinationB = origin2;
var origin3 = destinationC;
var origin4 = destinationD;

alert(destinationsA);

var service = new google.maps.DistanceMatrixService();
service.getDistanceMatrix(
  {
    origins: [origin1, origin2, origin3, origin4],
    destinations: [destinationA, destinationB,destinationC,destinationD],
    travelMode: google.maps.TravelMode.DRIVING,
    avoidHighways: false,
    avoidTolls: false
  }, callback);



}


function callback(response, status) 
{
  if (status == google.maps.DistanceMatrixStatus.OK) 
  {
    var origins = response.originAddresses;
    var destinations = response.destinationAddresses;

    var data = new Array(origins.length);	//Create an new 1D array
    for (var i = 0; i < origins.length; i++) 
    {
      var results = response.rows[i].elements;
      data[i]= new Array(results.length);
      for (var j = 0; j < results.length; j++) 
      {
        var element = results[j];
        var distance = element.distance.text;
        data[i][j]=distance;
        var from = origins[i];
        var to = destinations[j];

        //alert(data[i][j]);
      }
    }

    var MyJSON = JSON.stringify(data);
    var MyJSONCities = JSON.stringify(origins);


    alert(MyJSON + MyJSONCities); //alert(MyJSON+ origins + destinations);

    var client = new XMLHttpRequest();

    var test = "post is working";

client.open("POST", "146.141.125.55/yii/ayiitest/site", true);
client.setRequestHeader("Content-Type", "text/json; charset=utf-8");
client.send(MyJSON);  // GET this working. There's a problem in that the array is empty!

//alert(client.responseText);
/*
 client.onreadystatechange = function () 
 {
 if (client.status == 200){
  alert(client.responseText);}
}*/



}
  } 
 



  


</script>


    </head>

<body>

	<form = id="queryinputs"> 
		
		 Origins:
		<br />
        <textarea id="origins" rows="5" cols="50"></textarea>
        <br />

        Destinations:
        <br />
        <textarea id="destinations" rows="5" cols="50"></textarea>
        <br />

        <input type="button" onclick="show_alert()" value="Submit" />

</body>


	
</html>

