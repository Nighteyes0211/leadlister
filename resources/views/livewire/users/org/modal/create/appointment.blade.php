<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary btn-lg" data-bs-toggle="modal"
        data-bs-target="#appointment_modal">
        Termin erstellen
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="appointment_modal" tabindex="-1" role="dialog"
        aria-labelledby="appointment_modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointment_modalTitleId">
                        Telefontermin erstellen
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <x-bootstrap.form method="store">
                    <div class="modal-body">


                        <x-bootstrap.form.input name="appointment_name" label="Titel"></x-bootstrap.form.input>
                        {{-- <x-bootstrap.form.input name="appointment_contact" label="Kontakt"></x-bootstrap.form.input> --}}
                        <div wire:ignore>
                            <x-bootstrap.form.select name="appointment_contact" id="appointment_contact" class="sumoselect" label="Kontakt">
                                @foreach ($contacts as $singleContact)
                                    <option  value="{{ $singleContact->id }}">{{ $singleContact->fullName() }}</option>
                                @endforeach
                            </x-bootstrap.form.select>
                        </div>
                        <x-bootstrap.form.input type="datetime-local" name="appointment_start_date"
                            label="Startzeit"></x-bootstrap.form.input>
                        <x-bootstrap.form.input type="datetime-local" name="appointment_end_date"
                            label="Endzeit"></x-bootstrap.form.input>

                        <x-bootstrap.form.select name="appointment_user" class="sumoselect" label="Assign To">
                            @foreach ($users as $singleUser)
                                <option value="{{ $singleUser->id }}">
                                    {{ $singleUser->id == auth()->id() ? 'Me' : $singleUser->fullName() }}</option>
                            @endforeach
                        </x-bootstrap.form.select>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Schließen
                        </button>
                        <button type="submit" class="btn btn-primary">Erstelle Telefontermin</button>
                    </div>
                </x-bootstrap.form>
            </div>
        </div>
    </div>

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
