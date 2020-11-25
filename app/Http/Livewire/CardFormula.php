<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Formula as WorkSpace;

class CardFormula extends Component
{

    public $formula;

    public function mount($formula)
    {
        $this->formula = $formula;
    }

    public function save($id)
    {
        $formula = WorkSpace::findOrFail($id);

        if(! $formula->users()->find(auth()->id())) {
            $formula->users()->attach(auth()->id());
        }

        $this->formula = $formula;
    }

    public function render()
    {
        return view('livewire.card-formula');
    }
}
