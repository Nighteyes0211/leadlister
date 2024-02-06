<div>
    <x-bootstrap.card>
        <x-bootstrap.form method="edit">
            <div class="modal-body">

                <x-bootstrap.form.input name="appointment_name" label="Titel"></x-bootstrap.form.input>
                <div class="mb-3">
                    <div wire:ignore>
                        <x-bootstrap.form.select mb="mb-0" name="appointment_contact" id="appointment_contact" class="sumoselect" label="Kontakt">
                            @foreach ($contacts as $singleContact)
                                <option {{ $singleContact->id == $appointment_contact ? 'selected' : '' }}  value="{{ $singleContact->id }}">{{ $singleContact->fullName() }}</option>
                            @endforeach
                        </x-bootstrap.form.select>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12 col-md-3 col-lg-3"></div>
                        <div class="col-sm-12 col-md-7">
                            @error('appointment_contact') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
                <x-bootstrap.form.input type="datetime-local" name="appointment_start_date"
                    label="Startzeit"></x-bootstrap.form.input>
                <x-bootstrap.form.input type="datetime-local" name="appointment_end_date"
                    label="Endzeit"></x-bootstrap.form.input>

                <x-bootstrap.form.select name="appointment_user" label="Benutzer zuweisen">
                    <option value="" selected disabled>Bitte auswählen</option>
                    @foreach ($users as $singleUser)
                        <option value="{{ $singleUser->id }}">
                            {{ $singleUser->id == auth()->id() ? 'Me' : $singleUser->fullName() }}</option>
                    @endforeach
                </x-bootstrap.form.select>


                <x-bootstrap.form.select name="status" label="Status">
                    <option value="{{ \App\Enum\Appointment\StatusEnum::PENDING->value }}" >{{ \App\Enum\Appointment\StatusEnum::PENDING->label() }}</option>
                    <option value="{{ \App\Enum\Appointment\StatusEnum::DONE->value }}" >{{ \App\Enum\Appointment\StatusEnum::DONE->label() }}</option>
                </x-bootstrap.form.select>

            </div>
            <div class="d-flex justify-content-end gap-3">
                <a  class="btn btn-secondary" href="{{ route('organization.calendar') }}">
                    Zurück
                </a>
                <button type="submit" class="btn btn-primary">Speichern</button>
            </div>
        </x-bootstrap.form>
    </x-bootstrap.card>

    <script>

        document.addEventListener('DOMContentLoaded', () => {
            $('#appointment_user').change(() => {
                @this.set('appointment_user', $('#appointment_user').find('option:selected').val(), true)
            })
            $('#appointment_contact').change(() => {
                @this.set('appointment_contact', $('#appointment_contact').find('option:selected').val(), true)
            })
        })

    </script>
</div>
