<div class="card">
    <div class="card-header">
        <input wire:model.live="search" class="form-control" placeholder="Ingrese el número de crédito">
    </div>
    <div class="card-body">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>Nro Crédito</th>
                    <th>Socio</th>
                    <th>DNI</th>
                    <th colspan="2"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($credits as $credit)
                    <tr>
                        <td>{{$credit->number}}</td>
                        <td>{{$credit->partner->name}}</td>
                        <td>{{$credit->partner->document}}</td>
                        <td width="10px">
                            @can('authenticate.credit.edit')
                                <a class="btn btn-warning btn-sm" href="{{route('authenticate.credit.edit', $credit)}}">Visualizar</a>
                            @endcan
                        </td>
                        <td width="10px">
                            @can('authenticate.credit.disable')
                            <a class="btn btn-danger btn-sm" href="{{route('authenticate.credit.disable', $credit)}}">Eliminar</a>
                            @endcan
                            
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{$credits->links()}}
    </div>
</div>
