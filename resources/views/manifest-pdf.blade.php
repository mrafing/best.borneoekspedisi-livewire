<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Manifest</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
            font-size: 11px;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>

<body>
    <h3 style="text-align: center;">Laporan Manifest</h3>
    <p>Tanggal: {{ $listManifest->first()?->created_at->format('d-m-Y') ?? '-' }}</p>

    <table>
        <thead>
            <tr>
                <th>No Resi</th>
                <th>Pengirim</th>
                <th>Penerima</th>
                <th>Tujuan</th>
                <th>Koli</th>
                <th>BA</th>
                <th>BV</th>
                <th>Total Ongkir</th>
                <th>Pembayaran</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($listManifest as $manifest)
                <tr>
                    <td>{{ $manifest->no_resi }}</td>
                    <td>{{ $manifest->pengirim->nama_pengirim }}</td>
                    <td>{{ $manifest->penerima->nama_penerima }}</td>
                    <td>{{ $manifest->penerima->kecamatan->nama_kecamatan }},
                        {{ $manifest->penerima->kecamatan->kota->nama_kota }}</td>
                    <td>{{ $manifest->barang->koli }}</td>
                    <td>{{ $manifest->barang->berat_aktual }} KG</td>
                    <td>{{ $manifest->barang->berat_volumetrik }} V</td>
                    <td>Rp {{ number_format($manifest->ongkir->total_ongkir, 0, ',', '.') }}</td>
                    <td>{{ $manifest->ongkir->pembayaran }}</td>
                    <td>{{ $manifest->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align: center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
