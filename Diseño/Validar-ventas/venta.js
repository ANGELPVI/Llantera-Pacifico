	$(document).ready(function() {
			$('#formulario').submit(function(){
				var data=$(this).serializeArray();
				$.ajax({
					url: '../../Control/con-ventas/vender-producto.php',
					type: 'POST',
					data: data,
					success:function(re) {
						$("#datos").html(re);
						
					}
				});

				return false;
			});
		});

// Solo números tel
$(document).ready(function(){ 
    $("#tel").keydown(function(event) {
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
// Solo números cel
$(document).ready(function(){ 
    $("#cel").keydown(function(event) {
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

//validar campos vacios
$(document).ready(function() {
	$("#btn").click(function() {
	var ife=$("#ife").val();
	var nombre=$("#nombre").val();
	var tel=$("#tel").val();
	var cel=$("#cel").val();
	var correo=$("#correo").val();
	var dire=$("#dire").val();
	var rfc=$("#rfc").val();
	var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);

	if(ife=="" || ife.length<=17 || ife.length>18 || /^\s+$/.test(ife)){
		$("#ife").parent().parent().attr("class","form-group has-error");
            $("#error1000").fadeIn();
            return false;
	}else if (nombre=="" || nombre.length<=5 || nombre.length>40 ||/^\s+$/.test(nombre)){
		$("#nombre").parent().parent().attr("class","form-group has-error");
            $("#error1").fadeIn();
            return false;
	}else if (tel="" || tel.length<=9 || tel.length>10 || /^\s+$/.test(tel)){
		$("#tel").parent().parent().attr("class","form-group has-error");
            $("#error2").fadeIn();
            return false;
	}else if (cel=="" || cel.length<=9 || cel.length>10 || /^\s+$/.test(cel)){
		$("#cel").parent().parent().attr("class","form-group has-error");
            $("#error3").fadeIn();
            return false;
	}else if (caract.test(correo)==false){
		$("#correo").parent().parent().attr("class","form-group has-error");
            $("#error4").fadeIn();
            return false;

	}else if (dire=="" || dire.length<=8 || dire.length>80|| /^\s+$/.test(dire)){
		$("#dire").parent().parent().attr("class","form-group has-error");
            $("#error5").fadeIn();
            return false;
	}else if (rfc="" || rfc.length<=2 || rfc.length>13 || /^\s+$/.test(rfc)){
		$("#rfc").parent().parent().attr("class","form-group has-error");
            $("#error6").fadeIn();
            return false;
	}
		
	});
});


//Quitar estadode error
$("#ife").click(function() {
        $("#ife").parent().parent().attr("class","form-group");    
        $("#error1000").fadeOut();
    });
$("#nombre").click(function() {
        $("#nombre").parent().parent().attr("class","form-group");    
        $("#error1").fadeOut();
    });

$("#tel").click(function() {
        $("#tel").parent().parent().attr("class","form-group");    
        $("#error2").fadeOut();
    });

$("#cel").click(function() {
        $("#cel").parent().parent().attr("class","form-group");    
        $("#error3").fadeOut();
    });

$("#correo").click(function() {
        $("#correo").parent().parent().attr("class","form-group");    
        $("#error4").fadeOut();
    });
$("#dire").click(function() {
        $("#dire").parent().parent().attr("class","form-group");    
        $("#error5").fadeOut();
    });
$("#rfc").click(function() {
        $("#rfc").parent().parent().attr("class","form-group");    
        $("#error6").fadeOut();
    });


//validar campo de pagar si esta selecionado tipo de compra en credito
$(document).ready(function() {	
	$("#forma_pago").change(function() {
	var mivalor = $("#forma_pago").val();
	var pago=$("#pagar").val();

	 if (mivalor=="credito"){
	 	$("#pagar").attr("value","0");
	 	$("#pagar").attr("readonly","true");

	 }else if (mivalor=="decontado"){
	 	
	 	$("#pagar").removeAttr("readonly");
	 } 

 });

});


//validar campos de ventas
$(document).ready(function() {
	$("#veder").click(function() {
		var desc=$("#des").val();
		var sel=$("#forma_pago").val();
		var pa=$("#pagar").val();
		
		if (desc=="" || desc.length>=4 || /^\s+$/.test(desc)){
            $("#error").fadeIn();
			return false;
		}else if (!$('input[name="forma"]').is(':checked')){
            $("#error200").fadeIn();
			return false;

		}else if (sel=="decontado" && pa==0 || pa==""){
			 $("#error300").fadeIn();
			return false;
		}

	});
});

//validar campos de agregar producto
$(document).ready(function() {
	$("#agregar").click(function() {
		var pro=$("#codigo").val();
		if (pro=="" || pro.length<=2 || /^\s+$/.test(desc)){
			$("#error0").fadeIn();
		}
	});
});


//quitar estado de error en ventas
$("#des").click(function() {    
        $("#error").fadeOut();
        
    });

$("#pagar").click(function() {    
        $("#error300").fadeOut();
        $("#error200").fadeOut();
        
    });

$("#codigo").click(function() {    
        $("#error0").fadeOut();
        
    });