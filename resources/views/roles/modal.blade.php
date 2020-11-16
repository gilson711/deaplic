<div class="container">
<button type="button" class="btn btn-warning float-right mb-3" data-toggle="modal"  data-target="#addRole" >Crear Role</button>
</div>
{!! Form::open(['url' => 'roles']) !!}
{{Form::token()}}
<div class="modal fade" id="addRole" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo rol de usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nombre de rol:</label>
            <input type="text" name="name" class="form-control" id="recipient-name">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Rol</button>
      </div>
    </div>
  </div>
</div>
{!! Form::close() !!}