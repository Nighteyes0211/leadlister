<div>
    <x-dayone.page.header>
        <x-slot name="left">
            <x-dayone.page.title>Benutzer</x-dayone.page.title>
        </x-slot>
        <x-slot name="right">

            <x-dayone.action.list>
                @if (PageModeEnum::INDEX == $mode)
                    <x-dayone.action.btn action="user:create" title="Add new user" iconClass="feather-plus"
                        href="{{ route('organization.user.create') }}"></x-dayone.action.btn>
                @endif
            </x-dayone.action.list>

        </x-slot>
    </x-dayone.page.header>

    @if (PageModeEnum::INDEX == $mode)
        <div>
            <x-bootstrap.card>

                <x-slot name="header">
                    <h4 class="card-title">Benutzer</h4>
                </x-slot>

                <x-bootstrap.table :datatable="true">

                    <x-slot name="head">
                        <th>#</th>
                        <th>Name</th>
                        <th>Rolle(n)</th>
                        <th>Aktion</th>
                    </x-slot>

                    <x-slot name="body">

                        @foreach ($users as $singleUser)
                            <div>
                                @livewire('users.org.modal.delete.confirm', ['data' => $singleUser->id, 'modalId' => 'delete-' . $singleUser->id], key($singleUser . time()))
                            </div>
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $singleUser->fullName() }}</th>
                                <th>{{ $singleUser->roles->first()?->name }}</th>
                                <th>
                                    <x-dayone.action.list>

                                        @if (!$singleUser->hasRole(RoleEnum::SUPERADMINISTRATOR->value))
                                            <x-dayone.action.btn action="user:edit" title="Edit user"
                                                iconClass="fa fa-pencil"
                                                href="{{ route('organization.user.edit', $singleUser) }}"></x-dayone.action.btn>
                                            <x-dayone.action.btn class="btn-danger" action="user:delete"
                                                title="Delete user" iconClass="fa fa-trash" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{ $singleUser->id }}"></x-dayone.action.btn>
                                        @endif
                                    </x-dayone.action.list>
                                </th>
                            </tr>
                        @endforeach

                    </x-slot>

                </x-bootstrap.table>

            </x-bootstrap.card>
        </div>
    @else
        <div>

            <x-bootstrap.card>

                <x-slot name="header">
                    <h4 class="card-title">{{ PageModeEnum::EDIT == $mode ? 'Edit' : 'Create' }} User</h4>
                </x-slot>

                <x-bootstrap.form method="{{ PageModeEnum::EDIT == $mode ? 'edit' : 'store' }}">

                    <div class="row">
                        <div class="col-lg-6">
                            <x-bootstrap.form.input :col="false" name="first_name"
                                label="Vorname"></x-bootstrap.form.input>
                        </div>
                        <div class="col-lg-6">
                            <x-bootstrap.form.input :col="false" name="last_name"
                                label="Nachname"></x-bootstrap.form.input>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-3">
                            <x-bootstrap.form.input type="email" :col="false" name="email"
                                label="E-Mail Adresse"></x-bootstrap.form.input>
                        </div>
                        <div class="col-lg-3">
                            <x-bootstrap.form.input type="password" :col="false" name="password"
                                label="Passwort"></x-bootstrap.form.input>
                        </div>


                        <div class="col-lg-3 ">
                            <h4>Group</h4>
                            <div class="d-flex gap-3">
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

                        <div class="col-lg-3">
                            <x-bootstrap.form.select :col="false" name="role" label="Rolle">
                                @foreach ($roles as $singleRole)
                                    <option value="{{ $singleRole->name }}">{{ $singleRole->name }}</option>
                                @endforeach
                            </x-bootstrap.form.select>

                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2 align-items-center" >
                        <x-bootstrap.button size="md" class="mb-4" color="secondary" href="{{ route('organization.dashboard') }}">Zurück</x-bootstrap.button>
                        <x-bootstrap.form.button action="" :col="false">Speichern</x-bootstrap.form.button>
                    </div>
                </x-bootstrap.form>

            </x-bootstrap.card>
        </div>
    @endif

    <script>
        window.addEventListener('livewire:load', function() {
            $("#contact").change(function() {
                @this.contact = $("#contact").val()
            })
        })
    </script>
</div>
