$(document).ready(function() {
	$("#sel_provedor").click(function() {
		var prove=$("#prove").val();
		if (prove==""){
			$("#prove").parent().parent().attr("class","form-group has-error");
			$("#error1").fadeIn();
			return false;

		}
		
	});
});

$(document).ready(function() {
	$("#compra").click(function() {
		var producto=$("#producto").val();
		var nombre=$("#nombre").val();
		var cantidad=$("#cantidad").val();
		var total=$("#total").val();

		if (producto==""){
			$("#producto").parent().parent().attr("class","form-group has-error");
			$("#error2").fadeIn();
			return false;
		}else if (nombre=="" || nombre.length<=2 || nombre.length>20 || /^\s+$/.test(nombre)){
			$("#nombre").parent().parent().attr("class","form-group has-error");
			$("#error3").fadeIn();
			return false;

		}else if (cantidad=="" || cantidad=="0" || /^\s+$/.test(cantidad)){
			$("#cantidad").parent().parent().attr("class","form-group has-error");
			$("#error4").fadeIn();
			return false;
		}else if (total=="" || total=="0" || /^\s+$/.test(cantidad)){
			$("#total").parent().parent().attr("class","form-group has-error");
			$("#error5").fadeIn();
			return false;

		}
		
	});
});

$("#prove").click(function() {
        $("#prove").parent().parent().attr("class","form-group");    
        $("#error1").fadeOut();
    });
$("#producto").click(function() {
        $("#producto").parent().parent().attr("class","form-group");    
        $("#error2").fadeOut();
    });
$("#nombre").click(function() {
        $("#nombre").parent().parent().attr("class","form-group");    
        $("#error3").fadeOut();
    });
$("#cantidad").click(function() {
        $("#cantidad").parent().parent().attr("class","form-group");    
        $("#error4").fadeOut();
    });
$("#total").click(function() {
        $("#total").parent().parent().attr("class","form-group");    
        $("#error5").fadeOut();
    });


//validar cantidad solo números
$(document).ready(function(){ 
    $("#cantidad").keydown(function(event) {
       if(event.shiftKey)
       {
            event.preventDefault();
       }

       if (event.keyCode == 46 || event.keyCode == 8)    {
       }
       else {
            if (event.keyCode < 95) {
              if (event.keyCode < 48 || event.keyCode > 57) {
                    event.preventDefault();
              }
            } 
            else {
                  if (event.keyCode < 96 || event.keyCode > 105) {
                      event.preventDefault();
                  }
            }
          }
       });
    });

//validar total solo números
$(document).ready(function(){ 
    $("#total").keydown(function(event) {
       if(event.shiftKey)
       {
            event.preventDefault();
       }

       if (event.keyCode == 46 || event.keyCode == 8)    {
       }
       else {
            if (event.keyCode < 95) {
              if (event.keyCode < 48 || event.keyCode > 57) {
                    event.preventDefault();
              }
            } 
            else {
                  if (event.keyCode < 96 || event.keyCode > 105) {
                      event.preventDefault();
                  }
            }
          }
       });
    });

