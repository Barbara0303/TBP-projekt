@extends('layouts.layout')
@section('title', 'Trudnoća')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection


@section('content')
<div class="container mt-4">
    <div class="container">
        <div class="table-title">
            <div class="row">
                <div class="col-xs-6">
                    <h2>Pregled <b>Trudnoće</b>
                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addDijete" idTrudnoca={{$trudnoca->trudnoca_id}} id="addD">
                            <i class="fa-solid fa-add"></i>
                        </button>
                    </h2>
                    <hr>
                    <div>
                    <span >Ime i prezime pacijentice: </span>
                        <a href="{{route('details.trudnice', $trudnica->trudnica_id)}}" id=trudnica_link> {{$trudnica->ime}} {{$trudnica->prezime}} </a><br>
                        <span>Vrsta trudnoće: {{$trudnoca->vrsta_trudnoce}}</span><br>
                        <span>Tip trudnoće: 
                            @if($trudnoca->rizicna_trudnoca === 0)
                            Nerizična
                            @elseif($trudnoca->rizicna_trudnoca === 1)
                            Rizična
                            @endif</span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @if(isset($bebe))
        @foreach($bebe as $beba)
        <table class="table table-striped table-bordered table-hover" id="dataTable">
            <thead class>
                <tr>
                    <th class="text-center">Spol</th>
                    <th class="text-center">Tezina</th>
                    <th class="text-center">Duzina</th>
                    <th class="text-center">Genetske anomalije</th>
                    <th class="text-center">Krvna grupa</th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center"> {{$beba -> spol }} </td>
                    <td class="text-center"> {{$beba -> tezina }} </td>
                    <td class="text-center"> {{$beba -> duzina }} </td>
                    <td class="text-center">
                        @if ($beba -> genetske_anomalije) Da
                        @else Ne
                        @endif
                    </td>
                    <td class="text-center">
                        @foreach($krvneGrupe as $grupa)
                        @if($grupa -> id == $beba -> krvna_grupa_id)
                        {{$grupa -> grupa }} {{$grupa -> rh_faktor }}
                        @endif
                        @endforeach
                    </td>
                    <td> <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editDijete" 
                    idDijete={{$beba->dijete_id}} id="editD"
                    spol =  {{$beba->spol}}
                    tezina = {{$beba->tezina}}
                    duzina = {{$beba->duzina}}
                    genetskeAnomalije = {{$beba->genetske_anomalije}}>
                            <i class="fa-solid fa-pen"></i>
                        </button></td>
                </tr>
            </tbody>
        </table>
        @endforeach
        @endif
    </div>


    <!-- Create -->
    <div id="addDijete" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="{{route('add.bebe')}}" id="dijeteForm">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Beba</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" id="trudId" hidden name="trudId">
                        <div class="form-group">
                            <label>Spol</label>
                            <select name="spol" class="form-control" id="spol">
                                <option value="1" disabled hidden selected>Izaberite spol</option>
                                <option value="m">Muško</option>
                                <option value="z">Žensko</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tezina</label>
                            <input type="number" class="form-control" id="tezina" required name="tezina">
                        </div>
                        <div class="form-group">
                            <label>Duzina</label>
                            <input type="number" class="form-control" id="duzina" required name="duzina">
                        </div>
                        <div class="form-group">
                            <label>Genetske anomalije</label>
                            <select name="genetskAnomalije" class="form-control" id="genetskAnomalije">
                                <option value="/" disabled hidden selected>Genetske anomalije</option>
                                <option value="0">Ne</option>
                                <option value="1">Da</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Odustani">
                        <input type="submit" class="btn btn-success" id="submit" value="Dodaj">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- update -->
<div id="editDijete" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="{{route('update.bebe')}}" id="dijeteUpdate">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Beba</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <input type="text" class="form-control" id="dijeteId" hidden name="dijeteId">
                        <label>Spol</label>
                        <select name="spol" class="form-control" id="spolE">
                            <option value="1" disabled hidden selected>Izaberite spol</option>
                            <option value="m">Muško</option>
                            <option value="z">Žensko</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tezina</label>
                        <input type="number" class="form-control" id="tezinaE" required name="tezina" value="">
                    </div>
                    <div class="form-group">
                        <label>Duzina</label>
                        <input type="number" class="form-control" id="duzinaE" required name="duzina" value="">
                    </div>
                    <div class="form-group">
                        <label>Genetske anomalije</label>
                        <select name="genetskeAnomalije" class="form-control" id="genetskeAnomalije">
                            <option value="/" disabled hidden selected>Genetske anomalije</option>
                            <option value="0">Ne</option>
                            <option value="1">Da</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Krvna grupa</label>
                        <select name="krvna_grupa" class="form-control" id="krvna_grupa">
                            <option value="1" disabled hidden selected>Izaberite krvnu grupu</option>
                            @foreach($krvneGrupe as $grupa)
                            <option value="{{$grupa->id}}">{{$grupa->grupa}} {{$grupa->rh_faktor}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Odustani">
                    <input type="submit" class="btn btn-success" id="submit" value="Spremi">
                </div>
            </form>
        </div>
    </div>
</div>
</div>



@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    $('body').on('click', '#addD', function() {
        document.getElementById("trudId").value = $(this).attr('idTrudnoca');
    });

    $('body').on('click', '#editD', function() {
        document.getElementById("spolE").value = $(this).attr('spol');
        document.getElementById("tezinaE").value = $(this).attr('tezina');
        document.getElementById("duzinaE").value = $(this).attr('duzina');
        document.getElementById("genetskeAnomalije").value = $(this).attr('genetskeAnomalije');
        document.getElementById("dijeteId").value = $(this).attr('idDijete');
    });
</script>
@endsection