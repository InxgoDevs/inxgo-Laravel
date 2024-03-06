@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Profile</h1>
        <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <!-- Other form fields -->

            <label for="hourly_rate">Hourly Rate:</label>
            <!-- Use the format() method to display the formatted currency -->
            <input type="text" name="hourly_rate" value="{{ old('hourly_rate', $hourlyRate) }}" />

            <!-- Currency selector -->
            <label for="currency">Preferred Currency:</label>
            <!-- Add currency selector based on your implementation -->

            <label for="self_introduction">Self Introduction:</label>
            <textarea name="self_introduction">{{ $user->self_introduction }}</textarea>

            <label for="profile_image">Profile Image:</label>
            <input type="file" name="profile_image">

            <!-- Other form fields -->

            <h2>Skills:</h2>
            @foreach($skills as $skill)
                <label>
                    <input type="checkbox" name="skills[]" value="{{ $skill->id }}"
                           {{ in_array($skill->id, $user->skills->pluck('id')->toArray()) ? 'checked' : '' }}>
                    {{ $skill->name }}
                </label>
                @if($skill->image)
                    <img src="{{ asset('storage/' . $skill->image) }}" alt="{{ $skill->title }}">
                @else
                    <p>No image available</p>
                @endif
            @endforeach

            <!-- Other form fields -->

            <h2>Portfolio:</h2>
            @foreach($user->portfolio as $key => $portfolio)
                <div class="portfolio-item">
                    <label>Title:</label>
                    <input type="text" name="portfolio_title[]" value="{{ $portfolio->title }}">

                    <label>Image:</label>
                    <input type="file" name="portfolio_image[]">

                    <button type="button" onclick="removePortfolioItem({{ $key }})">Remove</button>
                </div>
            @endforeach
            <button type="button" onclick="addPortfolioItem()">Add Portfolio</button>

            <button type="submit">Update Profile</button>
        </form>
    </div>

    <script>
        function addPortfolioItem() {
            var container = document.getElementById('portfolio-container');
            var newItem = document.createElement('div');
            newItem.className = 'portfolio-item';

            newItem.innerHTML = `
                <label>Title:</label>
                <input type="text" name="portfolio_title[]">

                <label>Image:</label>
                <input type="file" name="portfolio_image[]">

                <button type="button" onclick="removePortfolioItem(${container.children.length})">Remove</button>
            `;

            container.appendChild(newItem);
        }

        function removePortfolioItem(index) {
            var container = document.getElementById('portfolio-container');
            container.removeChild(container.children[index]);
        }
    </script>
@endsection
