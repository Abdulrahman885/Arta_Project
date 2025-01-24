<?php

namespace App\Livewire;

use App\Repositories\ListingRepository;
use App\Repositories\UserRepository;
use Livewire\Component;

class Listings extends Component
{

    private ListingRepository $ListingRepository;

    public function  mount(ListingRepository $ListingRepository)
    {
        $this->ListingRepository = $ListingRepository;
    }
    public function render()
    {
        $listings=$this->ListingRepository->index();
        return view('livewire.listings',compact('listings'));
    }
}
