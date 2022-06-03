<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <!-- Bootstrap stuff -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
    <script src="js/locationpicker.jquery.js"></script>
    <title>Location picker with google map</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<h3>Location picker with google map</h3>
    <div class="container">
        <div class="form-group">
            <div class="col-sm-2">
                <label class="control-label">Location:</label>
            </div>

            <div class="col-sm-4">
                <input type="text" class="form-control" id="us3-address" />
            </div>
            <div class="col-sm-2">
                <label class="control-label">Radius:</label>
            </div>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="us3-radius" />
            </div>
        </div>
        <br><br>
        <div id="us3" style="width: 1000px; height: 450px;"></div>
        <div class="clearfix">&nbsp;</div>
        <div class="m-t-small">
            <label class="p-r-small col-sm-1 control-label">Lat.:</label>

            <div class="col-sm-3">
                <input type="text" class="form-control" style="width: 110px" id="us3-lat" />
            </div>
            <label class="p-r-small col-sm-2 control-label">Long.:</label>

            <div class="col-sm-3">
                <input type="text" class="form-control" style="width: 110px" id="us3-lon" />
            </div>
        </div>
        <div class="clearfix"></div>
        <script>
            $('#us3').locationpicker({
                location: {
                    /*latitude: 28.6618976,
                    longitude: 77.22739580000007*/

                    latitude: -0.18917855429378277,//28.6618976,
                    longitude: -78.49141195959476//77.22739580000007
                },
                radius: 500,
                zoom:18,
                inputBinding: {
                    latitudeInput: $('#us3-lat'),
                    longitudeInput: $('#us3-lon'),
                    radiusInput: $('#us3-radius'),
                    locationNameInput: $('#us3-address')
                },
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                    // Uncomment line below to show alert on each Location Changed event
                    //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                }
            });
        </script>
    </div>
</body>

</html>
