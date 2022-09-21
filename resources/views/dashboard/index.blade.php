@php
$user = \App\Models\User::where('id', auth()->user()->id)->first();
@endphp
<h6>{{ $user }}</h6>
