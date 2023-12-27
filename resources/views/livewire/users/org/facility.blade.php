<div>



    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="branch_modal" tabindex="-1" role="dialog"
        aria-labelledby="branch_modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="branch_modalTitleId">
                        Add Owner/Parent Company
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <x-bootstrap.form method="addBranch">
                    <div class="modal-body">


                        <x-bootstrap.form.input name="branch_name" label="Name" />
                        <x-bootstrap.form.input name="branch_street" label="Street" />
                        <x-bootstrap.form.input name="branch_housing_number" label="Housing number" />
                        <x-bootstrap.form.input name="branch_zip" label="ZIP" />
                        <x-bootstrap.form.input name="branch_location" label="Location" />
                        <div>
                            <div wire:ignore>
                                <x-bootstrap.form.select name="branch_contact" class="sumoselect" label="Contact" multiple>
                                    @foreach ($contacts as $singleContact)
                                        <option value="{{ $singleContact->id }}">{{ $singleContact->fullName() }}</option>
                                    @endforeach
                                </x-bootstrap.form.select>
                            </div>

                            @error('contact')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Add Owner/Parent Company</button>
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
                        <input type="checkbox" class="custom-control-input" wire:model.defer="tele_appointment"> <span
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

            <div class="row mb-3">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Owner/Parent Companies</label>
                <div class="col-sm-12 col-md-7">
                    @foreach ($facility_branches as $singleBranch )
                        <p>{{ $singleBranch['name'] }}</p>
                    @endforeach

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-md" id="branch_modal-opener" data-bs-toggle="modal"
                        data-bs-target="#branch_modal">
                        Add Owner/Parent Company
                    </button>
                </div>
            </div>

            <div>
                <div wire:ignore>
                    <x-bootstrap.form.select name="contact" class="sumoselect" label="Contact" multiple>
                        @foreach ($contacts as $singleContact)
                            <option {{ in_array($singleContact->id, $facility?->contacts?->pluck('id')->toArray() ?: []) ? 'selected' : '' }} value="{{ $singleContact->id }}">{{ $singleContact->fullName() }}</option>
                        @endforeach
                    </x-bootstrap.form.select>
                </div>

                <div class="row">
                    <div class="col-12 col-md-3 col-lg-3"></div>
                    <div class="col-sm-12 col-md-7">
                        @error('contact')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror


                        @if ($facility)
                            <div class="mt-2">
                                @foreach ($facility->contacts as $singleContact)
                                    <p>{!! ($singleContact->first_name ? $singleContact->first_name . ' ' . $singleContact->last_name : $singleContact->email ). ' | ' . ($singleContact->position ?: '<span class="text-muted">No Position</span>') . ' | ' . ($singleContact->telephone ?: '<span class="text-muted">No Telephone</span>') !!}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
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

            <x-bootstrap.form.select name="status" label="Status">
                <option  value="{{ \App\Enum\Facility\StatusEnum::ACTIVE->value }}">{{ \App\Enum\Facility\StatusEnum::ACTIVE->value }}</option>
                <option  value="{{ \App\Enum\Facility\StatusEnum::ARRANGE_TELEPHONE_APPOINTMENT->value }}">{{ \App\Enum\Facility\StatusEnum::ARRANGE_TELEPHONE_APPOINTMENT->value }}</option>
                <option  value="{{ \App\Enum\Facility\StatusEnum::TELEPHONE_APPOINTMENT_ARRANGED->value }}">{{ \App\Enum\Facility\StatusEnum::TELEPHONE_APPOINTMENT_ARRANGED->value }}</option>
                <option  value="{{ \App\Enum\Facility\StatusEnum::TELEPHONE_APPOINTMENT_CARRIED_OUT->value }}">{{ \App\Enum\Facility\StatusEnum::TELEPHONE_APPOINTMENT_CARRIED_OUT->value }}</option>
                <option  value="{{ \App\Enum\Facility\StatusEnum::INFORMATION_MATERIAL_IS_TO_BE_SENT->value }}">{{ \App\Enum\Facility\StatusEnum::INFORMATION_MATERIAL_IS_TO_BE_SENT->value }}</option>
                <option  value="{{ \App\Enum\Facility\StatusEnum::INFORMATION_MATERIAL_HAS_BEEN_SENT->value }}">{{ \App\Enum\Facility\StatusEnum::INFORMATION_MATERIAL_HAS_BEEN_SENT->value }}</option>
            </x-bootstrap.form.select>


            <x-bootstrap.form.button>Submit</x-bootstrap.form.button>
        </x-bootstrap.form>
    </x-bootstrap.card>


    <script>
        document.addEventListener("livewire:load", function () {

            $('#contact').change(() => {
                @this.set('contact', $('#contact').val(), true)
            })

            $('#branch_contact').change(() => {
                @this.set('branch_contact', $('#branch_contact').val(), true)
            })

            $('#appointment_user').change(() => {
                @this.set('appointment_user', $('#appointment_user option:selected').val(), true)
            })

        })
    </script>
</div>
