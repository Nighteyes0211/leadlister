<div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg d-none" id="appointment_modal-opener" data-bs-toggle="modal"
        data-bs-target="#appointment_modal">
        Launch
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="appointment_modal" tabindex="-1" role="dialog"
        aria-labelledby="appointment_modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointment_modalTitleId">
                        Create Appointment
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <x-bootstrap.form method="createAppointment">
                    <div class="modal-body">


                        <x-bootstrap.form.input name="appointment_name" label="Name"></x-bootstrap.form.input>
                        <x-bootstrap.form.input name="appointment_contact" label="Contact"></x-bootstrap.form.input>
                        <x-bootstrap.form.input type="datetime-local" name="appointment_start_date"
                            label="Start Date"></x-bootstrap.form.input>
                        <x-bootstrap.form.input type="datetime-local" name="appointment_end_date" label="End Date"></x-bootstrap.form.input>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Create Appointment</button>
                    </div>
                </x-bootstrap.form>
            </div>
        </div>
    </div>


    <x-bootstrap.card>
        <x-bootstrap.form method="{{ $mode == PageModeEnum::CREATE ? 'store' : 'edit' }}">
            <x-bootstrap.form.input name="name" label="Name" />
            <x-bootstrap.form.input name="telephone" label="Telephone" />
            <x-bootstrap.form.input name="street" label="Street" />
            <x-bootstrap.form.input name="house_number" label="House number" />
            <x-bootstrap.form.input name="zip_code" label="Zip code" />
            <x-bootstrap.form.input name="location" label="Location" />
            <div class="form-group mb-0 row justify-content-end">
                <div class="col-md-9">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" wire:model="tele_appointment"> <span
                            class="custom-control-label">Telephone appointment</span>
                    </label>
                </div>
            </div>
            <div class="form-group mb-0 row justify-content-end">
                <div class="col-md-9">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" wire:model.defer="info_material"> <span
                            class="custom-control-label">Information material</span>
                    </label>
                </div>
            </div>

            <x-bootstrap.form.select name="facility_type" label="Facility Type">
                @foreach ($facility_types as $singleFacilityType)
                    <option  value="{{ $singleFacilityType->id }}">{{ $singleFacilityType->name }}</option>
                @endforeach
            </x-bootstrap.form.select>
            <x-bootstrap.form.select name="branch" label="Branch">
                @foreach ($branches as $singleBranch)
                    <option value="{{ $singleBranch->id }}">{{ $singleBranch->name }}</option>
                @endforeach
            </x-bootstrap.form.select>
            <div>
                <div wire:ignore>
                    <x-bootstrap.form.select name="contact" class="sumoselect" label="Contact">
                        @foreach ($contacts as $singleContact)
                            <option {{ $singleContact->id == $facility?->contact_id ? 'selected' : '' }} value="{{ $singleContact->id }}">{{ $singleContact->fullName() }}</option>
                        @endforeach
                    </x-bootstrap.form.select>
                </div>

                @error('contact')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>


            @foreach ($inputs['notes'] as $key => $contact)
                <div>
                    <x-bootstrap.form.input type='tel' label='Note {{ $key + 1 }}'
                        name='inputs.notes.{{ $key }}.note'>
                        <div class="mb-3 mt-2">
                            <button class="btn btn-dark" id="noteid-{{ $key }}-add" type="button"
                                wire:click="add('notes')">Add</button>
                            @if ($key > 0)
                                <button class="btn btn-danger" id="noteid-{{ $key }}-delete" type='button'
                                    wire:click="remove({{ $key }}, 'notes')">Remove</button>
                            @endif
                        </div>
                    </x-bootstrap.form.input>
                </div>
            @endforeach


            <x-bootstrap.form.button>Submit</x-bootstrap.form.button>
        </x-bootstrap.form>
    </x-bootstrap.card>


    <script>
        document.addEventListener("livewire:load", function () {

            $('#contact').change(() => {
                @this.set('contact', $('#contact option:selected').val(), true)
            })

        })
    </script>
</div>
