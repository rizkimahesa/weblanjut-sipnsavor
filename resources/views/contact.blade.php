@extends('layouts.dashboard')

@section('content')
<!-- Contact Tab -->
<div class="tab-pane" style="padding-bottom: 50px" role="tabpanel" aria-labelledby="contact-tab">
    <div class="contact-form-container mt-4">
        <h2 class="text-success text-center">Contact Us</h2>

            <!-- Display Success Message -->
            @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
            @endif

            <!-- Contact Form -->
            <form action="{{ route('contact.store') }}" method="POST">
            @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                    <button type="submit" class="btn btn-success w-100">Send</button>
            </form>
    </div>
</div>
@endsection
