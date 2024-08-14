<div>
    <x-organisms.form performAction="{{ $action }}">
        <div>
            <x-atoms.forms.label for="name">Name</x-atoms.label>
            <x-atoms.forms.textbox type="text" name="name" id="name" wire:model="form.name" autocomplete="off"/>
            <x-atoms.forms.validation for="form.name"/>
        </div>
        <div>
            <x-atoms.forms.label for="location">Location</x-atoms.label>
            <x-atoms.forms.textbox type="text" name="location" id="location" wire:model="form.location" autocomplete="off"/>
            <x-atoms.forms.validation for="form.location"/>
        </div>
        <div>
            <x-atoms.forms.label for="lead_value">Lead Value</x-atoms.label>
            <x-atoms.forms.textbox type="text" name="lead_value" id="lead_value" wire:model="form.lead_value" autocomplete="off"/>
            <x-atoms.forms.validation for="form.lead_value"/>
        </div>
    </x-organisms.form>
</div>
