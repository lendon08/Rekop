<div>
    <x-organisms.form>
        <div>
            <x-atoms.forms.label for="name">Name</x-atoms.label>
            <x-atoms.forms.textbox  type="text" name="name" id="name" autocomplete="off" value="{{ $data['name'] }}"/>            
            <x-atoms.forms.validation for="form.name"/>
        </div>

        <div>
            <x-atoms.forms.label for="forwarding">Forwarding</x-atoms.label>
            <x-atoms.forms.select name="forwarding" id="forwarding">    
        @foreach($data['bins'] as $bin)
        
            @if($data['call_request_url'] == $bin['request_url'])
                <option value="{{ $bin['name'] }}" selected>{{ $bin['name'] }}</option>
            @else
                <option value="{{ $bin['name'] }}">{{ $bin['name'] }}</option>
            @endif
        @endforeach
            </x-atoms.forms.select>
        <x-atoms.forms.validation for="form.forwarding"/>
        </div>
    </x-organisms.form>
</div>
