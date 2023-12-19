<div>

    <x-bootstrap.card>
        <x-bootstrap.form>

            <div class="row">
                <div class="col-lg-6">
                    <x-bootstrap.form.input :col="false" name="first_name"
                        label="Vorname"></x-bootstrap.form.input>
                </div>
                <div class="col-lg-6">
                    <x-bootstrap.form.input :col="false" name="last_name" label="Nachname"></x-bootstrap.form.input>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <x-bootstrap.form.input type="email" :col="false" name="email"
                        label="E-Mail Adresse"></x-bootstrap.form.input>
                </div>
                <div class="col-lg-6">
                    <x-bootstrap.form.input type="password" :col="false" name="password"
                        label="Passwort"></x-bootstrap.form.input>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 d-flex align-items-center">
                    <x-bootstrap.form.checkbox :col="false" name="is_absent"
                        label="Abwesend?"></x-bootstrap.form.checkbox>
                </div>
                <div class="col-lg-3">
                    <x-bootstrap.form.input type="datetime-local" :col="false" name="absent_from"
                        label="Abwesend von"></x-bootstrap.form.input>
                </div>
                <div class="col-lg-3">
                    <x-bootstrap.form.input type="datetime-local" :col="false" name="absent_to"
                        label="bis"></x-bootstrap.form.input>
                </div>
                <div class="col-lg-3">
                    <div>
                        <div wire:ignore>
                            <x-bootstrap.form.select :col="false" name="substitution_user" class="sumoselect" label="Vertretung">
                                @foreach ($users as $singleUser)
                                    <option {{ $singleUser->id == auth()->user()->substitution_handler ? 'selected' : '' }} value="{{ $singleUser->id }}">{{ $singleUser->fullName() }}</option>
                                @endforeach
                            </x-bootstrap.form.select>
                        </div>

                        @error('substitution_user')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="mt-4 d-flex justify-content-end gap-2 align-items-center" >
                <x-bootstrap.button size="md" class="mb-4" color="secondary" href="{{ route('organization.dashboard') }}">Back</x-bootstrap.button>
                <x-bootstrap.form.button action="" :col="false">Speichern</x-bootstrap.form.button>
            </div>
        </x-bootstrap.form>

    </x-bootstrap.card>

    <script>
        document.addEventListener("livewire:load", function () {

            $('#substitution_user').change(() => {
                @this.set('substitution_user', $('#substitution_user option:selected').val(), true)
            })

        })
    </script>
</div>
