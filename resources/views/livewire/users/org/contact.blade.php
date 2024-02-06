<div>

      {{-- Product --}}
      <div wire:ignore.self class="modal fade" id="product_modal" tabindex="-1" role="dialog"
      aria-labelledby="product_modalTitleId" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="product_modalTitleId">
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

    <x-bootstrap.card>
        <x-bootstrap.form method="{{ $mode == PageModeEnum::EDIT ? 'edit' : 'store' }}">

            @if ($mode == PageModeEnum::EDIT)
                <div class="row mb-5">
                    <div class="col-12 col-md-3 col-lg-3"> <p class="fw-bold mb-0 fs-6">Facilities</p> </div>

                    <div class="col-sm-12 col-md-7 d-flex flex-wrap gap-3">
                        @forelse ($contact->facilities()->available()->get() as $singleFacility)
                            <a href="{{ route('organization.facility.edit', $singleFacility) }}" class="badge badge-light">{{ $singleFacility->name }}</a>
                        @empty
                            <p class="">No facilities assigned yet!</p>
                        @endforelse
                    </div>
                </div>
            @endif

            <x-bootstrap.form.select name="salutation" label="Anrede">
                @foreach (\App\Enum\Contact\SalutationEnum::cases() as $singleSalutation)
                    <option value="{{ $singleSalutation->value }}">{{ $singleSalutation->value }}</option>
                @endforeach
            </x-bootstrap.form.select>

            <x-bootstrap.form.input name="first_name" label="Vorname" />
            <x-bootstrap.form.input name="last_name" label="Nachname" />
            <x-bootstrap.form.input name="email" label="E-Mail Adresse" type="email" />
            <x-bootstrap.form.input name="telephone" label="Telefon" />
            <x-bootstrap.form.input name="mobile" label="Mobilnummer" />
            <x-bootstrap.form.input name="street" label="Straße" />
            <x-bootstrap.form.input name="house_number" label="Hausnummer" />
            <x-bootstrap.form.input name="zip_code" label="Plz" />
            <x-bootstrap.form.input name="location" label="Ort" />

            <x-bootstrap.form.select name="position" label="Position">
                @foreach ($positions as $singlePosition)
                    <option value="{{ $singlePosition->id }}">{{ $singlePosition->name }}</option>
                @endforeach
            </x-bootstrap.form.select>

            <x-bootstrap.form.select name="status" label="Status" >
                <option value="{{ \App\Enum\Contact\StatusEnum::PENDING->value }}">{{ \App\Enum\Contact\StatusEnum::PENDING->value }}</option>
                <option value="{{ \App\Enum\Contact\StatusEnum::COMPLETED->value }}">{{ \App\Enum\Contact\StatusEnum::COMPLETED->value }}</option>
            </x-bootstrap.form.select>

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
                            @foreach ($contact_products as $key => $singleProduct )
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
                    data-bs-target="#product_modal">
                        Add Product
                    </button>
                </div>
            </div>

            {{-- <x-bootstrap.form.textarea name="notes" label="Notiz" /> --}}

            @foreach ($inputs['notes'] as $key => $note)
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

            <x-bootstrap.form.select name="assign_to" label="Benutzer zuweisen">
                @foreach ($users as $singleUser)
                    <option value="{{ $singleUser->id }}">{{ $singleUser->fullName() }}</option>
                @endforeach
            </x-bootstrap.form.select>
            <div class="row my-3">

                <div class="col-12 col-md-3 col-lg-3"></div>
                <div class="col-sm-12 col-md-7">
                    <label class="custom-switch">
                        <input type="checkbox" wire:model.defer="recieve_promotional_emails" id="recieve_promotional_emails"
                            class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Wünscht keine Werbemails</span>
                    </label>
                </div>
            </div>


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

        document.addEventListener('livewire:load', function () {
            $('#product').change(() => {
                @this.set('product', $('#product').val(), true)
            })
        })

    </script>
</div>
