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