@extends('../layout')
@section('titulo')
  Reporte de diagnosticos - Sistema experto
@endsection
@section('css')

@endsection
@section('reportes')
  class="active"
@endsection
@section('contenido')
<div class="container-fluid">
  <center>

    <div class="row">
      <fieldset>
        <legend>Reportes</legend>
        <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{route('reporte.general')}}"><div class="card card-stats">
                <div class="card-header" data-background-color="orange">
                    <i class="material-icons">people</i>
                </div>
                <div class="card-content">
                    <p class="category">REPORTE TOTAL PACIENTES</p>
                    <h3 class="title">
                        <small></small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">edit</i>
                        <span>Reporte general</span>
                    </div>
                </div>
            </div></a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
              <a href="#"><div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="material-icons">person</i>
                </div>
                <div class="card-content">
                    <p class="category">REPORTE PACIENTE</p>
                    <h3 class="title"></h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">date_range</i> Realizados en total
                    </div>
                </div>
            </div></a>
        </div>
        <div class=" col-lg-3 col-md-6 col-sm-6">
              <a href="#"><div class="card card-stats">
                <div class="card-header" data-background-color="red">
                    <i class="material-icons">date_range</i>
                </div>
                <div class="card-content">
                    <p class="category">REPORTE RANGO DE FECHAS</p>
                    <h3 class="title"></h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i>Todos los diagnosticos
                    </div>
                </div>
            </div></a>
        </div>
        </div>
        <div class="row">
        <div class=" col-lg-3 col-md-6 col-sm-6">
              <a href="#"><div class="card card-stats">
                <div class="card-header" data-background-color="purple">
                    <i class="material-icons">library_books</i>
                </div>
                <div class="card-content">
                    <p class="category">REPORTE MENSUAL</p>
                    <h3 class="title"></h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i>Todos los diagnosticos
                    </div>
                </div>
            </div></a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
              <a href="#"><div class="card card-stats">
                <div class="card-header" data-background-color="blue">
                    <i class="material-icons">event</i>
                </div>
                <div class="card-content">
                    <p class="category"> REPORTE <br> DIARIO </p>
                    <h3 class="title"></h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">update</i> Diferentes tipos de reportes
                    </div>
                </div>
            </div></a>
        </div>
        </div>
      </fieldset>

  </div>
</div>
</center>

@endsection
@section('script')

@endsection
