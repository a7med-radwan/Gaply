<x-layout title="Dashboard — Gaply">
    <h2>Welcome back, {{ $user->name }}!</h2>
    <p>Target Job: <strong>{{ $targetJob }}</strong></p>

    <p><a href="{{ route('profile') }}">Configure Profile / Skills</a></p>

    <hr>

    <h3>Skill Gap Analysis</h3>
    <p>Acquired {{ count($acquired) }} / {{ count($requiredSkills) }} Skills</p>

    <h4>Acquired Skills:</h4>
    @if(count($acquired) > 0)
        <ul>
            @foreach($acquired as $skill)
                <li>{{ $skill }} [Acquired]</li>
            @endforeach
        </ul>
    @else
        <p>No acquired skills added. Set them in your profile.</p>
    @endif

    <h4>Missing Skills (Gaps):</h4>
    @if(count($missing) > 0)
        <ul>
            @foreach($missing as $skill)
                <li>{{ $skill }} [Missing]</li>
            @endforeach
        </ul>
    @else
        <p>You have acquired all required skills for this role.</p>
    @endif

    <hr>

    <h3>Job Readiness</h3>
    <p>Readiness Score: <strong>{{ $user->target_job ? $readiness : 64 }}%</strong></p>
    <p>Missing skills count: {{ count($missing) }}</p>

    <hr>

    <h3>Your Smart Roadmap (Active Learning Plan)</h3>
    @if(count($roadmapTasks) > 0)
        <ol>
            @foreach($roadmapTasks as $task)
                <li>
                    <strong>{{ $task['title'] }}</strong> - {{ $task['desc'] }} (Duration: {{ $task['duration'] }}) 
                    <br>
                    Status: {{ $task['status'] }}
                </li>
            @endforeach
        </ol>
    @else
        <p>No tasks in your learning plan.</p>
    @endif
</x-layout>
