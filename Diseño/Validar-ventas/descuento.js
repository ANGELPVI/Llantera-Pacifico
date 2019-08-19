// $(buscar_datos());

function buscar_datos(consulta) {
	var data=$("#des").serializeArray();
			$.ajax({
			url: '../../Control/con-ventas/vender-producto.php',
			type: 'post',
			data: data,
			success:function(re) {
			$("#datos").html(re);
		
 		}
});

}


$(document).on('keyup','#des',function() {
		var buscar=$(this).val();
		if (buscar!="") {
			buscar_datos(buscar);

		}else{
			buscar_datos();
		}	
});