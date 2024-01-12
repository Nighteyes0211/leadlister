<?php

namespace App\Enum\Contact;

enum SalutationEnum:string {
    case MR = 'Herr';
    case MS = 'Frau';
    case NONE = 'Ohne Anrede';

}

?>
