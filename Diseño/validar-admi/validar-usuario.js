$(document).ready(function() {
	$("#actualizar").click(function() {
		var clave=$("#clave").val();
		var nombre=$("#nombre").val();
		var tel=$("#tel").val();
		var cel=$("#cel").val();
		var ciu=$("#ciu").val();
		var col=$("#col").val();
		var calle=$("#calle").val();

		if (clave=="" || clave.length<=3 || /^\s+$/.test(clave)){
			$("#clave").parent().parent().attr("class","form-group has-error");
			$("#error1").fadeIn();
			return false;
		}else if (nombre=="" || nombre.length<=4 || /^\s+$/.test(nombre)){
			$("#nombre").parent().parent().attr("class","form-group has-error");
			$("#error2").fadeIn();
			return false;

		}else if (tel=="" || tel.length<=9 || /^\s+$/.test(tel)){
			$("#tel").parent().parent().attr("class","form-group has-error");
			$("#error3").fadeIn();
			return false;
		}else if (cel=="" || cel.length<=9 || /^\s+$/.test(cel)){
			$("#cel").parent().parent().attr("class","form-group has-error");
			$("#error4").fadeIn();
			return false;

		}else if (ciu=="" || ciu.length<=4 || /^\s+$/.test(ciu)){
			$("#ciu").parent().parent().attr("class","form-group has-error");
			$("#error5").fadeIn();
			return false;

		}else if (col=="" || col.length<=2 || /^\s+$/.test(col)){
			$("#col").parent().parent().attr("class","form-group has-error");
			$("#error6").fadeIn();
			return false;

		}else if (calle=="" || calle.length<=2 ||  /^\s+$/.test(calle)){
			$("#calle").parent().parent().attr("class","form-group has-error");
			$("#error7").fadeIn();
			return false;

		}


	});
	
});


$("#clave").click(function() {
        $("#clave").parent().parent().attr("class","form-group");    
        $("#error1").fadeOut();
    });
$("#nombre").click(function() {
        $("#nombre").parent().parent().attr("class","form-group");    
        $("#error2").fadeOut();
    });
$("#tel").click(function() {
        $("#tel").parent().parent().attr("class","form-group");    
        $("#error3").fadeOut();
    });
$("#cel").click(function() {
        $("#cel").parent().parent().attr("class","form-group");    
        $("#error4").fadeOut();
    });
$("#ciu").click(function() {
        $("#ciu").parent().parent().attr("class","form-group");    
        $("#error5").fadeOut();
    });
$("#col").click(function() {
        $("#col").parent().parent().attr("class","form-group");    
        $("#error6").fadeOut();
    });
$("#calle").click(function() {
        $("#calle").parent().parent().attr("class","form-group");    
        $("#error7").fadeOut();
    });



