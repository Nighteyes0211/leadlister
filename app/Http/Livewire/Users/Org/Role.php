<?php

namespace App\Http\Livewire\Users\Org;

use App\Enum\PageModeEnum;
use App\Enum\Role\StatusEnum;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends Component
{

    /**
     * Parent
     */
    public $role, $mode;

    /**
     * Collections
     */
    public $roles, $statuses;

    public $name, $status, $permission = [], $all = false;

    public $permission_by_module = [];


    public function mount()
    {
        $this->roles = ModelsRole::latest()->get();

        if ($this->mode == PageModeEnum::EDIT)
        {
            $this->name = $this->role->name;
            $this->status = $this->role->status;

            $this->permission = $this->role->permissions->mapWithKeys(function ($singlePermission, $key) {
                return [
                    $singlePermission['id'] => $singlePermission['id']
                ];
            })->toArray();

        } else {
            $this->status = StatusEnum::ACTIVE->value;
        }
    }

    // protected function rules()
    // {
    //     return [
    //         'name' => 'required|max:255|unique:roles,name,' . $this->role,
    //     ];
    // }

    public function render()
    {
        $permissions = Permission::all()->groupBy('module', true);
        $this->statuses = StatusEnum::cases();

        return view('livewire.users.org.role', compact('permissions'));
    }

    public function store()
    {


        if ($this->name == '')
        {
            $this->addError('name', 'Role is required');
            return;
        }

        if (ModelsRole::where('name', $this->name)->exists())
        {
            $this->addError('name', 'Role already exists');
            return;
        }


        if ($this->all == true)
        {
            $this->permission = Permission::all()->pluck('id')->toArray();
        }


        foreach($this->permission_by_module as $module => $value)
        {
            if ($value)
            {
                $permissions = Permission::where('module', $module)->pluck('id')->toArray();
                $this->permission = array_merge($this->permission, $permissions);
            }

        }

        $this->permission = collect($this->permission)->filter()->toArray();

        $role = ModelsRole::create([
            'name' => $this->name,
            'can_edit' => true,
            'status' => $this->status
        ]);

        $role->syncPermissions($this->permission);

        return redirect()->route('organization.role.index');
    }

    public function edit()
    {

        if ($this->name == '')
        {
            $this->addError('name', 'Role is required');
            return;
        }

        if (ModelsRole::where('name', $this->name)->whereNot('id', $this->role->id)->exists())
        {
            $this->addError('name', 'Role already exists');
            return;
        }


        if ($this->all == true)
        {
            $this->permission = Permission::all()->pluck('id')->toArray();
        }

        $this->role->update([
            'name' => $this->name,
            'status' => $this->status,
        ]);

        foreach($this->permission_by_module as $module => $value)
        {
            if ($value)
            {
                $permissions = Permission::where('module', $module)->pluck('id')->toArray();
                $this->permission = array_merge($this->permission, $permissions);
            }

        }

        $this->permission = collect($this->permission)->filter()->toArray();

        $this->role->syncPermissions($this->permission);

        return redirect()->route('organization.role.index');
    }
}
