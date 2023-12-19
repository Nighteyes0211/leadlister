<x-mail::message>
# There is a new telephone appointment for you.

<p>Date: {{ parseDate($appointment->start_date, 'M d, Y') }}</p>
<p>Time: {{ parseDate($appointment->start_date, 'h:i A') }}</p>
<p>Contact: {{ $appointment->contact }}</p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
