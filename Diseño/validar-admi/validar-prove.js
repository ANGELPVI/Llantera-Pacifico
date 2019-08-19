$(document).ready(function() {
	$("#inser").click(function() {
		var provedor=$("#provedor").val();
		var correo=$("#correo").val();
		var tel=$("#tele").val();
		var ciu=$("#ciu").val();
		var estado=$("#es").val();
		var colonia=$("#colonia").val();
		var calle=$("#calle").val();
		var rpro=$("#rpro").val();
		var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);

		if (provedor=="" || provedor.length<=2 || provedor.length>40 || /^\s+$/.test(provedor)){
			$("#provedor").parent().parent().attr("class","form-group has-error");
			$("#error1").fadeIn();
			return false;
		}else if (caract.test(correo)==false){
			$("#correo").parent().parent().attr("class","form-group has-error");
			$("#error2").fadeIn();
			return false;
		}else if (tel=="" || tel.length<=9 ||tel.length>10 || /^\s+$/.test(tel)){
			$("#tele").parent().parent().attr("class","form-group has-error");
			$("#error3").fadeIn();
			return false;
		}else if (ciu=="" || ciu.length<=4 || ciu.length>25 || /^\s+$/.test(ciu)){
			$("#ciu").parent().parent().attr("class","form-group has-error");
			$("#error4").fadeIn();
			return false;
		}else if (estado=="" || estado.length<=4 || estado.length>25 || /^\s+$/.test(estado)){
			$("#es").parent().parent().attr("class","form-group has-error");
			$("#error5").fadeIn();
			return false;
		}else if (colonia=="" || colonia.length<=4 || colonia.length>25 || /^\s+$/.test(colonia)){
			$("#colonia").parent().parent().attr("class","form-group has-error");
			$("#error6").fadeIn();
			return false;
		}else if (calle=="" || calle.length<=4 || calle.length>25 || /^\s+$/.test(calle)){
			$("#calle").parent().parent().attr("class","form-group has-error");
			$("#error7").fadeIn();
			return false;
		}else if (rpro=="" || rpro.length<=12 || rpro.length>13 || /^\s+$/.test(rpro)){
			$("#rpro").parent().parent().attr("class","form-group has-error");
			$("#error8").fadeIn();
			return false;
		}
	});
});


$("#provedor").click(function() {
        $("#provedor").parent().parent().attr("class","form-group");    
        $("#error1").fadeOut();
    });
$("#correo").click(function() {
        $("#correo").parent().parent().attr("class","form-group");    
        $("#error2").fadeOut();
    });
$("#tele").click(function() {
        $("#tele").parent().parent().attr("class","form-group");    
        $("#error3").fadeOut();
    });
$("#ciu").click(function() {
        $("#ciu").parent().parent().attr("class","form-group");    
        $("#error4").fadeOut();
    });
$("#es").click(function() {
        $("#es").parent().parent().attr("class","form-group");    
        $("#error5").fadeOut();
    });
$("#colonia").click(function() {
        $("#colonia").parent().parent().attr("class","form-group");    
        $("#error6").fadeOut();
    });
$("#calle").click(function() {
        $("#calle").parent().parent().attr("class","form-group");    
        $("#error7").fadeOut();
    });
$("#rpro").click(function() {
        $("#rpro").parent().parent().attr("class","form-group");    
        $("#error8").fadeOut();
    });


//validar telefono solo números
$(document).ready(function(){ 
    $("#tele").keydown(function(event) {
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