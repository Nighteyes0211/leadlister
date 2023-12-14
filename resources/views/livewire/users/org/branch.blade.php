<div>
    <x-bootstrap.card>
        <x-bootstrap.form method="{{ $mode == PageModeEnum::CREATE ? 'store' : 'edit' }}">
            <x-bootstrap.form.input name="name" label="Name" />
            <x-bootstrap.form.input name="street" label="Street" />
            <x-bootstrap.form.input name="housing_number" label="Housing number" />
            <x-bootstrap.form.input name="zip" label="ZIP" />
            <x-bootstrap.form.input name="location" label="Location" />
            <x-bootstrap.form.input name="contact" label="Contact" />

            <x-bootstrap.form.button>Submit</x-bootstrap.form.button>
        </x-bootstrap.form>
    </x-bootstrap.card>
</div>
