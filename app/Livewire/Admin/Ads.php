<?php

namespace App\Livewire\Admin;

use App\Models\Advertisement;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Ads extends Component
{
    use WithFileUploads;
    
    public $sliderStatus,$banner;

    #[Computed()]
    public function ads()
    {
        return Advertisement::all();
    }

    public function openSlider(){
        $this->sliderStatus = 'open';
    }

    public function closeSlider(){
        $this->sliderStatus = '';
    }

    public function publishAds()
    {
        $validated = $this->validate([
            'banner' => 'required'
        ]);

        if ($this->banner) {
            $image_path = $this->banner->store('images', 'public');;
        }

        $ad = new Advertisement();
        $ad->image = $image_path;

        if ($ad->save()) {
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Ad Created Successfully',
            ]);
        } else {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Something went wrong',
            ]);
        }
        $this->reset(['banner']);
    }

    public function deleteAd($id){
        $ad = Advertisement::find($id);

        if ($ad->delete()) {
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Ad deleted Successfully',
            ]);
        } else {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Something went wrong',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.ads');
    }
}
