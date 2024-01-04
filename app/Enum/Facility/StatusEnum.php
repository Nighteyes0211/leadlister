<?php

namespace App\Enum\Facility;

enum StatusEnum: string {
    case ARRANGE_TELEPHONE_APPOINTMENT = 'Arrange Telephone Appointment';
    case TELEPHONE_APPOINTMENT_ARRANGED = 'Telephone Appointment Arranged';
    case TELEPHONE_APPOINTMENT_CARRIED_OUT = 'Telephone Appointment Carried Out';
    case INFORMATION_MATERIAL_IS_TO_BE_SENT = 'Information Material Is To Be Sent';
    case INFORMATION_MATERIAL_HAS_BEEN_SENT = 'Information Material Has Been Sent';

    public function color()
    {
        return match($this) {
            self::ARRANGE_TELEPHONE_APPOINTMENT => 'bg-warning',
            self::TELEPHONE_APPOINTMENT_ARRANGED => 'bg-info',
            self::TELEPHONE_APPOINTMENT_CARRIED_OUT => 'bg-success',
            self::INFORMATION_MATERIAL_IS_TO_BE_SENT => 'bg-primary',
            self::INFORMATION_MATERIAL_HAS_BEEN_SENT => 'bg-danger',
        };
    }

    public function german()
    {
        return match($this) {
            self::ARRANGE_TELEPHONE_APPOINTMENT => 'Telefontermin vereinbaren',
            self::TELEPHONE_APPOINTMENT_ARRANGED => 'Telefontermin vereinbart',
            self::TELEPHONE_APPOINTMENT_CARRIED_OUT => 'Telefontermin durchgeführt',
            self::INFORMATION_MATERIAL_IS_TO_BE_SENT => 'Infomaterial ist zu versenden',
            self::INFORMATION_MATERIAL_HAS_BEEN_SENT => 'Infomaterial wurde versendet',
        };
    }
}

?>
