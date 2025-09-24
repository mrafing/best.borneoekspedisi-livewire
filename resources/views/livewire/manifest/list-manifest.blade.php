<div class="container-xxl flex-grow-1 container-p-y">
    {{-- <h4 class="fw-bold py-3 mb-3">Manifest</h4> --}}

    <form wire:submit="filter">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center">
                <div>
                    <button wire:click="exportPdf" type="button" class="btn btn-sm btn-danger">
                        <i class='bx bxs-file-pdf'></i> PDF
                    </button>
                    <button wire:click="exportExcel" type="button" class="btn btn-sm btn-success">
                        <i class='bx bxs-file'></i> Excel
                    </button>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class='bx bx-search'></i> Pencarian
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column flex-md-row gap-3 mb-3">
                    <div class="w-100 w-md-auto">
                        <label for="tanggalAwal" class="form-label">Tanggal</label>
                        <div class="input-group">
                            <input wire:model="tanggalAwal" type="date" id="tanggalAwal" class="form-control"
                                name="tanggalAwal" />
                            <input wire:model="tanggalAkhir" type="date" id="tanggalAkhir" class="form-control"
                                name="tanggalAkhir" />
                        </div>
                    </div>
                    <div class="w-100 w-md-auto">
                        <label for="layanan" class="form-label">Layanan</label>
                        <select wire:model="idLayanan" id="layanan" class="form-select" name="idLayanan">
                            <option value="" selected>[Semua]</option>
                            @foreach (App\Models\LayananModel::all() as $layanan)
                                <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }} -
                                    {{ $layanan->nama_komoditi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-100 w-md-auto">
                        <label for="tujuan" class="form-label">Tujuan</label>
                        @livewire('search-kota')
                    </div>
                </div>
                <div class="d-flex flex-column flex-md-row gap-3">
                    <div class="w-100 w-md-auto">
                        <label for="pembayaran" class="form-label">Pembayaran</label>
                        <select wire:model="pembayaran" id="pembayaran" class="form-select" name="pembayaran">
                            <option value="" selected>[Semua]</option>
                            <option value="CASH">CASH</option>
                            <option value="TRANSFER">TRANSFER</option>
                            <option value="TRANSFER (LUNAS)">TRANSFER (LUNAS)</option>
                        </select>
                    </div>
                    <div class="w-100 w-md-auto">
                        <label for="noResi" class="form-label">Nomor Resi</label>
                        <input wire:model="noResi" type="search" id="noResi" class="form-control" name="noResi"
                            placeholder="Masukkan nomor resi" autocomplete="off" />
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto px-1">
                            <label for="perPage">Show</label>
                        </div>
                        <div class="col-auto px-0">
                            <select wire:model.live="perPage" id="" class="form-select">
                                <option value="7" {{ $this->perPage == 7 ? 'selected' : '' }}>7</option>
                                <option value="10" {{ $this->perPage == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $this->perPage == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $this->perPage == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $this->perPage == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <input wire:model.live.debounce.300ms='search' type="search" class="form-control"
                            placeholder="Search...">
                    </div>
                    <div>
                        <small class="mb-0">
                            @if ($tanggalAwal == $tanggalAkhir)
                                <i class='bx bx-calendar'></i>
                                {{ \Carbon\Carbon::parse($tanggalAwal)->format('D, d M Y') }}
                            @else
                                <i class='bx bx-calendar'></i>
                                {{ \Carbon\Carbon::parse($tanggalAwal)->format('D, d M Y') }} -
                                {{ \Carbon\Carbon::parse($tanggalAkhir)->format('D, d M Y') }}
                            @endif
                        </small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <a href="/manifest" class="btn btn-outline-secondary">
                            <i class='bx bx-reset'></i> Muat Ulang
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap mb-3">
            <table class="table table-hover">
                <caption>
                </caption>
                <thead>
                    <tr>
                        <th>AKSI</th>
                        <th>NO RESI</th>
                        <th>LAYANAN</th>
                        <th>TUJUAN</th>
                        <th>TOTAL</th>
                        <th>PEMBAYARAN</th>
                        <th>ADMIN</th>
                        <th>TANGGAL TERIMA</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($this->listManifest as $manifest)
                        <tr>
                            <td>
                                <div class="d-flex gap-1">
                                    <div class="dropdown">
                                        <button type="button"
                                            class="btn btn-icon btn-outline-secondary btn-sm p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-icon btn-secondary btn-sm">
                                        <i class='bx bxs-printer'></i>
                                    </a>
                                    <div>
                                        <button class="btn btn-icon btn-secondary btn-sm" type="button"
                                            data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasEnd{{ $manifest->id }}"
                                            aria-controls="offcanvasEnd">
                                            <i class='bx bxs-info-circle'></i>
                                        </button>
                                        <div class="offcanvas offcanvas-end" tabindex="-1"
                                            id="offcanvasEnd{{ $manifest->id }}" aria-labelledby="offcanvasEndLabel">
                                            <div class="offcanvas-header">
                                                <h5 id="offcanvasEndLabel" class="offcanvas-title">
                                                    {{ $manifest->no_resi }}</h5>
                                                <button type="button" class="btn-close text-reset"
                                                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="offcanvas-body flex-grow-0">
                                                <div class="d-flex justify-content-between">
                                                    <div class="me-3">
                                                        <p class="mb-0">Nama Pengirim</p>
                                                        <p>{{ strtoupper($manifest->pengirim->nama_pengirim) }}</p>
                                                    </div>
                                                    <div class="me-3">
                                                        <p class="mb-0">No Hp</p>
                                                        <p>{{ strtoupper($manifest->pengirim->no_pengirim) }}</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <div class="me-3">
                                                        <p class="mb-0">Nama Penerima</p>
                                                        <p>{{ strtoupper($manifest->penerima->nama_penerima) }}</p>
                                                    </div>
                                                    <div class="me-3">
                                                        <p class="mb-0">No Hp</p>
                                                        <p>{{ strtoupper($manifest->penerima->no_penerima) }}</p>
                                                    </div>
                                                </div>

                                                <div>
                                                    <p class="mb-0">Alamat Penerima</p>
                                                    <p class="mb-0">
                                                        {{ strtoupper($manifest->penerima->alamat_penerima) }}</p>
                                                    <p>{{ strtoupper($manifest->penerima->kecamatan->nama_kecamatan) }},
                                                        {{ strtoupper($manifest->penerima->kecamatan->kota->nama_kota) }}
                                                    </p>
                                                </div>

                                                <div class="mb-3">
                                                    <p class="mb-0">Layanan</p>
                                                    <img src="{{ asset('img') }}/{{ $manifest->layanan->gambar }}"
                                                        alt="{{ $manifest->layanan->nama_layanan }}" width="120px">
                                                </div>

                                                <div>
                                                    <p class="mb-0">Komoditi</p>
                                                    <p>{{ strtoupper($manifest->layanan->nama_komoditi) }}</p>
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <div class="me-3">
                                                        <p class="mb-0">Isi Barang</p>
                                                        <p>{{ strtoupper($manifest->barang->isi) }}</p>
                                                    </div>
                                                    <div class="me-3">
                                                        <p class="mb-0">Koli</p>
                                                        <p>{{ strtoupper($manifest->barang->koli) }} Q</p>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <div class="me-3">
                                                        <p class="mb-0">Berat Aktual</p>
                                                        <p>{{ strtoupper($manifest->barang->berat_aktual) }} KG</p>
                                                    </div>
                                                    <div class="me-3">
                                                        <p class="mb-0">Berat Volumetrik</p>
                                                        <p>{{ strtoupper($manifest->barang->berat_volumetrik) }} V</p>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <div class="me-3">
                                                        <p class="mb-0">Harga Transit</p>
                                                        <p>{{ $manifest->ongkir->harga_transit == 0 ? 'Rp -' : 'Rp ' . number_format($manifest->ongkir->harga_transit, 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                    <div class="me-3">
                                                        <p class="mb-0">Harga Karantina</p>
                                                        <p>{{ $manifest->ongkir->harga_karantina == 0 ? 'Rp -' : 'Rp ' . number_format($manifest->ongkir->harga_karantina, 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between mb-3">
                                                    <div class="me-3">
                                                        <p class="mb-0">Harga Packing</p>
                                                        <p>{{ $manifest->ongkir->harga_packing == 0 ? 'Rp -' : 'Rp ' . number_format($manifest->ongkir->harga_packing, 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                    <div class="me-3">
                                                        <p class="mb-0">Harga Ongkir</p>
                                                        <p>{{ $manifest->ongkir->harga_ongkir == 0 ? 'Rp -' : 'Rp ' . number_format($manifest->ongkir->harga_ongkir, 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <div class="me-3">
                                                        <p class="mb-0">Pembayaran</p>
                                                        <p class="mb-0">
                                                            {{ strtoupper($manifest->ongkir->pembayaran) }}</p>
                                                    </div>
                                                    <div class="me-3">
                                                        <p class="mb-0">Total Ongkir</p>
                                                        <h4 class="text-danger">
                                                            {{ $manifest->ongkir->total_ongkir == 0 ? 'Rp -' : 'Rp ' . number_format($manifest->ongkir->total_ongkir, 0, ',', '.') }}
                                                        </h4>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $manifest->no_resi }}</strong>
                            </td>
                            <td><img src="{{ asset('img') }}/{{ $manifest->layanan->gambar }}" alt=""
                                    width="80"></td>
                            <td>{{ strtoupper($manifest->penerima->kecamatan->nama_kecamatan) }},
                                {{ strtoupper($manifest->penerima->kecamatan->kota->nama_kota) }}</td>
                            </td>
                            <td><span
                                    class="badge bg-label-warning me-1">{{ $manifest->ongkir->total_ongkir == 0 ? 'Rp -' : 'Rp ' . number_format($manifest->ongkir->total_ongkir, 0, ',', '.') }}</span>
                            </td>
                            <td><span
                                    class="badge bg-label-{{ $manifest->ongkir->pembayaran == 'CASH' || $manifest->ongkir->pembayaran == 'TRANSFER (LUNAS)' ? 'success' : 'danger' }} me-1">{{ $manifest->ongkir->pembayaran }}</span>
                            </td>
                            <td>{{ strtoupper($manifest->admin) }}</td>
                            <td>
                                <p class="mb-0">{{ $manifest->created_at }}</p>
                                <p class="mb-0"><small>{{ $manifest->created_at->diffForHumans() }}</small></p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-3 py-2">
            {{ $this->listManifest->links() }}
        </div>
    </div>

    <div wire:loading>
        <div
            style="position: fixed; z-index: 9999; inset: 0; background: rgba(255,255,255,0.7); display: flex; align-items: center; justify-content: center;">
            <div class="d-flex align-items-center justify-content-center h-100" style="min-height:300px;">
                <div class="demo-inline-spacing text-center">
                    <div class="spinner-grow text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
