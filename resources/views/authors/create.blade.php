@extends('layouts.app')

@section('title', 'Create Author')

@section('content')
    <div class="block_container">
        <h2>Add Author</h2>
        <form action="{{route('authors.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <textarea name="last_name" id="last_name" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="biography">Biography</label>
                <textarea name="biography" id="biography" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>

@endsection
