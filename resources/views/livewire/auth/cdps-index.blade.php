<div class="card">
    <div class="card-body">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>Nro CDP</th>
                    <th>Socio</th>
                    <th>DNI</th>
                    <th colspan="2"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($cdps as $cdp)
                    <tr>
                        <td>{{$cdp->number}}</td>
                        <td>{{$cdp->partner->name}}</td>
                        <td>{{$cdp->partner->document}}</td>
                        <td width="10px">
                            @can('authenticate.cdp.edit')
                                <a class="btn btn-warning btn-sm" href="{{route('authenticate.cdp.edit', $cdp)}}">Visualizar</a>
                            @endcan
                        </td>
                        <td width="10px">
                            @can('authenticate.cdp.disable')
                            <a class="btn btn-danger btn-sm" href="{{route('authenticate.cdp.disable', $cdp)}}">Eliminar</a>
                            @endcan
                            
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{$cdps->links()}}
    </div>
</div>
