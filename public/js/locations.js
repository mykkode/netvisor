$(document).ready(function () {
    function populateTable(){
        $('#loading').css({"display":""});
        $.ajax({
            type: "GET",
            url: '/dashboard/locations/getAllLocations',
            success: function(response) {
                console.log(response);
                var str='';
                for(var i=0;i<response.length;i++) {
                    str=str+'<tr>' +
                        '<td>'+response[i].id+'</td>' +
                        '<td>'+response[i].name+'</td>' +
                        '<td>0</td>' +
                        '<td><button type="button" class="btn btn-warning remove_location" data-id="'+response[i].id+'">X</button></td>' +
                        '</tr>';
                }
                $("#replaceThis").html(str);
                $('#loading').css({"display":"none"});

                $(".remove_location").click(function () {
                    console.log(this.attributes[2].nodeValue);
                    var id=this.attributes[2].nodeValue;

                    $.ajax({
                        type: "POST",
                        url: '/dashboard/locations/deleteLocation',
                        data: {id:id},
                        success: function(response) {
                            console.log(response);
                            if(response){
                                populateTable();
                            }
                        },
                        error: function (out) {
                            console.log("nu merge");
                            console.log(out);
                        }
                    });
                });
            }
        });
    }
    populateTable();

    $("#AddLocation").click(function () {
        var LocationName=$("#LocationName")[0].value;

        $.ajax({
            type: "POST",
            url: '/dashboard/locations/insertLocation',
            data: {name:LocationName},
            success: function(response) {
                if(response){
                    populateTable();
                }
            }
        });
    });
});