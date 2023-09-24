
    function ajaxCall() {
        this.send = function(data, url, method, success, type) {
          type = type||'json';
          var successRes = function(data) {
              success(data);
          };

          var errorRes = function(e) {
              console.log(e);
              alert("Error found \nError Code: "+e.status+" \nError Message: "+e.statusText);
          };
            $.ajax({
                url: url,
                type: method,
                data: data,
                success: successRes,
                error: errorRes,
                dataType: type,
                timeout: 60000
            });

          };

        }

function locationInfo() {
    var rootUrl = "../libs/cities-dropdown/api.php";
    var call = new ajaxCall();
    this.getCities = function(id) {
        $(".cities option:gt(0)").remove();
        var url = rootUrl+'?type=getCities&stateId=' + id;
        var method = "post";
        var data = {};
        $('.cities').find("option:eq(0)").html("Espere..");
        call.send(data, url, method, function(data) {
            $('.cities').find("option:eq(0)").html("Escoja la ciudad");
            $('.cities').material_select('destroy');
            if(data.tp == 1){
                $.each(data.result, function(key, val) {
                    var option = $('<option />');
                    option.attr('value', key).text(val);
                    $('.cities').append(option);
                });
                $('.cities').material_select();
                $(".cities").prop("disabled",false);
            }
            else{
                $('.cities').material_select();
                 alert(data.msg);
            }
        });
    };

    this.getStates = function(id) {
        $(".states option:gt(0)").remove(); 
        $(".cities option:gt(0)").remove(); 
        var url = rootUrl+'?type=getStates&countryId=' + id;
        var method = "post";
        var data = {};
        $('.states').find("option:eq(0)").html("Espere..");
        $('.states').find("option:eq(0)").html("Seleccione el estado");
        call.send(data, url, method, function(data) {
            $('.states').material_select('destroy');
            if(data.tp == 1){
                $.each(data.result, function(key, val) {
                    var option = $('<option />');
                    option.attr('value', key).text(val);
                    $('.states').append(option);
                });
                 $('.states').material_select();
                $(".states").prop("disabled",false);
            }
            else{
                 $('.states').material_select();
                  $(".states option:gt(0)").remove();
                alert(data.msg);
            }
        }); 
    };

    this.getCountries = function() {
        var url = rootUrl+'?type=getCountries';
        var method = "post";
        var data = {};
        $('.countries').find("option:eq(0)").html("Espere..");
        $('.countries').find("option:eq(0)").html("Seleccione el país");
        call.send(data, url, method, function(data) {            
            $('.countries').material_select('destroy');
            console.log(data);
            if(data.tp == 1){
                $.each(data.result, function(key, val) {
                    var option = $('<option />');
                    option.attr('value', key).text(val);
                    $('.countries').append(option);
                });
                $('.countries').material_select();
                $(".countries").prop("disabled",false);
            }
            else{
                 $('.countries').material_select();
                alert(data.msg);
            }
        }); 
    };

}

$(function() {
var loc = new locationInfo();
loc.getCountries();
 $(".countries").on("change", function(ev) {
        var countryId = $(this).val();
        $(".cities").material_select('destroy');
        $('.states').material_select('destroy');
        if(countryId !== ''){
        loc.getStates(countryId);
        }
        else{
            $(".states option:gt(0)").remove();
        }
    });
 $(".states").on("change", function(ev) {
        $(".cities").material_select('destroy');
        var stateId = $(this).val();
        if(stateId !== ''){
        loc.getCities(stateId);
        }
        else{
            $(".cities option:gt(0)").remove();
        }
    });
});


