@extends('partials/master')

@section('content')
    
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row justify-content-center" style="margin-top: 24px;">

            <div class="row">
                <div class = "col">
                    <form action="/home/eliminar/{{$user->id}}/destroy" method="POST">
                        @csrf
                        {{-- @method('delete') --}}
                        <table class = "table table-hover">
                            <tr>
                                <th><span> Nombre </span></th>
                                <th><span> Email </span> </th>
                            </tr>
                            <tr>
                                <td> {{$user->name}}</td>
                                <td> {{$user->email}}</td>
                            </tr>
                        </table>
                        <button class="btn btn-danger " type="submit" id="confirmDelete">Confirm</button>
                    </form>
                </div>
            </div>  
            
        </div>   
    </div>
</div>
@endsection