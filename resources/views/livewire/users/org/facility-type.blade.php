<div>
    <x-bootstrap.card>
        <x-bootstrap.form method="{{ $mode == PageModeEnum::EDIT ? 'edit' : 'store' }}">
            <x-bootstrap.form.input name="name" label="Name"></x-bootstrap.form.input>
            <x-bootstrap.form.button>Speichern</x-bootstrap.form.button>
        </x-bootstrap.form>
    </x-bootstrap.card>
</div>
