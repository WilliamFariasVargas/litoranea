@extends('layouts.pages')

@section('page-content')
<section class="container">
    <div class="row" style="padding-top:60px;">
        <div class="col-8">
            <h4 style="color:#003162;" class="title mt-2"><i class="fa fa-truck mx-2"></i>Cadastro de Transportadoras</h4>
        </div>
        <div class="col-4 text-end">
            <button style="background-color:#003162;" class="btn btn-primary" id="addNew"><i class="fa fa-plus mx-2"></i>Novo</button>
        </div>
        <br><br><hr>
    </div>
</section>


<section class="col-md-12 mt-2 container-fluid" id="divTable">

</section>
<script>
    $("#addNew").click(function(){
        showModal("{{route('transportadoras.form')}}");
    });

    function tblPopulate(){
        $.ajax({
            url: "{{route('transportadoras.show')}}",
            method: "GET",
            beforeSend:function(){
                $("#divTable").html("Carregando");
            },
            success:function(response){
                $("#divTable").html(response);
            },
            error: function(){
                $("#divTable").html('Erro ao carregar dados');
            }
        });
    }

    tblPopulate();


</script>
@endsection
