<?php

namespace App\Http\Livewire\Forms\Companies;

use App\Http\Livewire\Traits\WithForm;
use App\Http\Livewire\Traits\WithToast;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompanyForm extends Component
{
    use WithForm, WithToast;

    public string $title;

    public array $form = [];

    public string $action;

    public function rules()
    {
        return (new Company())->validationRules();
    }

    public function mount(string $action, array $data)
    {
        $this->form = $data;
        $this->action = $action;
    }

    public function render()
    {
        return view('livewire.forms.companies.company-form');
    }

    public function create()
    {
        $validated = $this->validate()['form'];

        $validated['owner_id'] = Auth::id();

        Company::create($validated);

        $this->closeForm();

        $this->openToast('success');

        $this->emit('companyIndexRefresh');
    }

    public function update()
    {
        $validated = $this->validate()['form'];

        Company::findOrFail($this->form['id'])->update(
            $validated
        );

        $this->closeForm();

        $this->openToast('success');

        $this->emit('companyIndexRefresh');
    }

    public function destroy()
    {
        Company::findOrFail($this->form['id'])->delete();

        $this->closeForm();

        $this->openToast('success');

        $this->emit('companyIndexRefresh');
    }

}
