<?php

namespace App\Livewire;

use App\Exports\ManifestExport;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ManifestModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Manifest extends Component
{
    use WithPagination;

    public ?string $tanggalAwal = null;
    public ?string $tanggalAkhir = null;
    public ?string $idLayanan = null;
    public ?string $idTujuan = null;
    public ?string $pembayaran = null;
    public ?string $noResi = null;
    public ?string $search = null;
    public int $perPage = 10;

    public function updatedNoResi()
    {
        $this->resetPage();
    }
    
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function filter() 
    {
        $this->resetPage();
    }
    
    public function mount()
    {
        $this->tanggalAwal = date('Y-m-d');
        $this->tanggalAkhir = date('Y-m-d');
    }

    protected $listeners = [
        'idKota' => 'setTujuan',
    ];

    public function setTujuan(string $id)
    {
        $this->idTujuan = $id;
        $this->resetPage();
    }

    #[Computed()]
    public function listManifest()
    {
        $query = ManifestModel::query();

        if ($this->tanggalAwal || $this->tanggalAkhir) 
        {
            $query->whereBetween(DB::raw('DATE(created_at)'), [
                $this->tanggalAwal ?? $this->tanggalAkhir,
                $this->tanggalAkhir ?? $this->tanggalAwal
            ]);
        }

        if ($this->idLayanan) 
        {
            $query->where('id_layanan', $this->idLayanan);
        }

        if ($this->idTujuan) 
        {
            $query->whereHas('penerima.kecamatan.kota', fn($q) => $q->where('id', $this->idTujuan));
        }

        if ($this->pembayaran) 
        {
            $query->whereHas('ongkir', fn($q) => $q->where('pembayaran', $this->pembayaran));
        }

        if ($this->noResi) 
        {
            $query->where('no_resi', 'like', '%' . $this->noResi . '%');
        }

        if ($this->search) 
        {
            $query->where(function($q) {
                $q->where('no_resi', 'like', '%' . $this->search . '%')
                  ->orWhereHas('layanan', function($q) {
                      $q->where('nama_layanan', 'like', '%' . $this->search . '%');
                  })
                  ->orWhereHas('penerima.kecamatan', function($q) {
                      $q->where('nama_kecamatan', 'like', '%' . $this->search . '%');
                  })
                  ->orWhereHas('penerima.kecamatan.kota', function($q) {
                      $q->where('nama_kota', 'like', '%' . $this->search . '%');
                  })
                  ->orWhereHas('ongkir', function($q) {
                      $q->where('total_ongkir', 'like', '%' . $this->search . '%');
                  })
                  ->orWhereHas('ongkir', function($q) {
                      $q->where('pembayaran', 'like', '%' . $this->search . '%');
                  })
                  ->orWhere('admin', 'like', '%' . $this->search . '%')
                  ->orWhere('created_at', 'like', '%' . $this->search . '%');
            });
        }

        return $query->latest()->paginate($this->perPage);
    }

    public function exportPdf()
    {
       return Excel::download(new ManifestExport($this->tanggalAwal, $this->tanggalAkhir, $this->idLayanan, $this->idTujuan, $this->pembayaran, $this->noResi), 'LAPORAN MANIFEST '. $this->tanggalAwal . ' - ' . $this->tanggalAkhir . '.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function exportExcel() 
    {
        return Excel::download(new ManifestExport($this->tanggalAwal, $this->tanggalAkhir, $this->idLayanan, $this->idTujuan, $this->pembayaran, $this->noResi), 'LAPORAN MANIFEST '. $this->tanggalAwal . ' - ' . $this->tanggalAkhir . '.xlsx');
    }

    public function placeholder()
    {
        return <<<'HTML'
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
        HTML;
    }

    public function render()
    {
        sleep(2);
        return view('livewire.manifest.list-manifest');
    }
}
