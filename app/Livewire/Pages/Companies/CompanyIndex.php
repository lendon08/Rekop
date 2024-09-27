<?php

namespace App\Livewire\Pages\Companies;

use App\Livewire\Traits\WithForm;
use App\Livewire\Traits\WithToast;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Company - EZSEO')]
class CompanyIndex extends Component
{
    use WithPagination;
    use WithToast, WithForm;

    public $search;
    protected $listeners = [
        'companyIndexRefresh' => '$refresh',
    ];

    // public $companies;

    public function render()
    {
        return view('livewire.pages.companies.company-index', ['companies' => Company::latest()->where('name', 'like', "%{$this->search}%")->paginate(30)]);
    }

    public function create()
    {
        $this->openForm('forms.companies.company-form');
    }

    public function update(Company $company)
    {
        $this->openForm('forms.companies.company-form', 'update', $company->toArray());
    }

    public function destroy(Company $company)
    {
        $this->openForm('forms.companies.company-form', 'destroy', $company->toArray());
    }
}
