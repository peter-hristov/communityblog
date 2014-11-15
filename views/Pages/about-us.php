
<div id="map-canvas" class ="col-sm-6" style="height:300px"></div>

<div class="col-sm-6">
    <div> Adress ... </div>
    <div> Telephone ... </div>
    <div> Fax ... </div>
    <div> Email .... </div>
    <div> Google Plus ... </div>
</div>

<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgEyk4yDv-w8lsRqBMWP5mCsPOqj71gc4">
</script>

<script type="text/javascript">

    function initialize() {

        var mapOptions = {
            center: { lat: -34.397, lng: 150.644},
            zoom: 10
        };

        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    }

    google.maps.event.addDomListener(window, 'load', initialize);

</script>
