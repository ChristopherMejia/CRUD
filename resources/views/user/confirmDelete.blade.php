@extends('partials\master')

@section('content')
<main class="main">
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row justify-content-center" style="margin-top: 24px;">
            <div class = "col-md-12">
              <div class = "card">
                <div class="card-header">Desplegar Usuarios</div>
                <div class="card-body"> 
                <div class = "form-group">
                    <div class="row">
                        <div class = "col">
                          
                                <table id = "example" class = "table table-hover table-bordered">
                                    <tr> 
                                        <th><span>UID</span></th>
                                        <th><span>Nombre </span></th>
                                        <th><span>Email</span> </th>
                                        <th><span>Fecha Creacion</span></th>
                                        <th><span>Acciones</span></th>
                                    </tr>
                                    @foreach($users as $user)
                                    <tr class="data-row">
                              
                                        <td id= 'id-user'>{{$user->uid}}</td>
                                        <td id="name">{{$user->name}}</td>
                                        <td id="email">{{$user->email}}</td>
                                        <td> {{$user->created_at->todatestring()}}</td>
                                
                                        <td>
                                          <i><button type="button" data-toggle="modal" id="delete-item" class="btn btn-danger far fa-trash-alt"></button></i>
                                          <i><button type="button" data-toggle="modal" id ="edit-item" class="btn btn-primary fas fa-edit"></button></i>
                                        </td>
                    
                                    </tr>
                                    @endforeach
                              </table>
                              
                              @if (session('success'))
                                      <div class="alert alert-success">
                                          {{ session('success') }}
                                      </div>
                                  @endif
                                  @if (session('delete'))
                                  <div class="alert alert-success">
                                      {{ session('delete') }}
                                  </div>
                              @endif

                          </div>
                        </div>
                    </div>
                  </div>
                  </div>
              </div>
          </div>
    </div>
</div>
        

{{-- DELETE-MODAL --}}
<div class="modal fade" id="delete-modal">
  <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" align="center"><b>Eliminar Usuario</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form role="form" action="/home/usuario/destroy" method="post">
          @csrf 
          <div class="box-body">
              <center>
                <input type="text" id="input-name" name="input-name">
              </center> 
              <input type="hidden" id="modal-input-uidKey2" name="uidKey">  
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-danger">Eliminar</button>
          </div>
          </form>
      </div>
      </div>
  </div>
</div>

{{-- EDIT-MODAL --}}
<div class = "modal fade" id="edit-modal">
  <div class = "modal-dialog">
    <div class = "modal-content">
      <div class = "modal-header">
        <h4 class="modal-title" align="center"><b>Editar Usuario</b></h4>
        <button type="button" class ="close" data-dismiss="modal" arial-label="Close">
          <span arial-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" action="/home/usuario/edit" method="post">
          @csrf
          <div class="box-body">
            <div class="form-group">
              <label for="modal-input-name">Name</label>
              <input type="text" class="form-control" id="modal-input-name" name="name" required>
              <input type="hidden" id="modal-input-uidKey" name="uidKey">
            </div>

            <div class="form-group">
              <label for="modal-input-email">Email</label>
              <input type="text" class="form-control" id="modal-input-email" name="email" required>
              {{-- <input type="hidden" id="modal-input-uidKey" name="uidKey"> --}}
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
        </form>
      </div>

    </div>
  </div>
</div>




  <script>

  $(document).ready(function() {
        $('#example').DataTable();   
    });


//EDIT-MODEL
    $(document).on('click', "#edit-item", function() {
      $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
      $('#edit-modal').modal()
  })

  //on modal show
  $('#edit-modal').on('show.bs.modal',function(){
    var elem = $(".edit-item-trigger-clicked");
    var row = elem.closest(".data-row");

    //Get Data
    var name = row.children('#name');
    var email = row.children('#email');
    var id = row.children('#id-user');

    $("#modal-input-name").val(name[0]['innerHTML']);
    $("#modal-input-email").val(email[0]['innerHTML']);
    $("#modal-input-uidKey").val(id[0]['innerHTML']);

  })

    $('#edit-modal').on('hide.bs.modal', function() {
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#edit-form").trigger("reset");

  })




    //MODEL-DELETE
  $(document).on('click', "#delete-item", function() {
    $(this).addClass('delete-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
    $('#delete-modal').modal()
  })


   // on modal show
  $('#delete-modal').on('show.bs.modal', function() {
      var el = $(".delete-item-trigger-clicked"); // See how its usefull right here?
      var row = el.closest(".data-row"); 

      // get the data
      var name = row.children('#name');
      var id = row.children('#id-user');
      
      // fill the data in the input fields     
      $("#input-name").val(name[0]['innerHTML']);
      $("#modal-input-uidKey2").val(id[0]['innerHTML']); 

  })

   // on modal hide
  $('#delete-modal').on('hide.bs.modal', function() {
    $('.delete-item-trigger-clicked').removeClass('delete-item-trigger-clicked')
    $("#delete-form").trigger("reset");
  })


  </script>
@endsection