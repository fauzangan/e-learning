@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Courses Dashboard</h1>
</div>

<div class="table-responsive col-lg-11">
  <a href="/dashboard/courses/create" class="btn btn-primary mb-3">Add New Course</a>
  @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Created By</th>
        <th scope="col">Created At</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($courses as $course)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $course->title }}</td>
          <td>{{ $course->category->name }}</td>
          <td>{{ $course->author->name }}</td>
          <td>{{ $course->created_at->toDateString() }}</td>
          <td>
            <a href="/dashboard/courses/{{ $course->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
            <a href="/dashboard/courses/{{ $course->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
            <form action="/dashboard/courses/{{ $course->id }}" method="POST" class="d-inline">
              @method('delete')
              @csrf
              <button class="badge bg-danger border-0" onclick="return confirm('Are You Sure?')"><span data-feather="trash-2"></span></button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection