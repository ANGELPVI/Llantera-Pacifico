//ver contraseñas
$(document).ready(function() {
	$('#ver').mousedown(function() {
		$('#cont').removeAttr('type');
	});

	$('#ver').mouseup(function() {
			$('#cont').attr('type','password');
		});

});

//validar ide producto
$(document).ready(function(){ 
    $("#id_p").keydown(function(event) {
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



//validar telefono
$(document).ready(function(){ 
    $("#telefono").keydown(function(event) {
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

//validar numero celular
$(document).ready(function(){ 
    $("#celular").keydown(function(event) {
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
    
//validar total de carateres en contraseña.
$(document).ready(function()  {
    var caracteres = 8;
    // $("#counter").html(caracteres);
    $("#cont").keyup(function(){
        if($(this).val().length > caracteres){
        $(this).val($(this).val().substr(0, caracteres));
        }
    var quedan = caracteres -  $(this).val().length;
    // $("#counter").html(quedan);
    // if(quedan == 0){
    //     $("#cont").addClass("completo");
    // }
    // else if(quedan <=8){
    //     $("#cont").addClass("error");
    // }
    });
});

//maximo en id
$(document).ready(function()  {
    var caracteres = 10;
    $("#id_p").keyup(function(){
        if($(this).val().length > caracteres){
        $(this).val($(this).val().substr(0, caracteres));
        }
    var quedan = caracteres -  $(this).val().length;
  
    });
});
//maximo en nombre
$(document).ready(function()  {
    var caracteres = 50;
    $("#nombre").keyup(function(){
        if($(this).val().length > caracteres){
        $(this).val($(this).val().substr(0, caracteres));
        }
    var quedan = caracteres -  $(this).val().length;
  
    });
});
//maximo cargo
$(document).ready(function()  {
    var caracteres = 50;
    $("#cargo").keyup(function(){
        if($(this).val().length > caracteres){
        $(this).val($(this).val().substr(0, caracteres));
        }
    var quedan = caracteres -  $(this).val().length;
  
    });
});
//maximo telfono
$(document).ready(function()  {
    var caracteres = 10;
    $("#telefono").keyup(function(){
        if($(this).val().length > caracteres){
        $(this).val($(this).val().substr(0, caracteres));
        }
    var quedan = caracteres -  $(this).val().length;
  
    });
});

//maximo celular
$(document).ready(function()  {
    var caracteres = 10;
    $("#celular").keyup(function(){
        if($(this).val().length > caracteres){
        $(this).val($(this).val().substr(0, caracteres));
        }
    var quedan = caracteres -  $(this).val().length;
  
    });
});
//maximo ciudad
$(document).ready(function()  {
    var caracteres = 50;
    $("#ciudad").keyup(function(){
        if($(this).val().length > caracteres){
        $(this).val($(this).val().substr(0, caracteres));
        }
    var quedan = caracteres -  $(this).val().length;
  
    });
});
//maximo colonia
$(document).ready(function()  {
    var caracteres = 50;
    $("#colonia").keyup(function(){
        if($(this).val().length > caracteres){
        $(this).val($(this).val().substr(0, caracteres));
        }
    var quedan = caracteres -  $(this).val().length;
  
    });
});
//maximo calle
$(document).ready(function()  {
    var caracteres = 50;
    $("#calle").keyup(function(){
        if($(this).val().length > caracteres){
        $(this).val($(this).val().substr(0, caracteres));
        }
    var quedan = caracteres -  $(this).val().length;
  
    });
});
//maximo rfc
$(document).ready(function()  {
    var caracteres = 13;
    $("#rfc").keyup(function(){
        if($(this).val().length > caracteres){
        $(this).val($(this).val().substr(0, caracteres));
        }
    var quedan = caracteres -  $(this).val().length;
  
    });
});



//validar campos vacios
$(document).ready(function(){
    $("#btn").click(function() {
    var clave=$("#id_p").val();
    var nombre=$("#nombre").val();
    var con=$("#cont").val();
    var car=$("#cargo").val();
    var tel=$("#telefono").val();
    var cel=$("#celular").val();
    var ciudad=$("#ciudad").val();
    var col=$("#colonia").val();
    var calle=$("#calle").val();
    var rfc=$("#rfc").val();

        if (clave == "" || clave.length<=3 || /^\s+$/.test(clave)) { 
            $("#id_p").parent().parent().attr("class","form-group has-error");
            $("#señal").fadeIn();    
            return false;

        }else if(nombre=="" || nombre.length<=5 || /^\s+$/.test(nombre)){
            $("#nombre").parent().parent().attr("class","form-group has-error");
            $("#señal1").fadeIn();
            return false;

        }else if (con=="" || con.length<=7 || /^\s+$/.test(con)) {
          $("#cont").parent().parent().attr("class","form-group has-error has-feedback");
            $("#señal2").fadeIn();
            return false;
        }else if (car=="" || car-length<=5 || /^\s+$/.test(car)) {
            $("#cargo").parent().parent().attr("class","form-group has-error");
            $("#señal3").fadeIn();
            return false;
        }else if (tel=="" || tel.length<=9 || /^\s+$/.test(tel)) {
          $("#telefono").parent().parent().attr("class","form-group has-error");
            $("#señal4").fadeIn();
            return false;
        }else if (cel=="" || cel.length<=9 || /^\s+$/.test(cel)) {
            $("#celular").parent().parent().attr("class","form-group has-error");
            $("#señal5").fadeIn();
            return false;
        }else if (ciudad=="" || ciudad<=4 || /^\s+$/.test(ciudad)) {
          $("#ciudad").parent().parent().attr("class","form-group has-error");
            $("#señal6").fadeIn();
            return false;
        }else if (col=="" || col.length<=4 || /^\s+$/.test(col)) {
          $("#colonia").parent().parent().attr("class","form-group has-error");
           $("#señal7").fadeIn();
            return false; 
        }else if (calle=="" || calle.length<=4 || /^\s+$/.test(calle)) {
          $("#calle").parent().parent().attr("class","form-group has-error");
            $("#señal8").fadeIn();
            return false;
        }else if (rfc=="" || rfc.length<=12 || /^\s+$/.test(rfc)) {
          $("#rfc").parent().parent().attr("class","form-group has-error");
            $("#señal9").fadeIn();
            return false;
        }

    })
});



    $("#id_p").click(function() {
        $("#id_p").parent().parent().attr("class","form-group");    
        $("#señal").fadeOut();
    });

      $("#nombre").click(function() {
        $("#nombre").parent().parent().attr("class","form-group");
         $("#señal1").fadeOut();
        
    });

      $("#cont").click(function() {
        $("#cont").parent().parent().attr("class","form-group");
        $("#señal2").fadeOut();
    });

      $("#cargo").click(function() {
        $("#cargo").parent().parent().attr("class","form-group");
        $("#señal3").fadeOut();
    });

      $("#telefono").click(function() {
        $("#telefono").parent().parent().attr("class","form-group");
        $("#señal4").fadeOut();
    });
       $("#celular").click(function() {
        $("#celular").parent().parent().attr("class","form-group");
        $("#señal5").fadeOut();
    });
        $("#ciudad").click(function() {
        $("#ciudad").parent().parent().attr("class","form-group");
        $("#señal6").fadeOut();
    });
         $("#colonia").click(function() {
        $("#colonia").parent().parent().attr("class","form-group");
        $("#señal7").fadeOut();
    });
          $("#calle").click(function() {
          $("#calle").parent().parent().attr("class","form-group");
        $("#señal8").fadeOut();
    });
           $("#rfc").click(function() {
          $("#rfc").parent().parent().attr("class","form-group");
        $("#señal9").fadeOut();
    });
    
