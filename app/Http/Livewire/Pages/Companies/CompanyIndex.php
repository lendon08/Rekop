<?php

namespace App\Http\Livewire\Pages\Companies;

use App\Http\Livewire\Traits\WithForm;
use App\Http\Livewire\Traits\WithToast;
use App\Models\Company;
use Livewire\Component;

class CompanyIndex extends Component
{
    use WithToast, WithForm;

    protected $listeners = [
        'companyIndexRefresh' => '$refresh',
    ];

    public function render()
    {
        $companies = Company::paginate();
        return view('livewire.pages.companies.company-index', compact('companies'));
    }

    public function create()
    {
        $this->openForm('forms.companies.company-form');
    }

    public function update(Company $company)
    {
        $this->openForm('forms.companies.company-form', 'update', $company->toArray());
    }

    public function confirm(Company $company)
    {
        $this->openForm('forms.companies.company-form', 'destroy', $company->toArray());
    }
}
