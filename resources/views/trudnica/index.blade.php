@extends('layouts.layout')
@section('title', 'Pacijentice')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection


@section('content')
<div class="container mt-4">
    <div class="container">
        <div class="table-title">
            <div class="row">
                <div class="col-xs-6">
                    <h2>Pregled <b>Pacijentica</b>
                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addTrudnica">
                            <i class="fa-solid fa-add"></i>
                        </button>
                    </h2>
                </div>
            </div>
        </div>
        <hr>
        <table class="table table-striped table-bordered table-hover" id="dataTable">
            <thead class>
                <tr>
                    <th class="text-center">Pacijentica </th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($trudnice as $trudnica)
                <tr>
                    <td class="text-center"> {{ $trudnica->ime}} {{ $trudnica->prezime}}</td>
                    <td class="text-center">
                        <a href="{{route('details.trudnice', $trudnica->trudnica_id)}}" data-toggle=modal class="btn btn-light" id="detalji">
                            <i class="fa-solid fa-circle-info"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create -->
    <div id="addTrudnica" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="{{route('store.trudnice')}}" id="trudniceForm">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Dodaj novu pacijenticu</h4>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-subtitle">Osnovne informacije</h5>
                        <div class="form-group">
                            <label>Ime</label>
                            <input type="text" class="form-control" id="ime" required name="ime">
                        </div>
                        <div class="form-group">
                            <label>Prezime</label>
                            <input type="text" class="form-control" id="prezime" required name="prezime">
                        </div>
                        <div class="form-group">
                            <label>OIB</label>
                            <input type="text" class="form-control" id="oib" required name="oib">
                        </div>
                        <div class="form-group">
                            <label>Datum rođenja</label>
                            <input type="date" class="form-control" id="datum" required name="datum">
                        </div>
                        <div class="form-group">
                            <label>Kontakt broj</label>
                            <input type="text" class="form-control" id="kontaktBroj" required name="kontaktBroj">
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" class="form-control" id="email" required name="email">
                        </div>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-subtitle">Informacije</h5>
                        <div class="form-group">
                            <label>Visina</label>
                            <input type="number" class="form-control" id="visina" required name="visina">
                        </div>
                        <div class="form-group">
                            <label>Tezina</label>
                            <input type="number" class="form-control" id="tezina" required name="tezina">
                        </div>
                        <div class="form-group">
                            <label>Zadnja mjesecnica</label>
                            <input type="date" class="form-control" id="mjesecnica" required name="mjesecnica">
                        </div>
                        <div class="form-group">
                            <label>Trajanje ciklusa</label>
                            <input type="numeric" class="form-control" id="ciklus" required name="ciklus">
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
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Odustani">
                        <input type="submit" class="btn btn-success" id="submit" value="Dodaj">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection




@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection