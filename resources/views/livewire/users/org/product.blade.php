<div>
    <x-bootstrap.card>
        <x-bootstrap.form method="{{ $mode == PageModeEnum::CREATE ? 'store' : 'edit' }}">
            <x-bootstrap.form.input name="name" label="Product Name" />
            <x-bootstrap.form.input name="scope" label="Product Scope" />
            <x-bootstrap.form.input name="lesson_type" label="Product Lesson Type" />
            <x-bootstrap.form.input name="price" label="Product Price" />

            <x-bootstrap.form.button>Speichern</x-bootstrap.form.button>
        </x-bootstrap.form>
    </x-bootstrap.card>
</div>
