<div>
    <x-bootstrap.card>
        <x-bootstrap.form method="{{ $mode == PageModeEnum::CREATE ? 'store' : 'edit' }}">
            <x-bootstrap.form.input name="name" label="Produkt Name" />
            <x-bootstrap.form.input name="scope" label="Umfang" />
            <x-bootstrap.form.input name="lesson_type" label="Unterrichtstyp" />
            <x-bootstrap.form.input name="price" label="Preis" />

            <x-bootstrap.form.button>Speichern</x-bootstrap.form.button>
        </x-bootstrap.form>
    </x-bootstrap.card>
</div>
