<table>
    <thead>
        <tr>
            <th
                style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;">
                NO</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="20">RESI</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="20">AGEN</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="20">KODE</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="20">LAYANAN</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="20">PENGIRIM</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="20">PENERIMA</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;x"
                width="80">ALAMAT</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="14">KOLI</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="14">BA</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="14">BV</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="20">ISI</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="14">TRANSIT</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="14">KARANTINA</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="14">PACKING</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="14">TOTAL</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="14">PEMBAYARAN</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="20">ADMIN</th>
            <th style="border:1px solid black; background-color: blue; color: white; text-align: center; vertical-align: middle; height: 40px;"
                width="20">TANGGAL</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($listManifest as $i => $data)
            <tr>
                <td style="vertical-align: middle; border: 1px solid black; text-align: center;">{{ $i + 1 }}
                </td>
                <td style="vertical-align: middle; border: 1px solid black; text-align: center;">
                    {{ $data->no_resi }}</td>
                <td style="vertical-align: middle; border: 1px solid black; text-align: center;">{{ 'TEST' }}
                </td>
                <td style="vertical-align: middle; border: 1px solid black; text-align: center;">{{ 'TEST' }}
                    -
                    {{ $data->penerima->kecamatan->kota->kode_kota }}</td>
                <td style="vertical-align: middle; border: 1px solid black; text-align: center;">
                    {{ $data->layanan->nama_layanan }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $data->pengirim->nama_pengirim }}
                </td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $data->penerima->nama_penerima }}
                </td>
                <td style="vertical-align: middle; border: 1px solid black; word-wrap: break-word;">
                    {{ $data->penerima->alamat_penerima }}
                    {{ $data->penerima->kecamatan->nama_kecamatan }},
                    {{ $data->penerima->kecamatan->kota->nama_kota }}</td>
                <td style="vertical-align: middle; border: 1px solid black; text-align: center;">
                    {{ $data->barang->koli }}</td>
                <td style="vertical-align: middle; border: 1px solid black; text-align: center;">
                    {{ $data->barang->berat_aktual }}</td>
                <td style="vertical-align: middle; border: 1px solid black; text-align: center;">
                    {{ $data->barang->berat_volumetrik }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $data->barang->isi }}</td>
                <td style="vertical-align: middle; border: 1px solid black; text-align: center;">
                    {{ $data->ongkir->harga_transit }}</td>
                <td style="vertical-align: middle; border: 1px solid black; text-align: center;">
                    {{ $data->ongkir->harga_karantina }}</td>
                <td style="vertical-align: middle; border: 1px solid black; text-align: center;">
                    {{ $data->ongkir->harga_packing }}</td>
                <td style="vertical-align: middle; border: 1px solid black; text-align: center;">
                    {{ $data->ongkir->total_ongkir }}</td>
                <td style="vertical-align: middle; border: 1px solid black; text-align: center;">
                    {{ $data->ongkir->pembayaran }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $data->admin }}</td>
                <td style="vertical-align: middle; border: 1px solid black; text-align: center;">
                    {{ $data->created_at }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="18">
                    <p>Data Tidak Tersedia</p>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
