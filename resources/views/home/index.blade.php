@extends('../layout')
@section('titulo')
  Bienvenido - Usuario {{Auth::user()->nom_user.' '.Auth::user()->pat_user.' '.Auth::user()->mat_user}}
@endsection
@section('css')

@endsection
@section('inicio')
  class="active"
@endsection
@section('contenido')
<div class="container-fluid">
    <div class="row">
      <fieldset>
        <legend>Bienvenido - {{Auth::user()->nom_user.' '.Auth::user()->pat_user.' '.Auth::user()->mat_user}}</legend>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="orange">
                    <i class="material-icons">person</i>
                </div>
                <div class="card-content">
                    <p class="category">Pacientes</p>
                    <h3 class="title">1000
                        <small></small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">edit</i>
                        <span>Pacientes registrados</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="material-icons">content_paste</i>
                </div>
                <div class="card-content">
                    <p class="category">Diagnosticos</p>
                    <h3 class="title">100</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">date_range</i> Realizados en total
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="red">
                    <i class="material-icons">library_books</i>
                </div>
                <div class="card-content">
                    <p class="category">Historial</p>
                    <h3 class="title">75</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i> Realizados en total
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="blue">
                    <i class="fa fa-folder-open-o"></i>
                </div>
                <div class="card-content">
                    <p class="category">Reportes</p>
                    <h3 class="title">4</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">update</i> Diferentes tipos de reportes
                    </div>
                </div>
            </div>
        </div>
      </fieldset>
    </div>
    <div class="card">
      <img src="{{url('images/bg3.jpg')}}"  alt="">
    </div>
</div>

@endsection
@section('script')

@endsection
