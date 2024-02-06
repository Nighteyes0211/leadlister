<?php

namespace App\Enum\Appointment;

enum StatusEnum:string {

    case PENDING = 'Pending';
    case DONE = "Done";


    public function label()
    {
        return match($this){
            self::PENDING => 'Ausstehend',
            self::DONE => 'Erledigt'
        };
    }

    public function color()
    {
        return match($this){
            self::PENDING => 'warning',
            self::DONE => 'success'
        };
    }

}

?>
