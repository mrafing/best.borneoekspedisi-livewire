<div class="position-relative" x-data @click.away="$wire.showDropdown = false">
    <input type="search" class="form-control" placeholder="Cari kota tujuan..." wire:model.live.debounce.300ms="search"
        autocomplete="off" @focus="$wire.showDropdown = true">

    @if ($showDropdown && strlen($search) > 1 && $kotas->count())
        <ul class="list-group position-absolute w-100 border" style="z-index: 1050; background: white;">
            @foreach ($kotas as $kota)
                <li class="list-group-item list-group-item-action border-0"
                    wire:click="selectKota({{ $kota->id }}, '{{ $kota->nama_kota }}')">
                    {{ $kota->nama_kota }}
                </li>
            @endforeach
        </ul>
    @elseif ($showDropdown && strlen($search) > 1 && $kotas->isEmpty())
        <div class="list-group position-absolute w-100" style="z-index: 1050;">
            <div class="list-group-item text-muted">Area tidak terjangkau</div>
        </div>
    @endif

    <input type="hidden" name="id_tujuan" value="{{ $selectedId }}">
</div>
