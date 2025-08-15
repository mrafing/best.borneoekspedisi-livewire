<?php

namespace App\Livewire;

use App\Models\ManifestModel;
use Illuminate\Support\Carbon;
use Livewire\Component;
// use App\Models\Manifest;
use Livewire\Attributes\Computed;

class Manifest extends Component
{
    
    #[Computed()]
    public function list_manifest() {
        return ManifestModel::whereDate('created_at', Carbon::today())->orderBy('created_at', 'DESC')->paginate(10);
    }

    public function render()
    {
        return view('livewire.manifest');
    }
}
