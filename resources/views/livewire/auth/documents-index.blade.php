<div class="card">
    
    <div class="card-header">
        <input wire:model.live="search" class="form-control" placeholder="Ingrese el nombre del documento">
    </div>
    <div class="card-body">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($documents as $document)
                    <tr>
                        <td>
                            <div class="flex items-center gap-4">
                                @if (str_contains($document->file->name, '.pdf'))
                                    <i class="fas fa-file-pdf text-danger"></i>
                                @else
                                    @if (str_contains($document->file->name, '.jpg') || str_contains($document->file->name, '.png') || str_contains($document->file->name, '.jpeg'))
                                        <i class="far fa-file-image "></i>
                                    @else
                                        @if (str_contains($document->file->name, '.doc') || str_contains($document->file->name, '.docx'))
                                            <i class="fas fa-file-word text-primary"></i>
                                        @else
                                            @if (str_contains($document->file->name, '.xls') || str_contains($document->file->name, '.xlsx'))
                                                <i class="fas fa-file-excel text-success"></i>
                                            @else
                                                <i class="fas fa-file-archive text-secondary"></i>
                                            @endif
                                        @endif
                                    @endif 
                                @endif
                                <a href="{{url('/storage/'.$document->file->url)}}" target="_blank">
                                    {{$document->name}}
                                </a>
                            </div>
                        </td>
                        <td>{{$document->created_at}}</td>
                        <td>{{$document->user->name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>