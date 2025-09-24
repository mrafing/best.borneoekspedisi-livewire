<?php

namespace App\Exports;

use App\Models\ManifestModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class ManifestExport implements FromView, WithEvents
{
    public ?string $tanggalAwal = null;
    public ?string $tanggalAkhir = null;
    public ?string $idLayanan = null;
    public ?string $idTujuan = null;
    public ?string $pembayaran = null;
    public ?string $noResi = null;

    public function __construct($tanggalAwal = null, $tanggalAkhir = null, $idLayanan = null, $idTujuan = null, $pembayaran = null, $noResi = null)
    {
        $this->tanggalAwal = $tanggalAwal;
        $this->tanggalAkhir = $tanggalAkhir;
        $this->idLayanan = $idLayanan;
        $this->idTujuan = $idTujuan;
        $this->pembayaran = $pembayaran;
        $this->noResi = $noResi;
    }

    public function view(): View
    {
        return view('exports.list-manifest', [
            'listManifest' => ManifestModel::whereBetween(DB::raw('DATE(created_at)'), [
                $this->tanggalAwal ?? $this->tanggalAkhir,
                $this->tanggalAkhir ?? $this->tanggalAwal
            ])->get()
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getPageSetup()
                    ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
            },
        ];
    }
}
