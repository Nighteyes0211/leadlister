<?php

namespace App\Http\Livewire\Users\Org;

use App\Enum\PageModeEnum;
use App\Enum\RoleEnum;
use App\Enum\UserInfo\GenderEnum;
use App\Models\Section;
use App\Models\User as ModelsUser;
use App\Rules\Phone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class User extends Component
{

    public $mode;

    use WithFileUploads;
    /**
     * Parent
     */
    public $user_record;

    /**
     * Collections
     */
    # Create/EDIT
    public $roles;

    # Index
    public $users;


    /**
     * Form Fields
     */
    public $first_name, $last_name, $email, $password, $is_internal = true, $role;

    protected $listeners = ['recordDeletionConfirmed' => 'delete'];



    public function rules()
    {

        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email' . ($this->mode == PageModeEnum::EDIT ? ',' . $this->user_record->id : ''),
            'password' =>  $this->mode == PageModeEnum::EDIT ? 'nullable|string|max:255' : 'required|string|max:255',
            'role' => 'required|string',
        ];
    }

    public function mount()
    {

        $this->users = ModelsUser::available()->latest()->where('id', '!=', Auth::user()->id)->get();
        $this->roles = Role::whereNotIn('name', [RoleEnum::SUPERADMINISTRATOR->value])->get();




        if (PageModeEnum::EDIT == $this->mode)
        {
            $this->first_name = $this->user_record->first_name;
            $this->last_name = $this->user_record->last_name;
            $this->email = $this->user_record->email;
            $this->role = $this->user_record->roles->first()->name;
            $this->is_internal = $this->user_record->is_internal;

        } else {
            $this->role = RoleEnum::USER->value;
        }

    }


    public function render()
    {
        return view('livewire.users.org.user');
    }

    public function store()
    {
        $this->validate();

        $user = ModelsUser::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_internal' => $this->is_internal,
        ]);

        $user->assignRole($this->role);

        return redirect()->route('organization.user.index');
    }

    public function edit()
    {
        $this->validate();

        $this->user_record->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $this->user_record->password,
            'is_internal' => $this->is_internal,
        ]);

        $this->user_record->syncRoles([$this->role]);

        return redirect()->route('organization.user.index');
    }

    public function delete(int $user_id)
    {

        $user = ModelsUser::find($user_id);
        $user->softDelete();

        return redirect()->route('organization.user.index');

    }

}
