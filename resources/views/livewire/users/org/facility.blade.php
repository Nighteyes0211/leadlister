<div>



    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="branch_modal" tabindex="-1" role="dialog"
        aria-labelledby="branch_modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="branch_modalTitleId">
                        Mutterkonzenter/Träger hinzufügen
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <x-bootstrap.form method="addBranch">
                    <div class="modal-body">


                        <x-bootstrap.form.input name="branch_name" label="Name des Konzerns/Träger" />
                        <x-bootstrap.form.input name="branch_street" label="Straße" />
                        <x-bootstrap.form.input name="branch_housing_number" label="Hausnummer" />
                        <x-bootstrap.form.input name="branch_zip" label="Plz" />
                        <x-bootstrap.form.input name="branch_location" label="Ort" />
                        <div>
                            <div wire:ignore>
                                <x-bootstrap.form.select name="branch_contact" class="sumoselect" label="Kontakt" multiple>
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
                        <button type="submit" class="btn btn-primary">Mutterkonzern/Träger hinzufügen</button>
                    </div>
                </x-bootstrap.form>
            </div>
        </div>
    </div>





    <x-bootstrap.card>
        <x-bootstrap.form method="{{ $mode == PageModeEnum::CREATE ? 'store' : 'edit' }}">
            <x-bootstrap.form.input name="name" label="Name" />
            <x-bootstrap.form.input name="telephone" label="Telefon" />
            <x-bootstrap.form.input name="email" label="E-mail" />
            <x-bootstrap.form.input name="street" label="Straße" />
            <x-bootstrap.form.input name="house_number" label="Hausnummer" />
            <x-bootstrap.form.input name="zip_code" label="Plz" />
            <x-bootstrap.form.input name="location" label="Ort" />
            {{-- <div class="form-group mb-0 row justify-content-end">
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
            </div> --}}

            <x-bootstrap.form.select name="facility_type" label="Einrichtungstyp">
                @foreach ($facility_types as $singleFacilityType)
                    <option  value="{{ $singleFacilityType->id }}">{{ $singleFacilityType->name }}</option>
                @endforeach
            </x-bootstrap.form.select>
            <x-bootstrap.form.select name="state" label="Bundesland" class="sumoselect">
                @foreach ($states as $singleState)
                    <option {{ $singleState->id == $facility?->state_id ? 'selected' : '' }} value="{{ $singleState->id }}">{{ $singleState->name }}</option>
                @endforeach
            </x-bootstrap.form.select>

            <div class="row mb-3">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Mutterkonzern/Träger</label>
                <div class="col-sm-12 col-md-7">
                    @foreach ($facility_branches as $singleBranch )
                        <p>{{ $singleBranch['name'] }}</p>
                    @endforeach

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-md" id="branch_modal-opener" data-bs-toggle="modal"
                        data-bs-target="#branch_modal">
                        Hinzufügen
                    </button>
                </div>
            </div>

            <div>
                <div wire:ignore>
                    <x-bootstrap.form.select name="contact" class="sumoselect" label="Kontakt" multiple>
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
                                @foreach ($facility->contacts()->available()->get() as $singleContact)
                                    <p>{!! ($singleContact->first_name ? $singleContact->first_name . ' ' . $singleContact->last_name : $singleContact->email ). ' | ' . ($singleContact->position ?: '<span class="text-muted">No Position</span>') . ' | ' . ($singleContact->telephone ?: '<span class="text-muted">No Telephone</span>') !!}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>



            @foreach ($inputs['notes'] as $key => $contact)
                <div>
                    <x-bootstrap.form.input type='tel' label='Notiz {{ $key + 1 }}'
                        name='inputs.notes.{{ $key }}.note'>
                        <div class="mb-3 mt-2">
                            <button class="btn btn-dark" id="noteid-{{ $key }}-add" type="button"
                                wire:click="add('notes')">Hinzufügen</button>
                            @if ($key > 0)
                                <button class="btn btn-danger" id="noteid-{{ $key }}-delete" type='button'
                                    wire:click="remove({{ $key }}, 'notes')">Löschen</button>
                            @endif
                        </div>
                    </x-bootstrap.form.input>
                </div>
            @endforeach
<!--
            <div class="row mb-5">
                <div class="col-12 col-md-3 col-lg-3">
                    <h4>Gruppe</h4>
                </div>
                <div class="col-sm-12 col-md-7 d-flex gap-3">
                    <label class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="is_internal"  wire:model.defer="is_internal" value="1"> <span
                            class="custom-control-label">Interner Mitarbeiter</span>
                    </label>
                    <label class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="is_internal"  wire:model.defer="is_internal" value="0"> <span
                            class="custom-control-label">Externer Mitarbeiter</span>
                    </label>
                </div>
            </div>

-->

            @foreach ($statuses as $singleStatus)
                <div wire:key="status-{{ $singleStatus->id }}" class="form-group mb-0 row justify-content-end">
                    <div class="col-md-9">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" wire:model.defer="status" value="{{ $singleStatus->id }}"> <span
                                class="custom-control-label">{{ $singleStatus->name }}</span>
                        </label>
                    </div>
                </div>
            @endforeach

            <div class="row mb-5">
                <div class="col-12 col-md-3 col-lg-3">
                    <h4>Group</h4>
                </div>
                <div class="col-sm-12 col-md-7 d-flex gap-3">
                    <label class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="is_internal"  wire:model.defer="is_internal" value="1"> <span
                            class="custom-control-label">Is internal</span>
                    </label>
                    <label class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="is_internal"  wire:model.defer="is_internal" value="0"> <span
                            class="custom-control-label">Is external</span>
                    </label>
                </div>
            </div>


            <x-bootstrap.form.button>Speichern</x-bootstrap.form.button>
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

            $('#state').change(() => {
                @this.set('state', $('#state option:selected').val(), true)
            })

        })
    </script>
</div>
