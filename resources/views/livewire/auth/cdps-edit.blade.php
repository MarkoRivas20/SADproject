
<div>

    <div class="card">
        <div class="card-body">
            <form class="relative mx-auto" autocomplete="off" wire:submit.prevent="update">
                <div class="form-group">
    
                    <label>Número</label>
                    <input type="text" class="form-control" placeholder="Ingrese el número de crédito" wire:model="number">
                    @error('number')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
    
                <div class="form-group">
                    <label>Socio</label>
                    <input class="w-full border-[1.5px] border-gray-300 bg-white h-10 px-2.5 pr-16 rounded-lg text-sm focus:outline-none focus:border-sky-500" type="text" wire:model.live.debounce.500ms="search">
                    @if ($show)
                        <ul class="absolute z-50 left-0 w-full bg-gray-100 mt-1 rounded-lg overflow-hidden border-2 border-gray-300">
                            @forelse ($this->results as $result)
                                <li class="leading-10 px-5 text-sm cursor-pointer hover:bg-gray-300" wire:click="selected({{$result->id}})">{{$result->name}}</li>
                            @empty
                                <li class="leading-10 px-5 text-sm cursor-pointer hover:bg-gray-300 text-red-500">No hay ninguna coincidencia</li>
                            @endforelse
                        </ul>
                    @endif
                    @error('socio')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    
                </div>
    
                @can('authenticate.cdp.update')
                    <button class="btn btn-primary">Actualizar CDP</button>
                @endcan
                
            </form>
    
        </div>
    </div>
    
    @if ($showMessage)
            
        <div class="bg-red-500 rounded-md px-4 py-2 font-bold text-white my-2 text-sm">
            El archivo fue borrado con éxito
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            
            <label class="block mb-2 font-semibold" for="multiple_files">Archivos</label>

            {!! Form::open(['route' => ['authenticate.cdp.upload', $cdp], 'files' => true]) !!}

                <div class="flex gap-2">
                    <div class="flex-1">
                        {!! Form::file('stock_file[]', ['class' => 'block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none', 'multiple' => true]) !!}
                        @error('stock_file') 
                            <span class="text-red-500">{{ $message }}</span> 
                        @enderror
                        @error('stock_file.*') 
                            <span class="text-red-500">{{ $message }}</span> 
                        @enderror
                    </div>
                    <div>
                        {!! Form::submit('Agregar documentos', ['class' => 'rounded-md bg-yellow-300 px-2 h-full hover:bg-yellow-300 ']) !!}
                    </div>
                </div>
            {!! Form::close() !!}

            @if ($cdp->file()->where('status',true)->get() )
                
                <hr class="mt-3 mb-2">
                <div>
                    <span class="font-bold">Documentos Cargados</span>

                    <div class="border rounded-lg mt-2">

                        @foreach ($cdp->file()->where('status',true)->get() as $file)

                            <div class="h-10 bg-gray-100 items-center px-4 cursor-pointer hover:bg-gray-200 grid grid-cols-4">
                                <div class="col-span-3">
                                    <a href="{{url('/storage/'.$file->url)}}" target="_blank" class="grid grid-cols-3"> 
                                        <div class="flex items-center gap-4">
                                            @if (str_contains($file->name, '.pdf'))
                                                <i class="fas fa-file-pdf text-red-500"></i>
                                            @else
                                                @if (str_contains($file->name, '.jpg') || str_contains($file->name, '.png') || str_contains($file->name, '.jpeg'))
                                                    <i class="far fa-file-image "></i>
                                                @else
                                                    @if (str_contains($file->name, '.doc') || str_contains($file->name, '.docx'))
                                                        <i class="fas fa-file-word text-blue-500"></i>
                                                    @else
                                                        @if (str_contains($file->name, '.xls') || str_contains($file->name, '.xlsx'))
                                                            <i class="fas fa-file-excel text-green-500"></i>
                                                        @else
                                                            <i class="fas fa-file-archive text-gray-500"></i>
                                                        @endif
                                                    @endif
                                                @endif 
                                            @endif
                                            <span class="truncate ...">
                                                {{$file->name}}
                                            </span>
                                        </div>
                                        <div class="text-center">
                                            {{$file->created_at}}
                                        </div>
                                        <span class="text-center truncate ...">
                                            {{$file->audit()->first()->user->name}}
                                        </span>
                                        
                                    </a>
                                </div>
                                <div class="text-end">
                                    <button class="rounded-md bg-red-500 text-white text-xs px-2 py-1 hover:bg-red-600" wire:click="disable({{$file->id}})"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            
                            
                        @endforeach
                    </div>

                </div>
            @endif

        </div>
    </div>
</div>