/**
 * Created by fred on 20/10/2014.
 */
function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
    var R = 6371; // Radius of the earth in km
    var dLat = deg2rad(lat2 - lat1);  // deg2rad below
    var dLon = deg2rad(lon2 - lon1);
    var a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2)
        ;
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c; // Distance in km
    return d;
}

function deg2rad(deg) {
    return deg * (Math.PI / 180)
}

var delta;
var nbPoints = 40.0;

function initialize(points) {
    var x = new google.maps.LatLng(points[0].latitude, points[0].longitude);
    var mapProp = {
        center: x,
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("carte"), mapProp);
    var trajet = [];
    var elevation = [];

    var marker = new google.maps.Marker({
        position: x
    });
    marker.setMap(map);
    var len = 10;
    var myTrip = [];
    //var len = myTrip.length;
    var lat1, lat2, lon1, lon2;
    lat1 = points[0].latitude;
    lon1 = points[0].longitude;
    var localisation = 0.0;
    for (i = 0; i < points.length; i++) {
        myTrip.push(new google.maps.LatLng(points[i].latitude, points[i].longitude));
        lat2 = points[i].latitude;
        lon2 = points[i].longitude;
        localisation += getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2);
        trajet.push(localisation.toFixed(2));
        elevation.push(parseFloat(points[i].elevation).toFixed(2));
        lat1 = lat2;
        lon1 = lon2;
    }
    delta = localisation / nbPoints;
//    alert(delta.toFixed(2));
    var oldLocalisation = 0.0;
    var trajetAffiche = [];
    var elevationAffiche = [];
//    elevationAffiche.push(elevation[0]);
//    oldLocalisation = trajet[0];
    for (i = 0; i < trajet.length; i++) {
        if (trajet[i] - oldLocalisation > delta) {
            trajetAffiche.push(trajet[i]);
            elevationAffiche.push(elevation[i]);
            oldLocalisation = trajet[i];
        }
    }
    elevationAffiche.push(elevation[trajet.length - 1]);
    oldLocalisation = trajet[trajet.length - 1];

    var flightPath = new google.maps.Polyline({
        path: myTrip,
        strokeColor: "#0000FF",
        strokeOpacity: 0.8,
        strokeWeight: 2
    });

    flightPath.setMap(map);
    drawChart(trajetAffiche, elevationAffiche);
}

function request() {
    var urlData = document.getElementById('URLData').value;
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            readData(xhr.responseText);
        }
    };

    xhr.open("GET", urlData, true);
    xhr.send(null);
}

function drawChart(deplacement, elevation) {
    var options = {
        ///Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: false,

        //String - Colour of the grid lines
        scaleGridLineColor: "rgba(0,0,0,.05)",

        //Number - Width of the grid lines
        scaleGridLineWidth: 1,

        //Boolean - Whether the line is curved between points
        bezierCurve: true,

        //Number - Tension of the bezier curve between points
        bezierCurveTension: 0.4,

        //Boolean - Whether to show a dot for each point
        pointDot: false,

        //Number - Radius of each point dot in pixels
        pointDotRadius: 2,

        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth: 1,

        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius: 20,

        //Boolean - Whether to show a stroke for datasets
        datasetStroke: true,

        //Number - Pixel width of dataset stroke
        datasetStrokeWidth: 2,

        //Boolean - Whether to fill the dataset with a colour
        datasetFill: true,

        responsive: true,

        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

    };

    var data = {
        labels: deplacement,
        datasets: [
            {
                label: "Elévation",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: elevation
            }
        ]
    };
    var ctx = document.getElementById("elevation_div").getContext("2d");
    var myLineChart = new Chart(ctx).Line(data, options);

}

function readData(sData) {
    points = JSON.parse(sData);
    initialize(points);
}

function loadMapScript() {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBYo0uvJ5rOQ8t9Gs5lqV1IBdvGTG_3Lh4&' +
        'callback=request';
    document.body.appendChild(script);
}

if (document.getElementById('URLData')) {
    window.onload = loadMapScript;
}


//document.write(Date());
