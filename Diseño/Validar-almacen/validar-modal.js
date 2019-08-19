// Validar Formualrio
$(document).ready(function() {
	$("#formu").click(function() {
		var clave=$("#clave_pro").val();
		var nombre=$("#nombre").val();
		var tamaño=$("#tamaño").val();
		var modelo=$("#modelo").val(); 
		var descrip=$("#descrip").val();
		var stock=$("#stock").val();
		var p_c=$("#p_c").val();
		var precio_venta=$("#precio_venta").val();
		var fechae=$("#fechae").val();
		var fecha=$("#fecha").val();
		var estado=$("#estado").val();

		if (clave=="" || clave.length<=8 || /^\s+$/.test(clave)) {
			$("#clave_pro").parent().parent().attr("class","form-group has-error");
            $("#error1").fadeIn();
            return false;
		}else if (nombre=="" || nombre.length<=10 || /^\s+$/.test(nombre)) {
			$("#nombre").parent().parent().attr("class","form-group has-error");
            $("#error2").fadeIn();
            return false;
		}else if (tamaño=="" || tamaño.length<=4 || /^\s+$/.test(nombre)) {
			$("#tamaño").parent().parent().attr("class","form-group has-error");
			$("#error3").fadeIn();
			return false;
		}else if (modelo=="" || modelo.length<=3 || /^\s+$/.test(modelo)){
			$("#modelo").parent().parent().attr("class","form-group has-error");
			$("#error4").fadeIn();
			return false;
		}else if (descrip=="" || descrip.length<=5 || /^\s+$/.test(descrip)){
			$("#descrip").parent().parent().attr("class","form-group has-error");
			$("#error5").fadeIn();
			return false;
		}else if (stock=="" || stock.length<=0 || /^\s+$/.test(stock)) {
			$("#stock").parent().parent().attr("class","form-group has-error");
			$("#error6").fadeIn();
			return false;
		}else if (p_c=="" || p_c.length<=0 || /^\s+$/.test(p_c)){
			$("#p_c").parent().parent().attr("class","form-group has-error");
			$("#error7").fadeIn();
			return false;
		}else if (precio_venta=="" || precio_venta.length<=0 || /^\s+$/.test(precio_venta)){
			$("#precio_venta").parent().parent().attr("class","form-group has-error");
			$("#error8").fadeIn();
			return false;
		}else if (fechae=="" || fechae.length<=0 || /^\s+$/.test(fechae)){
			$("#fechae").parent().parent().attr("class","form-group has-error");
			$("#error9").fadeIn();
			return false;
		}else if (fecha=="" || fecha.length<=0 || /^\s+$/.test(fecha)){
			$("#fecha").parent().parent().attr("class","form-group has-error");
			$("#error10").fadeIn();
			return false;
		}else if (estado=="" || estado.length<=2 || /^\s+$/.test(estado)){
			$("#estado").parent().parent().attr("class","form-group has-error");
			$("#error11").fadeIn();
			return false;
		}
	});
});


// Quitar estado
$("#clave_pro").click(function() {
        $("#clave_pro").parent().parent().attr("class","form-group");    
        $("#error1").fadeOut();
    });
$("#nombre").click(function() {
        $("#nombre").parent().parent().attr("class","form-group");    
        $("#error2").fadeOut();
    });

$("#tamaño").click(function() {
        $("#tamaño").parent().parent().attr("class","form-group");    
        $("#error3").fadeOut();
    });

$("#modelo").click(function() {
        $("#modelo").parent().parent().attr("class","form-group");    
        $("#error4").fadeOut();
    });

$("#descrip").click(function() {
        $("#descrip").parent().parent().attr("class","form-group");    
        $("#error5").fadeOut();
    });

$("#stock").click(function() {
        $("#stock").parent().parent().attr("class","form-group");    
        $("#error6").fadeOut();
    });

$("#p_c").click(function() {
        $("#p_c").parent().parent().attr("class","form-group");    
        $("#error7").fadeOut();
    });

$("#precio_venta").click(function() {
        $("#precio_venta").parent().parent().attr("class","form-group");    
        $("#error8").fadeOut();
    });

$("#fechae").click(function() {
        $("#fechae").parent().parent().attr("class","form-group");    
        $("#error9").fadeOut();
    });

$("#fecha").click(function() {
        $("#fecha").parent().parent().attr("class","form-group");    
        $("#error10").fadeOut();
    });

$("#estado").click(function() {
        $("#estado").parent().parent().attr("class","form-group");    
        $("#error11").fadeOut();
    });