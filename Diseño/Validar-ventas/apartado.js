//Esta pendiente
$(document).ready(function () {
	$("#btn").click(function() {
		var pro=$("#pro").val();
		var cli=$("#cli").val();
		var tel=$("#tel").val();
		var cel=$("#cel").val();
		var dire=$("#dire").val();
		var inicio=$("#inicio").val(); 
		var fin=$("#fin").val();  
        var abo=$("#abo").val();

		if (pro=="" || pro.length<=0 || /^\s+$/.test(pro)){
			$("#pro").parent().parent().attr("class","form-group has-error");
            $("#error1").fadeIn();
            return false;

		}else if (cli=="" || cli.length<=8 || /^\s+$/.test(cli)){
			$("#cli").parent().parent().attr("class","form-group has-error");
            $("#error2").fadeIn();
            return false;
		}else if (tel="" || tel.length<=9 || /^\s+$/.test(tel)){
			$("#tel").parent().parent().attr("class","form-group has-error");
            $("#error3").fadeIn();
            return false;
		}else if (cel=="" || cel.length<=9 || /^\s+$/.test(cel)){
			$("#cel").parent().parent().attr("class","form-group has-error");
            $("#error4").fadeIn();
            return false;
		}else if (dire=="" || dire.length<=8 || /^\s+$/.test(dire)){
			$("#dire").parent().parent().attr("class","form-group has-error");
            $("#error5").fadeIn();
            return false;
		}else if (inicio=="" || inicio.length<=8 || /^\s+$/.test(inicio)) {
			$("#inicio").parent().parent().attr("class","form-group has-error");
            $("#error6").fadeIn();
            return false;
		}else if (fin=="" || fin.length<=8 || /^\s+$/.test(fin)){
			$("#fin").parent().parent().attr("class","form-group has-error");
            $("#error7").fadeIn();
            return false;
		}else if (abo=="" || abo.length<=0 || /^\s+$/.test(abo)){
            $("#abo").parent().parent().attr("class","form-group has-error");
            $("#error8").fadeIn();
            return false;
        }

	});
});



//Quitar estado de error
$("#pro").click(function() {
        $("#pro").parent().parent().attr("class","form-group");    
        $("#error1").fadeOut();
    });
$("#cli").click(function() {
        $("#cli").parent().parent().attr("class","form-group");    
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
$("#dire").click(function() {
        $("#dire").parent().parent().attr("class","form-group");    
        $("#error5").fadeOut();
    });
$("#inicio").click(function() {
        $("#inicio").parent().parent().attr("class","form-group");    
        $("#error6").fadeOut();
    });
$("#fin").click(function() {
        $("#fin").parent().parent().attr("class","form-group");    
        $("#error7").fadeOut();
    });
$("#abo").click(function() {
        $("#abo").parent().parent().attr("class","form-group");    
        $("#error8").fadeOut();
    });