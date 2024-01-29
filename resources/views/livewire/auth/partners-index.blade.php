<div class="card">
    
    <div class="card-header">
        <input wire:model.live="search" class="form-control" placeholder="Ingrese el nombre del socio">
    </div>
    <div class="card-body">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>Registro</th>
                    <th>Nombre</th>
                    <th>DNI/RUC</th>
                    <th colspan="2"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($partners as $partner)
                    <tr>
                        <td>{{$partner->register}}</td>
                        <td>{{$partner->name}}</td>
                        <td>{{$partner->document}}</td>
                        <td width="10px">
                            @can('authenticate.partner.edit')
                            <a class="btn btn-warning btn-sm" href="{{route('authenticate.partner.edit', $partner)}}">Editar</a>
                                
                            @endcan
                        </td>
                        <td width="10px">
                            @can('authenticate.partner.disable')
                            <a class="btn btn-danger btn-sm" href="{{route('authenticate.partner.disable', $partner)}}">Eliminar</a>
                            @endcan
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{$partners->links()}}
    </div>
</div>