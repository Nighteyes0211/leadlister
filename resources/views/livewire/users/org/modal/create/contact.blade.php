<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create_contact_modal" tabindex="-1" role="dialog"
        aria-labelledby="create_contact_modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create_contact_modalTitleId">
                        Telefontermin erstellen
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <x-bootstrap.form method="store">
                    <div class="modal-body">

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

                        <x-bootstrap.form.select name="status" label="Status">
                            <option value="{{ \App\Enum\Contact\StatusEnum::PENDING->value }}">
                                {{ \App\Enum\Contact\StatusEnum::PENDING->value }}</option>
                            <option value="{{ \App\Enum\Contact\StatusEnum::COMPLETED->value }}">
                                {{ \App\Enum\Contact\StatusEnum::COMPLETED->value }}</option>
                        </x-bootstrap.form.select>

                        <x-bootstrap.form.textarea name="notes" label="Notiz" />

                        @foreach ($inputs['notes'] as $key => $note)
                            <div>
                                <x-bootstrap.form.textarea type='tel' label='Notiz {{ $key + 1 }}'
                                    name='inputs.notes.{{ $key }}.note'>
                                    <div class="mb-3 mt-2">
                                        <div class="d-flex gap-2 align-items-center">
                                            <button class="btn btn-dark" id="noteid-{{ $key }}-add"
                                                type="button" wire:click="add('notes')">Hinzufügen</button>
                                            @if ($key > 0)
                                                <button class="btn btn-danger" id="noteid-{{ $key }}-delete"
                                                    type='button'
                                                    wire:click="remove({{ $key }}, 'notes')">Löschen</button>
                                            @endif
                                            <p class="mb-0">
                                                {{ isset($singleNote['created_by']) ? $singleNote['created_by'] . ' - ' . $singleNote['created_at'] : '' }}
                                            </p>
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
                                    <input type="checkbox" wire:model.defer="recieve_promotional_emails"
                                        id="recieve_promotional_emails" class="custom-switch-input">
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
                                    <input type="radio" class="custom-control-input" name="is_internal"
                                        wire:model.defer="is_internal" value="1"> <span
                                        class="custom-control-label">Is internal</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_internal"
                                        wire:model.defer="is_internal" value="0"> <span
                                        class="custom-control-label">Is external</span>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Schließen
                        </button>
                        <button type="submit" class="btn btn-primary">Speichern</button>
                    </div>
                </x-bootstrap.form>
            </div>
        </div>
    </div>
</div>
