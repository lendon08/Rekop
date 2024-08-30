<main>
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="w-full mb-1">
            
            <form>
            <div class="w-full">
                <x-atoms.forms.select>
                    @foreach($regions as $region)
                        <option value="{{$region->id}}">{{$region->name}}</option>
                    @endforeach
                </x-atoms-forms-select>
            </div>

        </form>
        </div>
    </div>
</main>
