@extends('layouts.app')

@section('title', 'Edit Contact')

@section('content')
<div class="container mt-4">
    <h2>Edit Contact</h2>

    <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
        @csrf @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">First Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $contact->name }}" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $contact->last_name }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $contact->phone }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Contact</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
