@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
    <h1>All Jobs</h1>

    @if(count($jobs) > 0)
        <ul>
            @foreach($jobs as $job)
                <li>
                    {{ $job->title }} - {{ $job->client_name }}
                    <a href="{{ route('jobs.show', $job->id) }}">View</a>
                    <a href="{{ route('jobs.edit', $job->id) }}">Edit</a>
                    <form action="{{ route('jobs.destroy', $job->id) }}" method="post" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No jobs available.</p>
    @endif
<div class="mt-4">
    <a href="{{ route('jobs.create') }}">Create Job</a>
</div>
    <ul class="nav nav-tabs" id="jobTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="assigned-tab" data-bs-toggle="tab" href="#assigned" role="tab" aria-controls="assigned" aria-selected="true">Assigned</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="inProgress-tab" data-bs-toggle="tab" href="#inProgress" role="tab" aria-controls="inProgress" aria-selected="false">In Progress</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="paymentCleared-tab" data-bs-toggle="tab" href="#paymentCleared" role="tab" aria-controls="paymentCleared" aria-selected="false">Payment Being Cleared</a>
        </li>
    </ul>

    <div class="tab-content" id="jobTabsContent">
        <div class="tab-pane fade show active" id="assigned" role="tabpanel" aria-labelledby="assigned-tab">
            @if(count($assignedJobs) > 0)
                <ul>
                    @foreach($assignedJobs as $job)
                        <li>{{ $job->title }}</li>
                    @endforeach
                </ul>
            @else
                <p>No assigned jobs.</p>
            @endif
        </div>
        <div class="tab-pane fade" id="inProgress" role="tabpanel" aria-labelledby="inProgress-tab">
            @if(count($inProgressJobs) > 0)
                <ul>
                    @foreach($inProgressJobs as $job)
                        <li>{{ $job->title }}</li>
                    @endforeach
                </ul>
            @else
                <p>No jobs in progress.</p>
            @endif
        </div>
        <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
            @if(count($completedJobs) > 0)
                <ul>
                    @foreach($completedJobs as $job)
                        <li>{{ $job->title }}</li>
                    @endforeach
                </ul>
            @else
                <p>No completed jobs.</p>
            @endif
        </div>
        <div class="tab-pane fade" id="paymentCleared" role="tabpanel" aria-labelledby="paymentCleared-tab">
            @if(count($paymentBeingClearedJobs) > 0)
                <ul>
                    @foreach($paymentBeingClearedJobs as $job)
                        <li>{{ $job->title }}</li>
                    @endforeach
                </ul>
            @else
                <p>No jobs with payment being cleared.</p>
            @endif
        </div>
    </div>

</div>
</div>
</div>
@endsection
