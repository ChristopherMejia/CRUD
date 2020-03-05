@extends('partials\master')

@section('content')

<style>
    input[type=text]:focus{
    width: 100%;
    padding: 12px 20px;
    margin: 15px 0;
    box-sizing: border-box;
    border: 3px solid #555;
    }

  #boton{
  background-color:darkorange;
  border: none;
  color: white;
  padding: 12px 62px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
  }

  .divDatos{
      margin-top: 50px
  }

</style>

<main class="main">
{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row justify-content-center" style="margin-top: 24px;">
            <div class="col-md-12">
                <div class="card">
                    <div class = "card-header">Registrar usuarios</div>
                        <div class ="card-body">
                            <div class="formulario">  
                                    <form action="home/create/user" method="POST">
                                        @csrf
                                        <div class ="form-group row">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class ="divDatos col-sm-3">
                                                <label for="nombre">NOMBRE:</label>
                                                <input type="text" name="nombre" value="{{old('nombre')}}" class= "form-control" required class = "form-control" >
                                            </div>
                                            
                                            <div class ="divDatos col-sm-3">
                                                <label for="nombre">EMAIL:</label>
                                                <input type="email" name="email" value="{{old('email')}}" class= "form-control" required class = "form-control" >
                                            </div>
                                            
                                            <div class ="divDatos col-sm-3">
                                                <label for="nombre">UID:</label>
                                                <input type="text" name="uid" value="{{old('uid')}}" class= "form-control" required class = "form-control" >
                                            </div>

                                            <div class = "row">
                                                <div class = "col">
                                                    <button id="boton" class= "btn btn-primary " type = "submit"  >Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection