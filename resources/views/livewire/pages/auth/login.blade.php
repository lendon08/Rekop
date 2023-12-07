<div>
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
        Sign in to platform 
    </h2>
    <form class="mt-8 space-y-6" wire:submit.prevent="submit">
        <div>
            <x-atoms.forms.label for="email">Your Email</x-atoms.label>
            <x-atoms.forms.textbox type="email" name="email" id="email" wire:model="email"/>
            <x-atoms.forms.validation for="email"/>
        </div>
        <div>
            <x-atoms.forms.label for="password">Your Password</x-atoms.label>
            <x-atoms.forms.textbox type="password" name="password" id="password" wire:model="password"/>
            <x-atoms.forms.validation for="password"/>
        </div>
        <x-atoms.forms.button color="success" type="submit">Login to your account</x-atoms.forms.button>
        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
            Not registered? <x-atoms.forms.href href="{{ route('register') }}">Create account</x-atoms.forms.href>
        </div>
    </form>
</div>


