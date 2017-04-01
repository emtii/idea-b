@component('mail::message')
# Notes Notice

You did something wrong within the notes for the following time entry:

@component('mail::table')
| Date       | Customer         | Project  |
| ------------- |:-------------:| --------:|
| {{ $entry['created_at'] }}      | {{ $entry['client'] }}      | {{ $entry['project'] }}      |
@endcomponent

Thanks for fix,<br>
{{ config('app.name') }}

@endcomponent