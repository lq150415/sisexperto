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
            <a href="{{route('reporte.general')}}" target="_blank"><div class="card card-stats">
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
              <a href="#" data-toggle="modal" data-target="#miModal"><div class="card card-stats">
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
              <a data-toggle="modal" data-target="#miModal2"><div class="card card-stats">
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
              <a href="{{route('reporte.mensual')}}" target="_blank"><div class="card card-stats">
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
              <a href="{{route('reporte.diario')}}" target="_blank"><div class="card card-stats">
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

<!-- Modal -->
    <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
<!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">REPORTE POR PACIENTES</h4>
        </div>
                          <div class="modal-body">
                            <form class="" target="_blank" action="{{route('reporte.paciente')}}" method="post">
                              {{csrf_field()}}
                            <div class="form-group">
                              <label for="">PACIENTE:</label>
                              <div class="col-lg-12">
                                <select class="form-control" name="paciente">
                                  <option value="">SELECCIONE</option>
                                  @php
                                    $pacientes=\experto\Paciente::get();
                                  @endphp
                                  @foreach ($pacientes as $paciente)
                                    <option value="{{$paciente->id}}">{{$paciente->nom_pac.' '.$paciente->pat_pac.' '.$paciente->mat_pac}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <br><br>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                          </div>
                        </div>
                        </form>

                      </div>
                    </div>


<!-- Modal -->
    <div class="modal fade" id="miModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
<!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">REPORTE POR FECHAS</h4>
        </div>
        <div class="modal-body">
          <form class="" target="_blank" action="{{route('reporte.rango')}}" method="post">
            {{csrf_field()}}
          <div class="form-group">
            <label for="">FECHA DE INICIO:</label>
            <div class="col-lg-12">
              <input type="date" class="form-control" name="inicio" value="">
            </div>
            </div>
          <div class="form-group">
            <label for="">FECHA FINAL:</label>
            <div class="col-lg-12">
              <input type="date"  class="form-control" name="fin" value="">
            </div>
          </div>
          <br><br>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">GEnerar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
          </div>
        </form>
      </div>
    </div>
@endsection
@section('script')

@endsection
