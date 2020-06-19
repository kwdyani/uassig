<html>

<head>
	<title>leaflet-kmz</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Leaflet (JS/CSS) -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css">
	<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- JSZIP -->
	<!-- <script src="https://unpkg.com/jszip@3.1.5/dist/jszip.min.js"></script> -->

	<!-- @tmcw/togeojson -->
	<!-- <script src="https://unpkg.com/@tmcw/togeojson@3.0.1/dist/togeojsons.min.js"></script> -->

	<!-- geojson-vt -->
	<!-- <script src="https://unpkg.com/geojson-vt@3.0.0/geojson-vt.js"></script> -->

	<!-- Leaflet-KMZ -->
	<script src="https://unpkg.com/leaflet-kmz@0.3.0/dist/leaflet-kmz.js"></script>

	<style>
		html,
		body,
		.map {
			margin: 0;
			padding: 0;
			width: 100%;
			height: 100%;
		}
	</style>
</head>

<body>
	<div class="col-sm-4">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Filter Data</h5>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Tanggal</label>
                      <input type="date" class="form-control" name="tanggal" id="tanggalSearch"  @if(isset($tanggal)) value="{{$tanggal}}" @endif>
                    </div>
                    <button type="submit" id="tanggalBtn" class="btn btn-success btn-flat">Cari</button>
        
                </div>
              </form>
          </div>
      </div>
	<div id="map" class="map"></div>
	<div class="card-footer" style="background: white">
      <div class="row">
        <div class="col-6">
          Color Start
          <input type="color" value="#E5000D" class="form-control" id="colorStart">
        </div>
        <div class="col-6">
          Color End
          <input type="color" value="#FFFFFF" class="form-control" id="colorEnd">
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-12">
          <button class="btn btn-primary form-control" id="btnGenerateColor">Generate Color</button>
        </div>

      </div>
    </div>
	<script>

	$(document).ready(function(){
	  var dataCovid=null;
	  var tanggal = $('#tanggalSearch').val();
	  console.log(tanggal);
	  $('#tanggalBtn').click(function(e){
	  	e.preventDefault();
	  	map.remove();
	  	$.ajax({
	  		async:false,
	        url: "./loadDatabase.php",
	        type: "get",
	        dataType: 'json',
	        data:{"tgl": tanggal},
	        success: function (response){
	            //buat marker pada posisi yang tersimpan di database
	            dataCovid = response;
	            } 
	    });
	    console.log(dataCovid);

	  });
	  $.ajax({
	  		async:false,
	        url: "./loadDatabase.php",
	        type: "get",
	        dataType: 'json',
	        data:{"tgl": tanggal},
	        success: function (response){
	            //buat marker pada posisi yang tersimpan di database
	            dataCovid = response;
	            } 
	    });
	    console.log(dataCovid);
	    alert(dataCovid)
	  $('#btnGenerateColor').click(function(e){
	      var colorStart = $('#colorStart').val();
	      var colorEnd = $('#colorEnd').val();
	      $.ajax({
	        async:false,
	        url:'./getColor.php',
	        type:'get',
	        dataType:'json',
	        data:{"start": colorStart, "end":colorEnd, "tgl":tanggal},
	        success: function(response){
	          colorMap = response;
	        }
	      }); 
	      console.log(colorMap);
	   	  alert(colorMap)
	    });
	  	
	  var map = L.map('map');

	  map.setView(new L.LatLng(-8.4560705, 115.1118982), 10);

	  var OpenTopoMap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
		// Instantiate KMZ parser (async)
	  		var kmzParser = new L.KMZParser({
		    	onKMZLoaded: function(layer, name) {
		    	// add layer to layer control
		    	control.addOverlay(layer, name);
		    	layer.addTo(map);
		        // get all sub layer on kmz_layers
		      	var layerData = layer.getLayers()[0].getLayers();
		        // fetching data sub layer
			      	layerData.forEach(function(data, index){
					    // ambil data sub layer
					    var negara = data.feature.properties.NAME_0;
					    var provinsi = data.feature.properties.NAME_1;
					    var kabupaten  = data.feature.properties.NAME_2;
					    //Ganti warna Layer
					    var positif = dataCovid[index].banyak_penderita;
					    console.log(positif);
				    	if(kabupaten == 'Badung'){
				        	data.setStyle({fillOpacity:'0.5',fillColor:'#FF0000'});
					    }else if(kabupaten == 'Bangli'){
					        data.setStyle({fillOpacity:'0.5',fillColor:'#0000FF'});
					    }else if(kabupaten == 'Buleleng'){
					        data.setStyle({fillOpacity:'0.5',fillColor:'#FFFF00'});
					    }else if(kabupaten == 'Denpasar'){
					        data.setStyle({fillOpacity:'0.5',fillColor:'#00FF00'});
					    }else if(kabupaten == 'Gianyar'){
					        data.setStyle({fillOpacity:'0.5',fillColor:'#FF7F00'});
					    }else if(kabupaten == 'Jembrana'){
					        data.setStyle({fillOpacity:'0.5',fillColor:'#964B00'});
					    }else if(kabupaten == 'Karangasem'){
					        data.setStyle({fillOpacity:'0.5',fillColor:'#BF00FF'});
					    }else if(kabupaten == 'Klungkung'){
					        data.setStyle({fillOpacity:'0.5',fillColor:'#808000'});
					    }else if(kabupaten == 'Tabanan'){
					        data.setStyle({fillOpacity:'0.5',fillColor:'#C0C0C0'});
					    }

						data.addTo(map);
						data.bindPopup('<h2>Kabupaten/Kota : <a>'+kabupaten+'</a> <br>Positif: <a>'+positif+'</a></h2>');
			      	});
		  		}
		  	});
		 kmzParser.load('bali-kabupaten.kmz');
        // Add remote KMZ files as layers (NB if they are 3rd-party servers, they MUST have CORS enabled)
        

    var control = L.control.layers(null, null, { collapsed:false }).addTo(map);
	});
	</script>

</body>

</html>