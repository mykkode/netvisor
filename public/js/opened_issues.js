$(document).ready(function () {
    function get_status(response){
        if(response.assignee==null){
            return false;
        }else{
            return true;
        }
    }
    function populateTable(){
        $('#loading').css({"display":""});
        $.ajax({
            type: "POST",
            url: '/dashboard/get-issues',
            success: function(response) {
                console.log(response);
                var str='';
                for(var i=0;i<response.length;i++) {
                    str=str+'<tr>' +
                        '<td>'+response[i].node.device.name+'</td>' +
                        '<td>'+response[i].node.location.name+'</td>' +
                        '<td>'+(get_status(response[i])==false? "Not assigned!":"In progress!")+'</td>' +
                        '<td>' +
                            '<button type="button" class="btn '+(get_status(response[i])==false? 'btn-warning AssignTask':'btn-success FinishTask')+'" data-id="'+response[i].id+'">'+(get_status(response[i])==false? '+':'V')+'</button>' +
                        (get_status(response[i])!=false? ("=>"+response[i].assignee.username):"")+'</td>' +
                        '</tr>';
                }
                $("#replaceThis").html(str);
                $('#loading').css({"display":"none"});

                $(".AssignTask").click(function () {
                    var id=this.attributes[2].nodeValue;
                    console.log(id);
                    $.ajax({
                        type: "GET",
                        url: '/dashboard/assign-issues/'+id,
                        success: function(response) {
                            console.log(response);
                            populateTable();
                        }
                    });
                });
                $(".FinishTask").click(function () {
                    var id=this.attributes[2].nodeValue;
                    console.log(id);
                    $.ajax({
                        type: "GET",
                        url: '/dashboard/solve-issues/'+id,
                        success: function(response) {
                            console.log(response);
                            populateTable();
                        }
                    });
                });
            }
        });
    }
    populateTable();
});