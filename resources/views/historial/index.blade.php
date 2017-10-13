@extends('../layout')
@section('titulo')
Historial de pacientes  - SISTEMA DE DIAGNOSTICO DE ENFERMEDADES TROPICALES
@endsection
@section('css')

@endsection
@section('historial')
  class="active"
@endsection
@section('contenido')
  <div class="container-fluid">
      <div class="well card">
      <div class="card-header" data-background-color="purple">
  		<h4 class="title">Historial de pacientes</h4>
  	  </div>

      <div class="card-content table-responsive table-full-width">
		<table class="table table-hover" id="pacientes">
      <thead>
        <th data-dynatable-column="cod_pac">Codigo de paciente</th>
        <th data-dynatable-column="ci_pac">C.I.</th>
        <th data-dynatable-column="nom_pac">Nombre paciente</th>
        <th data-dynatable-column="pat_pac">Paterno</th>
        <th data-dynatable-column="mat_pac">Materno</th>
        <th data-dynatable-column="edad">Edad</th>
        <th data-dynatable-column="boton">Ver historial</th>
      </thead>
      <tbody>

      </tbody>
  	</table>

	</div>
  </div>
</div>
@endsection
@section('script')
  <script type="text/javascript">
    $(function() {
      var pacientes ={!! json_encode($pacientes->toArray()) !!};
      for (var i = 0; i < pacientes.length; i++) {
        var id=pacientes[i].id;
        var nom=pacientes[i].nom_pac;
        var pat=pacientes[i].pat_pac;
        var mat=pacientes[i].mat_pac;
        var fec=pacientes[i].fec_pac;
        var ci=pacientes[i].ci_pac;
        var gen=pacientes[i].gen_pac;
        var ocu=pacientes[i].ocu_pac;
        var tel=pacientes[i].tel_pac;
        var dir=pacientes[i].dir_pac;
        var b="'"+id+"','"+nom+"','"+pat+"','"+mat+"','"+fec+"','"+ci+"','"+gen+"','"+ocu+"','"+tel+"','"+dir+"'";
      pacientes[i].boton='<a title="Historial" class="btn btn-warning btn-raised active" href="historial/pacientes/'+pacientes[i].id+'"><i class="material-icons">history</i></a>';
    }

      $('#pacientes').dynatable({
          dataset:{records:pacientes},
      });
    });
  </script>
  <script type="text/javascript">
    function elipac(id){
        $('#eid').val(id);
      }
    function modpac(id,nom,pat,mat,fec,ci,gen,ocu,tel,dir){
            $('#mid').val(id);
            $('#mnom_pac').val(nom);
            $('#mpat_pac').val(pat);
            $('#mmat_pac').val(mat);
            $('#mfec_pac').val(fec);
            $('#mci_pac').val(ci);
            $('#mocu_pac').val(ocu);
            $('#mtel_pac').val(tel);
            $('#mdir_pac').val(dir);
            $('#mgen_pac option[value='+gen+']').attr("selected", true);
    }
    </script>
@endsection
