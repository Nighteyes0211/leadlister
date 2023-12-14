<?php

namespace App\Http\Livewire\Users\Org;

use App\Enum\UserInfo\GenderEnum;
use App\Models\User;
use App\Rules\Phone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{

    use WithFileUploads;

    /**
     * Collections
     */
    public $genders;

    /**
     * Form fields
     */
    public $first_name, $last_name, $email, $password;

    public function mount()
    {
        $this->first_name = Auth::user()->first_name;
        $this->last_name = Auth::user()->last_name;
        $this->email = Auth::user()->email;
    }

    protected function rules()
    {
        return [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ];
    }

    public function render()
    {
        return view('livewire.users.org.profile');
    }

    public function store()
    {
        $this->validate();

        $user = Auth::user();

        $user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);
        
        return redirect()->route('organization.dashboard');
    }
}
