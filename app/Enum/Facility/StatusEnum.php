<?php

namespace App\Enum\Facility;

enum StatusEnum: string {
    case ACTIVE = 'Active';
    case INACTIVE = 'In Active';

    case ARRANGE_TELEPHONE_APPOINTMENT = 'Arrange Telephone Appointment';
    case TELEPHONE_APPOINTMENT_ARRANGED = 'Telephone Appointment Arranged';
    case TELEPHONE_APPOINTMENT_CARRIED_OUT = 'Telephone Appointment Carried Out';
    case INFORMATION_MATERIAL_IS_TO_BE_SENT = 'Information Material Is To Be Sent';
    case INFORMATION_MATERIAL_HAS_BEEN_SENT = 'Information Material Has Been Sent';

}

?>
