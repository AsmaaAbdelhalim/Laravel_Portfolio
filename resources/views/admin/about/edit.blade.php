@extends('layouts.admin')

@section('content')

<div class="title">
    <i class="uil uil-edit"></i>
    <span class="text">Edit About Information</span>
</div>



<div class="card">
    <h4 class="card-title">Edit About Information</h4>
    <form action="{{ route('admin.about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Example Input Group --}}
        <div class="input-group">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $about->first_name) }}" required>
        </div>
        <div class="input-group">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $about->last_name) }}" required>
        </div>
        <div class="input-group">
            <label for="birth_date">Birth Date:</label>
            <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $about->birth_date) }}" required>
        </div>
        <div class="input-group">
            <label for="avatar">Avatar:</label>
            <input type="file" id="avatar" name="avatar" value="{{ old('avatar', $about->avatar) }}" accept="image/*">
            @if($about->avatar)
                <p>Current Avatar: <img src="{{ Storage::url( $pathabout['avatar'] .'/'.$about->avatar) }}" alt="Avatar" class="avatar"></p>
            @else
                <p>No avatar uploaded.</p>
            @endif
        </div>
        <div class="input-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $about->phone) }}" required>
        </div>
        <div class="input-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $about->email) }}" required>
        </div>
        <div class="input-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="{{ old('address', $about->address) }}" required>
        </div>
        <div class="input-group">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="{{ old('city', $about->city) }}" required>
        </div>
        <div class="input-group">
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" value="{{ old('country', $about->country) }}" required>
        </div>
        <div class="input-group">
            <label for="job">Job:</label>
            <input type="text" id="job" name="job" value="{{ old('job', $about->job) }}" required>
        </div>
        <div class="input-group">
            <label for="degree">Degree:</label>
            <input type="text" id="degree" name="degree" value="{{ old('degree', $about->degree) }}" required>
        </div>
        <div class="input-group">
            <label for="experience">Experience:</label>
            <input type="text" id="experience" name="experience" value="{{ old('experience', $about->experience) }}" required>
        </div>
        <div class="input-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title', $about->title) }}" required>
        </div>
        <div class="input-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required>{{ old('description', $about->description) }}</textarea>
        </div>
         <div class="input-group">
            <label for="header_image">Header Image:</label>
            <input type="file" id="header_image" name="header_image" value="{{ old('header_image', $about->header_image) }}">
            @if($about->header_image)
                <p>Current Header Image: <img src="{{ Storage::url( $pathabout['header_image'] .'/'.$about->header_image) }}" alt="Header Image" class="table-image"></p>
            @else
                <p>No header image uploaded.</p>
            @endif
        </div>
        <div class="input-group">
            <label for="cv">CV:</label>
            <input type="file" id="cv" name="cv" value="{{ old('cv', $about->cv) }}">
            @if($about->cv)
                <p>Current CV: <a href="{{ Storage::url( $pathabout['cv'].'/'.$about->cv) }}" target="_blank">Download CV</a></p>
            @else
                <p>No CV uploaded.</p>
            @endif
        </div>
        <div class="input-group">
            <h4>Social Links</h4>
            <div id="social-links-wrapper">
                @foreach($about->social_links ?? [] as $index => $link)
                    <div class="social-link-group mb-3">
                        <select class="form-control platform-select mb-1" name="social_links[{{ $index }}][platform]">
                            <option value="">-- Select Platform --</option>
                            @foreach(['github','linkedin','behance','dribbble','twitter','instagram','youtube','facebook','other'] as $platform)
                                <option value="{{ $platform }}" {{ $link['platform'] === $platform ? 'selected' : '' }}>
                                    {{ ucfirst($platform) }}
                                </option>
                            @endforeach
                        </select>

                        <input type="url" name="social_links[{{ $index }}][url]" value="{{ $link['url'] }}" placeholder="URL" class="form-control mb-1" required />
                        <input type="hidden" class="icon-input" name="social_links[{{ $index }}][icon]" value="{{ $link['icon'] }}" />
                        <i class="icon-preview {{ $link['icon'] ?? '' }}" style="font-size: 24px; margin-left: 5px;"></i>
                        <button type="button" class="btn-danger remove-social"><i class="uil uil-trash-alt"></i></button>
                    </div>
                @endforeach
            </div>

            <button type="button" id="add-social" class="btn btn-secondary mb-3">Add Social Link</button>
        </div>

        <button type="submit" class="btn-success"> <i class="uil uil-edit"></i> Update</button>

    </form>
</div>
<template id="social-link-template">
    <div class="social-link-group mb-3">
        <select class="form-control platform-select mb-1" name="__name__[platform]">
            <option value="">-- Select Platform --</option>
            <option value="github">GitHub</option>
            <option value="linkedin">LinkedIn</option>
            <option value="behance">Behance</option>
            <option value="dribbble">Dribbble</option>
            <option value="twitter">Twitter</option>
            <option value="instagram">Instagram</option>
            <option value="youtube">YouTube</option>
            <option value="facebook">Facebook</option>
            <option value="other">Other</option>
        </select>

        <input type="url" name="__name__[url]" placeholder="URL" class="form-control mb-1" required />
        <input type="hidden" class="icon-input" name="__name__[icon]" />
        <i class="icon-preview" style="font-size: 24px; margin-left: 5px;"></i>
        <button type="button" class="btn-danger">Remove</button>
    </div>
</template>

@endsection