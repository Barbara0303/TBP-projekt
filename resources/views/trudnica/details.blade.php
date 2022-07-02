@extends('layouts.layout')
@section('title', 'Pacijentice')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection


@section('content')
<div class="container mt-4">
    <div class="container">
        <div class="col-xs-6">
            <h2>Pacijentica <b>{{$trudnica->ime}} {{$trudnica->prezime}}</b>
                <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#pregledTrudnoca">
                    <i class="fa-solid fa-circle-info"></i>
                </button>
            </h2>
            <hr>
            <div class="col-xs-6">
                <h3>Opći podaci</h3>
                <span>Datum rođenja: {{$trudnica->datum_rodenja}}</span><br>
                <span>OIB: {{$trudnica->oib}}</span><br>
                <span>Kontakt broj: {{$trudnica->kontakt_broj}}</span><br>
                <span>E-mail: {{$trudnica->email}}</span><br>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addTrudnoca" trudId="{{$trudnica->trudnica_id}}" id="addT">
                    Dodaj trudnocu <i class="fa-solid fa-add"></i>
                </button>
            </div>
            <br>
            <h3>Zdravstveni podaci
            </h3>
            <div class="table-title">
                <div class="row">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Visina</th>
                                <th class="text-center">Težina</th>
                                <th class="text-center">Krvna grupa</th>
                                <th class="text-center">Bolesti
                                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addBolest" trudId="{{$trudnica->trudnica_id}}" id="addBolesti">
                                        <i class="fa-solid fa-add"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">{{$trudnica->visina}}</td>
                                <td class="text-center">{{$trudnica->tezina}}</td>
                                <td class="text-center">{{$krvnaGrupa->grupa}} {{$krvnaGrupa->rh_faktor}}</td>
                                <td class="text-center">
                                    @foreach($bolestiTrudnice as $bolest)
                                    <div> {{$bolest->naziv}} </div>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            @foreach($trudnoca as $tr)
            @if($tr != null && strtotime($tr->termin_porodaja) > strtotime('now'))
            <h3>Trudnoća
            <td class="text-center">
                        <a href="{{route('trudnoca', $tr->trudnoca_id)}}" data-toggle=modal class="btn btn-light" id="detaljiTrudnoce">
                            <i class="fa-solid fa-circle-info"></i></a>
                    </td>
            </h3>
            <div class="table-title">
                <div class="row">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Vrsta trudnoće</th>
                                <th class="text-center">Tip trudnoće</th>
                                <th class="text-center">Posljednja menstruacija</th>
                                <th class="text-center">Početak trudnoće</th>
                                <th class="text-center">Termin poroda</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">{{$tr->vrsta_trudnoce}}</td>
                                <td class="text-center">
                                    @if (is_null($tr->rizicna_trudnoca))
                                    @elseif($tr->rizicna_trudnoca == 0)
                                    Nerizična
                                    @else
                                    Rizična
                                    @endif
                                </td>
                                <td class="text-center">{{$trudnica->zadnja_mjesecnica}}</td>
                                <td class="text-center">{{$tr->pocetak_trudnoce}}</td>
                                <td class="text-center">{{$tr->termin_porodaja}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <h3>Kontrolni pregledi
            </h3>
            <div class="table-title">
                <div class="row">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">beta-hCG</th>
                                <th class="text-center">Hemoglobin</th>
                                <th class="text-center">Estriol</th>
                                <th class="text-center">Termin
                                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addPregled" trudnocaID="{{$tr->trudnoca_id}}" id="addP">
                                        <i class="fa-solid fa-add"></i>
                                    </button>
                                </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kontrolniPregledi as $kontroliPregled)
                            <tr>
                                <td class="text-center">
                                    @if (is_null($kontroliPregled->beta_hCG))
                                    /
                                    @elseif ($kontroliPregled->beta_hCG==0)
                                    Uredan nalaz
                                    @else
                                    Abnormalan nalaz
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if (is_null($kontroliPregled->hemoglobin))
                                    /
                                    @elseif ($kontroliPregled->hemoglobin==0)
                                    Uredan nalaz
                                    @else
                                    Abnormalan nalaz
                                    @endif</td>
                                <td class="text-center">
                                    @if (is_null($kontroliPregled->estriol))
                                    /
                                    @elseif ($kontroliPregled->estriol==0)
                                    Uredan nalaz
                                    @else
                                    Abnormalan nalaz
                                    @endif</td>
                                <td class="text-center">{{explode('.',$kontroliPregled->termin)[0]}}</td>
                                @if(now()>=$kontroliPregled->termin)
                                <td class="text-center">  
                                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editPregled" id="pregled" kontID={{$kontroliPregled->kontrola_id}}>
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                </td>
                                @else <td></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <h3>UZ
            </h3>
            <div class="table-title">
                <div class="row">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Napomene</th>
                                <th class="text-center">Termin
                                <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addUltrazvuk" id="UZ" id_trudnoca={{$tr->trudnoca_id}}>
                                        <i class="fa-solid fa-add"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ultrazvuk as $uz)
                            <tr>
                                <td class="text-center">{{$uz->napomene}}</td>
                                <td class="text-center">{{explode('.',$uz->termin)[0]}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>

<!-- Create bolesti -->
<div id="addBolest" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="{{route('store.bolesti')}}" id="bolestiForm">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Dodaj novu dijagnozu</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="id" name="id" hidden>
                        <label>Bolesti</label>
                        <select name="bolest_id" class="form-control" id="bolest_id">
                            <option value="1" disabled hidden selected>Izaberite</option>
                            @foreach($bolesti as $bolest)
                            <option value="{{$bolest->bolest_id}}">{{$bolest->naziv}}</option>
                            @endforeach
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

<!-- Pregled trudnoca -->
<div id="pregledTrudnoca" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Trudnoće</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Vrsta trudnoće</th>
                            <th class="text-center">Tip trudnoće</th>
                            <th class="text-center">Početak trudnoće</th>
                            <th class="text-center">Termin poroda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trudnoca as $trudnoce)
                        <tr>
                            <td class="text-center">{{$trudnoce->vrsta_trudnoce}}</td>
                            <td class="text-center">
                                @if ($trudnoce->rizicna_trudnoca === 1)
                                Rizična
                                @else
                                Nerizična
                                @endif
                            </td>
                            <td class="text-center">{{$trudnoce->pocetak_trudnoce}}</td>
                            <td class="text-center">{{$trudnoce->termin_porodaja}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit pregled -->
<div id="editPregled" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="{{route('update.pregled')}}" id="pregledForm">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Rezultati nalaza</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="idK" name="idK" hidden>
                        <label>Beta-hCG</label>
                        <select name="beta" class="form-control" id="beta">
                            <option value="I" disabled hidden selected>Izaberite</option>
                            <option value="0">Uredan nalaz</option>
                            <option value="1">Abnormalni nalaz</option>
                        </select>
                        <label>Hemoglobin</label>
                        <select name="hemoglobin" class="form-control" id="hemoglobin">
                            <option value="I" disabled hidden selected>Izaberite</option>
                            <option value="0">Uredan nalaz</option>
                            <option value="1">Abnormalni nalaz</option>
                        </select>
                        <label>Estriol</label>
                        <select name="estriol" class="form-control" id="estriol">
                            <option value="I" disabled hidden selected>Izaberite</option>
                            <option value="0">Uredan nalaz</option>
                            <option value="1">Abnormalni nalaz</option>
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

<!-- Create pregled -->
<div id="addPregled" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="{{route('store.pregled')}}" id="terminForm">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Novi kontrolni pregled</h4>
                </div>
                <div class="modal-body">
                <div class="form-group">
                <label> Datum </label>
                    <input type="datetime-local" class="form-control" id="termin" name="termin"></div>
                    <input type="text" class="form-control" id="trudnoca_id" name="trudnoca_id" hidden>
                </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Odustani">
                        <input type="submit" class="btn btn-success" id="submit" value="Spremi">
                    </div>
            </form>
        </div>
    </div>
</div>


<!-- Create trudnoca -->
<div id="addTrudnoca" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="{{route('store.trudnoca')}}" id="trudnocaForm">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Upiši novu trudnoću?</h4>
                </div>
                <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="idTr" name="idTr" hidden>
                    <label>Početak trudnoće </label>
                    <input type="date" class="form-control" id="pocetak" name="pocetak">
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

<!-- Create UZ -->
<div id="addUltrazvuk" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="{{route('store.ultrazvuk')}}" id="ultrazvuk">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Novi termin ultrazvuka</h4>
                </div>
                <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="trudnocaIDUZ" name="trudnocaIDUZ" hidden>
                    <label>Termin</label>
                    <input type="datetime-local" class="form-control" id="terminUZ" name="terminUZ">
                    <label>Napomene</label>
                    <input type="text" class="form-control" id="napomene" name="napomene">
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


@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

@if(Session::has('success'))
<script>
    toastr.success("{{ session('success') }}");
</script>
@elseif(Session::has('error'))
<script>
    toastr.error("{{ session('error') }}");
</script>
@endif


<script type="text/javascript">
    $("#bolestiForm").submit(function() {
        $('#bolestiForm').submit();
        $('#bolestiForm')[0].reset();
    });

    $('body').on('click', '#addBolesti', function() {
        document.getElementById("id").value = $(this).attr('trudId');
    });

    $('body').on('click', '#pregled', function() {
        document.getElementById("idK").value = $(this).attr('kontId');
    });

    $('body').on('click', '#addP', function() {
        document.getElementById("trudnoca_id").value = $(this).attr('trudnocaID');
    });

    $('body').on('click', '#addT', function() {
        document.getElementById("idTr").value = $(this).attr('trudId');
    });

    $('body').on('click', '#UZ', function() {
        document.getElementById("trudnocaIDUZ").value = $(this).attr('id_trudnoca');
    });
</script>
@endsection