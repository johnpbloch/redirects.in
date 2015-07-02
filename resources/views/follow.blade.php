@extends('layout')

@section('title', isset($final) ? "$final | " : '')

@section('content')
    <div id="steps_container">
        @unless($start === $end)
        <div id="first_step">
            {{ $start }}
        </div>
        @endunless
        <?php $previous = $start; ?>
        <ol>
            @forelse($steps as $step)
                <li><span>{{ $previous }}</span><span>{{ $step }}</span></li>
                <?php $previous = $step; ?>
            @empty
                <li>No redirects</li>
            @endforelse
        </ol>
        <div id="final_step">
            {{ $end }}
        </div>
    </div>
    @parent
@endsection
