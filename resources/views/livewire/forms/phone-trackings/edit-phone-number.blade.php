<div>
    <x-organisms.form>
        <div>
            <x-atoms.forms.label for="name">Name</x-atoms.label>
            <x-atoms.forms.textbox  type="text" wire:model="name" value="{{ $name }}"/>            
            <x-atoms.forms.validation for="form.name"/>
        </div>
        @foreach($data['schedule'] as $key => $schedule)
        <input type="hidden" wire:model="schedid.{{$key}}" value="schedid[{{$key}}]">
        <fieldset class="block p-2.5 w-50 text-sm text-gray-900 bg-gray-700 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" > 
            <legend>  
                @if($key == 0)
                    FIRST
                @else
                    SECOND
                @endif
                    SCHEDULE
            </legend>
            <!-- <div wire:ignore.self> -->
            <x-atoms.forms.label for="xmlbins">BINS</x-atoms.label>
                <x-atoms.forms.select wire:model="xmlbins.{{$key}}">    
                    <option value="" disabled>--SELECT OPTION--</option>
                    @foreach($data['bins'] as $bin)
                        <option value="{{$bin['sid']}}">{{ $bin['name'] }}</option>
                    @endforeach
                </x-atoms.forms.select>
            <x-atoms.forms.validation for="form.xmlbins"/>
            <!-- </div>          -->
            <div class="grid grid-cols-2 gap-4">
                <x-atoms.forms.label for="startsched" class="mt-4">Start Time</x-atoms.label>
                <x-atoms.forms.label for="endsched" class="mt-4">End Time</x-atoms.label>
                
                <input type="time" wire:model="startsched.{{ $key }}"  value="startsched[{{$key}}]" 
                class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >

                
                <input type="time" wire:model="endsched.{{ $key }}"  value="endsched[{{ $key }}]"                 
                class="block p-2.5 w-50 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>
            </fieldset>
        @endforeach
    </x-organisms.form>
</div>
