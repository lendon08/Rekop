<div>
    <x-organisms.form>
        <div>
            <x-atoms.forms.label for="name">Name</x-atoms.label>
            <x-atoms.forms.textbox  type="text" wire:model="name" value="{{ $name }}"/>            
            <x-atoms.forms.validation for="form.name"/>
        </div>

        <fieldset class="block p-2.5 w-50 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" > <legend>First:</legend>
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
        <div class="grid grid-cols-2 gap-4">
            <x-atoms.forms.label for="starttime" class="mt-4">Start Time</x-atoms.label>
            <x-atoms.forms.label for="endtime" class="mt-4">End Time</x-atoms.label>

            <input type="time" wire:model="starttime" value="{{ $starttime }}"
            class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >

            
            <input type="time" wire:model="endtime" value="{{ $endtime }}"
            class="block p-2.5 w-50 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
        </div>
        </fieldset>
    </x-organisms.form>
</div>
