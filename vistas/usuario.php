<?php
    require('header.php');
?>
<div class="content-wrapper">
      
<!-- Input addon -->
<div class="card card-info">
<div class="row">
    <div class="col-4">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Registrar categorias
</button>
</div></div>

              <div class="card-header">
                <h3 class="card-title">Registro de Categorias</h3>
              </div>
              <div class="card-body">
                
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Opciones</th>
                    <th>Codigo</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Opciones</th>
                    <th>Codigo</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                  </tr>
                  </tfoot>
                </table>
                <!-- /input-group -->
              </div>
              <!-- /.card-body -->
<div class="form-group">
     <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk-circle-arrow-right"></i>Guardar</button>
</div>

            </div>
            


</div>


<?php
    require('footer.php');
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="" method="post" name="formulario" id="formulario">

        <div class="form-group row">
            <div class="col-md-6">
              <label for="">Login:</label>
              
              <input type="hidden" name="idcategoria" id="idcategoria" class="form-control" value="">
              
              <input type="text" class="form-control" id="login" name="login"  aria-hidden="true"></i>
          </div>
          <div class="col-md-6">
              <label for="">Usuario:</label>
              
              
              <input type="text" class="form-control" id="nombre" name="nombre"  aria-hidden="true">
          </div>
        <div>


        <div class="form-group row">
            <div class="col-md-6">
              <label for="">Clave:</label>
              
              
              <input type="password" class="form-control" id="password" name="password"  aria-hidden="true"></i>
          </div>
          <div class="col-md-6">
              <label for="">Correo:</label>
              
              
              <input type="text" class="form-control" id="correo" name="correo"  aria-hidden="true">
          </div>
        <div>

        <div class="row">
  <div class="col-6">
    
                            <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" width="150px" height="120px" id="imagenmuestra">
  </div>
  <div class="col-6">

     <label>Permisos:</label>
                            <ul style="list-style: none;" id="permisos" name="permisos">
                              
                            </ul>
  </div>
  
</div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="guardaryeditar();" class="btn btn-primary">Registrar Categoria</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="script/usuario.js">
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>