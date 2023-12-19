<div>
    @if (PageModeEnum::INDEX == $mode)

        <x-bootstrap.card>

            <x-slot name="header">
                <h4 class="card-title">Rollen</h4>
            </x-slot>

            <x-bootstrap.table :datatable="true">

                <x-slot name="head">
                    <th>#</th>
                    <th>Name</th>
                    <th>Aktion</th>
                </x-slot>

                <x-slot name="body">

                    @foreach ($roles as $singleRole)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <th>{{ $singleRole->name }}</th>
                            <th>
                                <x-dayone.action.list>
                                    <x-dayone.action.btn action="role:edit" title="Edit role" iconClass="fa fa-pencil"
                                        href="{{ route('organization.role.edit', $singleRole) }}"></x-dayone.action.btn>
                                </x-dayone.action.list>
                            </th>
                        </tr>
                    @endforeach

                </x-slot>

            </x-bootstrap.table>

        </x-bootstrap.card>
    @else
        <x-bootstrap.card>

            <x-slot name="header">
                <h4 class="card-title">Rolle</h4>
            </x-slot>

            <x-bootstrap.form method="{{ $mode == PageModeEnum::EDIT ? 'edit' : 'store' }}">


                <div class="mb-2">
                    <label class="custom-switch">
                        <input type="checkbox" wire:model.defer="all" id="all"
                            class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Alle Berechtigungen</span>
                    </label>
                </div>
                <x-bootstrap.table>
                    <x-slot name="head">
                        <th>Module</th>
                        <th>Berechtigungen</th>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($permissions as $moduleName => $modulePermissions)
                            <tr class="mb-3">
                                <th>

                                    <x-bootstrap.form.checkbox mb="mb-0" :col="false"
                                                name="permission_by_module.{{ $moduleName }}"
                                                label="{{ Str::headline($moduleName) }}"></x-bootstrap.form.checkbox>

                                </th>

                                <td>
                                    <div class="d-flex gap-4 flex-wrap mt-3">
                                        @foreach ($modulePermissions as $singlePermission)
                                            @php
                                                $permissionName = Str::replace(':', '-', $singlePermission->name);
                                                $permissionName = Str::replace(Str::replace(' ', '-', $moduleName), '', $permissionName);
                                                $permissionName = Str::headline(Str::replace('-', ' ', $permissionName));
                                            @endphp
                                            {{-- {{ $singlePermission->name }} --}}
                                            {{-- {{ $moduleName }} --}}
                                            <x-bootstrap.form.checkbox mb="mb-0" :col="false"
                                                name="permission.{{ $singlePermission->id }}"
                                                label="{{ $permissionName }}"
                                                value="{{ $singlePermission->id }}"></x-bootstrap.form.checkbox>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>

                </x-bootstrap.table>


                <div class="row">
                    <div class="col-lg-6">

                        @if ($mode == PageModeEnum::EDIT)
                            @if ($this->role->can_edit)
                                <x-bootstrap.form.input :col="false" name="name"
                                label="Name"></x-bootstrap.form.input>
                            @else
                                <x-bootstrap.form.input readonly :col="false" name="name"
                                    label="Name"></x-bootstrap.form.input>
                            @endif
                        @else
                            <x-bootstrap.form.input :col="false" name="name"
                                label="Name"></x-bootstrap.form.input>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <x-bootstrap.form.select :col="false" name="status" label="status">
                            @foreach ($statuses as $singleStatus)
                                <option value="{{ $singleStatus->value }}">{{ $singleStatus->value }}</option>
                            @endforeach
                        </x-bootstrap.form.select>
                    </div>
                </div>


                <div class="mt-4 d-flex justify-content-end gap-2 align-items-center" >
                    <x-bootstrap.button size="md" class="mb-4" color="secondary" href="{{ route('organization.role.index') }}">Back</x-bootstrap.button>
                    <x-bootstrap.form.button :col="false">Speichern</x-bootstrap.form.button>
                </div>

            </x-bootstrap.form>

        </x-bootstrap.card>
    @endif
</div>
