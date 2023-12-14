<div>
    <x-bootstrap.card>
        <x-bootstrap.form method="{{ $mode == PageModeEnum::EDIT ? 'edit' : 'store' }}">

            <x-bootstrap.form.input name="first_name" label="First name" />
            <x-bootstrap.form.input name="last_name" label="Last name" />
            <x-bootstrap.form.input name="email" label="Email" type="email" />
            <x-bootstrap.form.input name="telephone" label="Telephone" />
            <x-bootstrap.form.input name="mobile" label="Mobile" />
            <x-bootstrap.form.input name="street" label="Street" />
            <x-bootstrap.form.input name="house_number" label="House number" />
            <x-bootstrap.form.input name="zip_code" label="Zip code" />
            <x-bootstrap.form.input name="location" label="Location" />
            <x-bootstrap.form.input name="position" label="Position" />
            <x-bootstrap.form.select name="status" label="Status" >
                <option value="{{ \App\Enum\Contact\StatusEnum::PENDING->value }}">{{ \App\Enum\Contact\StatusEnum::PENDING->value }}</option>
                <option value="{{ \App\Enum\Contact\StatusEnum::COMPLETED->value }}">{{ \App\Enum\Contact\StatusEnum::COMPLETED->value }}</option>
            </x-bootstrap.form.select>
            <x-bootstrap.form.textarea name="notes" label="Notes" />

            <x-bootstrap.form.select name="assign_to" label="Assign to">
                @foreach ($users as $singleUser)
                    <option value="{{ $singleUser->id }}">{{ $singleUser->fullName() }}</option>
                @endforeach
            </x-bootstrap.form.select>

            <x-bootstrap.form.button>Submit</x-bootstrap.form.button>

        </x-bootstrap.form>
    </x-bootstrap.card>
</div>
