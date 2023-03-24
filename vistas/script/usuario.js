var tabla;
function init(){
    limpiar();
    listar();

    
    $.post("../ajax/usuario.php?op=permisos&id=0",function(r){
        $("#permisos").html(r);
       

});


}
function verreporte(){
      window.open('../reportes/rptusuario.php', '_blank');	


}
function limpiar(){
    
        $("#idcategoria").val("");
        $("#categoria").val("");
        $("#descripcion").val("");
        
}

function guardaryeditar(){

    var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/usuario.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	         alert(datos);	          
	          
	         
	          tabla.ajax.reload();
              limpiar();
              $("#exampleModal").modal('hide');
	    }

	});

}
function activar(idcategoria){
    
    
    Swal.fire({
        title: 'Esta seguro de activar el registro?',
        text: "Se activara el registro",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Anular!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.post("../ajax/usuario.php?op=activar", {idcategoria : idcategoria}, function(e){
    //            alert(e);
    Swal.fire(
        'Anular',
        e,
        'success'
      )
                tabla.ajax.reload();
            });	
         
        }
      })
            
}
function desactivar(idcategoria){

    Swal.fire({
        title: 'Esta seguro de anular el registro?',
        text: "Se anulara el registro",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Anular!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.post("../ajax/usuario.php?op=desactivar", {idcategoria : idcategoria}, function(e){
                alert(e);
                tabla.ajax.reload();
            });	
          Swal.fire(
            'Anular',
            'El registro a sido anulado',
            'success'
          )
        }
      })

        
    }


	
function mostrar(idcategoria){

    $("#exampleModal").modal('show');

    $.post("../ajax/usuario.php?op=mostrar",{idcategoria : idcategoria}, function(data, status)
    {
        data = JSON.parse(data);
        $("#idcategoria").val(data.idcategoria);
        $("#categoria").val(data.categoria);
        $("#descripcion").val(data.descripcion);
        
        
    });
}      

function listar(){
    
    tabla=$('#example1').dataTable(
        {
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [		          
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdf'
                    ],
            "ajax":
                    {
                        url: '../ajax/usuario.php?op=listar',
                        type : "get",
                        dataType : "json",						
                        error: function(e){
                            console.log(e.responseText);	
                        }
                    },
            "bDestroy": true,
            "iDisplayLength": 50,//Paginación
            "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
        }).DataTable();
   //
}
init();