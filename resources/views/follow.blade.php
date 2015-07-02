@extends('layout')

@section('title', isset($end) ? "$end | " : '')

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
                @unless($previous === $step)
                    <li><span>{{ $previous }}</span><span>{{ $step }}</span></li>
                @endunless
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
