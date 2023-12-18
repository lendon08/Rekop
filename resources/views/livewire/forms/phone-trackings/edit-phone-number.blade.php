<div>
    <x-organisms.form>
        <div>
            <x-atoms.forms.label for="name">Name</x-atoms.label>
            <x-atoms.forms.textbox  type="text" wire:model="name" value="{{ $name }}"/>            
            <x-atoms.forms.validation for="form.name"/>
        </div>

        <div>
            <x-atoms.forms.label for="forwarding">Forwarding</x-atoms.label>
            <x-atoms.forms.select wire:model="forwarding" id="forwarding">    
            <option value="">--SELECT OPTION--</option>
        @foreach($data['bins'] as $bin)
        
            @if($data['call_request_url'] == $bin['request_url'])
                <option value="{{ $bin['sid'] }}" selected>{{ $bin['name'] }}</option>
            @else
                <option value="{{ $bin['sid'] }}">{{ $bin['name'] }}</option>
            @endif
        @endforeach
            </x-atoms.forms.select>
        <x-atoms.forms.validation for="form.forwarding"/>
        </div>
    </x-organisms.form>
</div>
