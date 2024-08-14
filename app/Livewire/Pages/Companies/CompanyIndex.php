<?php

namespace App\Livewire\Pages\Companies;

use App\Livewire\Traits\WithForm;
use App\Livewire\Traits\WithToast;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyIndex extends Component
{
    use WithPagination;
    use WithToast, WithForm;

    protected $listeners = [
        'companyIndexRefresh' => '$refresh',
    ];

    public function render()
    {
        // dd("something");
        // dd(Companies::cursorPaginate(15));   
        $companies = Company::paginate(50);
        return view('components.livewire.pages.companies.company-index', compact('companies'));
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
