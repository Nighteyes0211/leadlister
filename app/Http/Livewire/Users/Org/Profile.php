<?php

namespace App\Http\Livewire\Users\Org;

use App\Enum\UserInfo\GenderEnum;
use App\Models\User;
use App\Rules\Phone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{

    use WithFileUploads;

    /**
     * Collections
     */
    public $genders, $users;

    /**
     * Form fields
     */
    public $first_name, $last_name, $email, $password;
    public $absent_from, $absent_to, $is_absent, $substitution_user;

    public function mount()
    {
        $this->first_name = Auth::user()->first_name;
        $this->last_name = Auth::user()->last_name;
        $this->email = Auth::user()->email;
        $this->is_absent = Auth::user()->is_absent;
        $this->absent_from = Auth::user()->absent_from;
        $this->absent_to = Auth::user()->absent_to;
        $this->substitution_user = Auth::user()->substitution_user;

        $this->users = User::where('id', '!=', Auth::id())->get();
    }

    protected function rules()
    {
        return [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'absent_from' => [Rule::requiredIf($this->is_absent), 'nullable', 'after:today'],
            'absent_to' => [Rule::requiredIf($this->is_absent), 'nullable', 'after:absent_from'],
            'substitution_user' => [Rule::requiredIf($this->is_absent)],
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
            'absent_from' => $this->absent_from,
            'absent_to' => $this->absent_to,
            'is_absent' => $this->is_absent,
            'substitution_handler' => $this->substitution_user,
        ]);

        return redirect()->route('organization.dashboard');
    }
}
