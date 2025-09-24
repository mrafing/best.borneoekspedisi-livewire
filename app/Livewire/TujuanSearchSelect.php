<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KotaModel;

class TujuanSearchSelect extends Component
{
    public string $search = '';
    public ?string $selectedId = null;
    public bool $showDropdown = false;

    public function updatedSearch()
    {
        $this->selectedId = null;
        $this->showDropdown = true;
    }

    public function selectKota(string $id, string $nama)
    {
        $this->selectedId = $id;
        $this->search = $nama;
        $this->showDropdown = false;

        // Kirim ke parent
        $this->dispatch('tujuan-selected', id: $id);
    }

    public function render()
    {
        $kotas = collect();

        if (strlen($this->search) > 1) {
            $kotas = KotaModel::where('nama_kota', 'like', '%' . $this->search . '%')
                ->limit(10)
                ->get();
        }

        return view('livewire.tujuan-search-select', compact('kotas'));
    }
}
