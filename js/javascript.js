
    var mymap = L.map('mapid').setView([48.6737532, 19.696058], 5);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(mymap);
    var marker = L.icon({
        iconUrl: 'images/marker.png',
        iconSize:     [38, 95], // size of the icon
        shadowSize:   [50, 64], // size of the shadow
        iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
        shadowAnchor: [4, 62],  // the same for the shadow
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });
    function addMark(x,y){
        if(x!=null && y!=null){
            L.marker([x, y], {icon: marker}).addTo(mymap);
        }

    }
    function addAllMarks(){
        ajaxCallCoord();
    }
    function ajaxCallCoord() {
        $.ajax({
            type : "GET",
            url : "https://wt130.fei.stuba.sk/cvicenia/cvicenie7/api/coord.php",
            contentType : "application/json",
            success: function(result){
                let result2 = JSON.parse(result)
                $.each(result2.records,function (i,res){
                    addMark(res.latitude,res.longitude);
                });


            },
            error : function(e) {
                new jBox('Notice', {
                    animation: 'flip',
                    color: 'red',
                    content: 'Niečo zlyhalo!',
                    delayOnHover: true,
                    showCountdown: true
                });
                console.log(e)
            }
        });
    }