$(document).ready(function() {
    $(document).on("click", "button[name='approvebtn']", function (e) {
        var id = e.target.id;
        approveRequest(id);
    });

    $(document).on("click", "button[name='denybtn']", function (e) {
        var id = e.target.id;
        approveRequest(id);
    });


    function approveRequest(input) {
        var info = {            
          rowId:input  
        };
        $.ajax({
            type: "POST",
            url: "http://localhost/CS425_Spring2016_ClassProject/ModeratorIGCRequestHandle.php",
            content: "application/json; charset=utf-8",
            dataType: 'json',
            data: info,
            success: function(d) {                
                    alert(d.message);                
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error(xhr.responseText);
            }
        });
    };

});