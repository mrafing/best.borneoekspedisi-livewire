<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card h-100">
        <h5 class="card-header">Manifest</h5>
        <div class="table-responsive text-nowrap h-100 mb-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>AKSI</th>
                        <th>NO RESI</th>
                        <th>NAMA PENGIRIM</th>
                        <th>NAMA PENERIMA</th>
                        <th>TUJUAN</th>
                        <th>KOLI</th>
                        <th>BA</th>
                        <th>BV</th>
                        <th>ISI BARANG</th>
                        <th>HARGA TRANSIT</th>
                        <th>HARGA KARANTINA</th>
                        <th>HARGA PACKING</th>
                        <th>HARGA ONGKIR</th>
                        <th>TOTAL</th>
                        <th>PEMBAYARAN</th>
                        <th>ADMIN</th>
                        <th>TANGGAL TERIMA</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($this->list_manifest as $manifest)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
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
                            </td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $manifest->no_resi }}</strong>
                            </td>
                            <td>{{ strtoupper($manifest->pengirim->nama_pengirim) }}</td>
                            <td>{{ strtoupper($manifest->penerima->nama_penerima) }}</td>
                            <td>{{ strtoupper($manifest->penerima->kecamatan->nama_kecamatan) }},
                                {{ strtoupper($manifest->penerima->kecamatan->kota->nama_kota) }}</td>
                            <td><span class="badge bg-label-dark me-1">{{ $manifest->barang->koli }} Q</span></td>
                            <td><span class="badge bg-label-primary me-1">{{ $manifest->barang->berat_aktual }}
                                    KG</span></td>
                            <td><span class="badge bg-label-info me-1">{{ $manifest->barang->berat_volumetrik }}
                                    V</span></td>
                            <td>MAKANAN</td>
                            <td>{{ $manifest->ongkir->harga_transit == 0 ? 'Rp -' : 'Rp ' . number_format($manifest->ongkir->harga_transit, 0, ',', '.') }}
                            </td>
                            <td>{{ $manifest->ongkir->harga_karantina == 0 ? 'Rp -' : 'Rp ' . number_format($manifest->ongkir->harga_karantina, 0, ',', '.') }}
                            </td>
                            <td>{{ $manifest->ongkir->harga_packing == 0 ? 'Rp -' : 'Rp ' . number_format($manifest->ongkir->harga_packing, 0, ',', '.') }}
                            </td>
                            <td>{{ $manifest->ongkir->harga_ongkir == 0 ? 'Rp -' : 'Rp ' . number_format($manifest->ongkir->harga_ongkir, 0, ',', '.') }}
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
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-3 py-2">
            {{ $this->list_manifest->links() }}
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
</div>
