<div>
    <h2 class="text-2xl font-bold text-gray-900">
        Sign up to platform
    </h2>
    <form class="mt-8 space-y-6" wire:submit="submit">
        <div>
            <x-atoms.forms.label for="company_name">Company name</x-atoms.forms.label>
            <x-atoms.forms.textbox type="company_name" name="company_name" id="company_name" wire:model="company_name"/>
            <x-atoms.forms.validation for="company_name"/>
        </div>
        <hr>
        <div>
            <x-atoms.forms.label for="name">Your Name</x-atoms.forms.label>
            <x-atoms.forms.textbox type="name" name="name" id="name" wire:model="name"/>
            <x-atoms.forms.validation for="name"/>
        </div>
        <div>
            <x-atoms.forms.label for="email">Your Email</x-atoms.forms.label>
            <x-atoms.forms.textbox type="email" name="email" id="email" wire:model="email"/>
            <x-atoms.forms.validation for="email"/>
        </div>
        <div>
            <x-atoms.forms.label for="password">Your Password</x-atoms.forms.label>
            <x-atoms.forms.textbox type="password" name="password" id="password" wire:model="password"/>
            <x-atoms.forms.validation for="password"/>
        </div>
        <div>
            <x-atoms.forms.label for="password_confirmation">Your Password Confirmation</x-atoms.forms.label>
            <x-atoms.forms.textbox type="password" name="password_confirmation" id="password_confirmation" wire:model="password_confirmation"/>
        </div>
        <x-atoms.forms.button color="success" type="submit">Register to your account</x-atoms.forms.button>
        <div class="text-sm font-medium text-gray-500">
            Already have an account? <x-atoms.forms.href href="{{ route('login') }}">Login account</x-atoms.forms.href>
        </div>
    </form>
</div>
