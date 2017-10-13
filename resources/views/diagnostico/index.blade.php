@extends('../layout')
@section('titulo')
  Lista de pacientes evaluados  - SISTEMA DE DIAGNOSTICO DE ENFERMEDADES TROPICALES
@endsection
@section('css')

@endsection
@section('diagnostico')
  class="active"
@endsection
@section('contenido')
  <div class="container-fluid">
      <div class="well card">
      <div class="card-header" data-background-color="purple">
  		<h4 class="title">Lista de pacientes evaluados</h4>
  	  </div>

      <div class="card-content table-responsive table-full-width">
		<table class="table table-hover" id="pacientes">
      <thead>
        <th data-dynatable-column="cod_pac">Fecha</th>
        <th data-dynatable-column="ci_pac">Codigo evaluacion</th>
        <th data-dynatable-column="nom_pac">Nombre paciente</th>
        <th data-dynatable-column="fec_pac">Diagnostico</th>
        <th data-dynatable-column="boton">Nueva evaluacion</th>
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
      pacientes[i].boton='<a title="Realizar consulta" class="btn btn-info btn-raised active" href="diagnostico/'+pacientes[i].id+'"><i class="material-icons">content_paste</i></a>';
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
