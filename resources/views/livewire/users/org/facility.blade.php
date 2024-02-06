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

    {{-- Product --}}
    <div wire:ignore.self class="modal fade" id="facility_modal" tabindex="-1" role="dialog"
        aria-labelledby="facility_modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="facility_modalTitleId">
                        Product
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <x-bootstrap.form method="addProduct">
                    <div class="modal-body">

                        <div>
                            <div wire:ignore>
                                <x-bootstrap.form.select name="product" class="sumoselect" label="Product">
                                    @foreach ($products as $singleProduct)
                                        <option value="{{ $singleProduct->id }}">{{ $singleProduct->name }}</option>
                                    @endforeach
                                </x-bootstrap.form.select>
                            </div>


                            <div class="row">
                                <div class="col-12 col-md-3 col-lg-3"></div>
                                <div class="col-sm-12 col-md-7">
                                    @error($product)
                                        <p class="text-danger small">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <x-bootstrap.form.input type="number" name="product_quantity" label="Product Quantity" />

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </x-bootstrap.form>
            </div>
        </div>
    </div>

    @if ($mode == PageModeEnum::EDIT)
        @livewire('users.org.modal.create.contact')
    @endif


    <x-bootstrap.card>
        <x-bootstrap.form method="{{ $mode == PageModeEnum::CREATE ? 'store' : 'edit' }}">
            <x-bootstrap.form.input name="name" label="Name mit Rechtsform" />
            <x-bootstrap.form.input name="telephone" label="Telefon" />
            <x-bootstrap.form.input name="email" label="E-mail" />
            <x-bootstrap.form.input name="street" label="Straße" />
            <x-bootstrap.form.input name="house_number" label="Hausnummer" />
            <x-bootstrap.form.input name="zip_code" label="Plz" />
            <x-bootstrap.form.input name="location" label="Ort" />

            <x-bootstrap.form.select name="facility_type" label="Einrichtungstyp">
                <option value="" disabled selected>Bitte auswählen</option>
                @foreach ($facility_types as $singleFacilityType)
                    <option  value="{{ $singleFacilityType->id }}">{{ $singleFacilityType->name }}</option>
                @endforeach
            </x-bootstrap.form.select>

            <div >
                <div wire:ignore>
                    <x-bootstrap.form.select mb="mb-0" name="state" label="Bundesland" class="sumoselect">
                        <option value=""  selected>Bitte auswählen</option>
                        @foreach ($states as $singleState)
                            <option {{ $singleState->id == $facility?->state_id ? 'selected' : '' }} value="{{ $singleState->id }}">{{ $singleState->name }}</option>
                        @endforeach
                    </x-bootstrap.form.select>
                </div>

                <div class="row mt-2 mb-3">
                    <div class="col-12 col-md-3 col-lg-3"></div>
                    <div class="col-sm-12 col-md-7">
                        @error('state')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

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

            <div class="row mb-3">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Products</label>
                <div class="col-sm-12 col-md-7">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Scope</th>
                                <th>Lesson Type</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($facility_products as $key => $singleProduct )
                                <tr>
                                    <td>{{ $singleProduct['name'] }}</td>
                                    <td>{{ $singleProduct['scope'] }}</td>
                                    <td>{{ $singleProduct['lesson_type'] }}</td>
                                    <td>{{ $singleProduct['price'] }}</td>
                                    <td>{{ $singleProduct['quantity'] }}</td>
                                    <td>
                                        <button type="button" wire:loading.class="disabled" wire:target="removeProduct({{ $key }})"
                                            href="javascript:void(0);"
                                            wire:click="removeProduct({{ $key }})"
                                            class="btn btn-danger px-2"
                                            data-bs-original-title="Remove">
                                            <span class="feather feather-trash-2"></span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-md" id="product_modal-opener" data-bs-toggle="modal"
                    data-bs-target="#facility_modal">
                        Add Product
                    </button>
                </div>
            </div>

            <div>
                <div wire:ignore>
                    <x-bootstrap.form.select name="contact"  label="Kontakt" multiple>
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

                        @if ($mode == PageModeEnum::EDIT)
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#create_contact_modal">Create new contact</button>
                        @endif

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



            @foreach ($inputs['notes'] as $key => $singleNote)
                <div>
                    <x-bootstrap.form.textarea type='tel' label='Notiz {{ $key + 1 }}'
                        name='inputs.notes.{{ $key }}.note'>
                        <div class="mb-3 mt-2">
                            <div class="d-flex gap-2 align-items-center">
                                <button class="btn btn-dark" id="noteid-{{ $key }}-add" type="button"
                                    wire:click="add('notes')">Hinzufügen</button>
                                @if ($key > 0)
                                    <button class="btn btn-danger" id="noteid-{{ $key }}-delete" type='button'
                                        wire:click="remove({{ $key }}, 'notes')">Löschen</button>
                                @endif
                                <p class="mb-0">{{ isset($singleNote['created_by']) ? $singleNote['created_by'] . ' - ' . $singleNote['created_at'] : ''  }}</p>
                            </div>
                        </div>
                    </x-bootstrap.form.textarea>
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


            <x-bootstrap.form.button>Speichern</x-bootstrap.form.button>
        </x-bootstrap.form>
    </x-bootstrap.card>


    <script>
        document.addEventListener("livewire:load", function () {

            $("#contact").SumoSelect({
                csvDispCount: 3,
                search: true,
                searchText: 'Enter here.'
            });

            $('#contact').change(() => {
                @this.set('contact', $('#contact').val(), true)
            })

            $('#branch_contact').change(() => {
                @this.set('branch_contact', $('#branch_contact').val(), true)
            })

            $('#product').change(() => {
                @this.set('product', $('#product').val(), true)
            })

            $('#appointment_user').change(() => {
                @this.set('appointment_user', $('#appointment_user option:selected').val(), true)
            })

            $('#state').change(() => {
                @this.set('state', $('#state option:selected').val(), true)
            })

            Livewire.on('contactCreated', function (contact) {
                $('#contact')[0].sumo.add(contact.id, contact.first_name + ' ' + contact.last_name)

                $('#contact')[0].sumo.selectItem(contact.id.toString())
                $('#contact')[0].sumo.reload();
            })

        })
    </script>
</div>
