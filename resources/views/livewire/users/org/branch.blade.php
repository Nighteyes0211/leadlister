<div>
    <x-bootstrap.card>
        <x-bootstrap.form method="{{ $mode == PageModeEnum::CREATE ? 'store' : 'edit' }}">
            <x-bootstrap.form.input name="name" label="Niederlassungsname" />
            <x-bootstrap.form.input name="street" label="Straße" />
            <x-bootstrap.form.input name="housing_number" label="Hausnummer" />
            <x-bootstrap.form.input name="zip" label="Plz" />
            <x-bootstrap.form.input name="location" label="Ort" />
            <x-bootstrap.form.input name="contact" label="Kontakt" />

            <x-bootstrap.form.button>Speichern</x-bootstrap.form.button>
        </x-bootstrap.form>
    </x-bootstrap.card>
</div>
