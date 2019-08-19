//Solo número cantidad
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
	

//Validar Campos vacios
$(document).ready(function() {
	$("#envio").click(function() {
		var id_pro=$("#id_pro").val();
		// var destino=$("#destino").val();
		var cantidad=$("#cantidad").val();
		var nota=$("#nota").val();
		

		if (id_pro=="" || id_pro.length<=5 || id_pro.length>30 ||/^\s+$/.test(id_pro)){
			$("#id_pro").parent().parent().attr("class","form-group has-error");
			$("#error4").fadeIn();
			return false;
		}else if (cantidad=="" || cantidad.length<=0 || /^\s+$/.test(cantidad)){
			$("#cantidad").parent().parent().attr("class","form-group has-error");
			$("#error7").fadeIn();
			return false;
		}else if (nota=="" || nota.length<=5 || nota.length>40 || /^\s+$/.test(nota)){
      $("#nota").parent().parent().attr("class","form-group has-error");
      $("#error9").fadeIn();
      return false;
    }
	});
});


$("#id_pro").click(function() {
        $("#id_pro").parent().parent().attr("class","form-group");    
        $("#error4").fadeOut();
    });

$("#destino").click(function() {
        $("#destino").parent().parent().attr("class","form-group");    
        $("#error6").fadeOut();
    });
$("#cantidad").click(function() {
        $("#cantidad").parent().parent().attr("class","form-group");    
        $("#error7").fadeOut();
    });
$("#nota").click(function() {
        $("#nota").parent().parent().attr("class","form-group");    
        $("#error9").fadeOut();
    });
