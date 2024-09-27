<x-app-layout>
    <x-slot name="header">
        <h2 class=" bg-dark font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            create new category
        </h2>
    </x-slot>



<div class="container col-md-6">
<div class="relative overflow-x-auto">
@if (Session::has("done"))
<div class="alert alert-success">
    <h1>{{Session::get("done")}}</h1>
</div>
@endif
<!-- /resources/views/post/create.blade.php -->



<!-- Create Post Form -->

    <form action="{{route('category.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="" class="form-group my-2 text-light">Title</label>
            <input value="{{old('title')}}"  class="form-control  @error('title')
is-invalid
            @enderror text-light" name="title" type="text">
            @error('title')
<span class="text-danger"> {{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="" class="form-group  my-2 text-light">Description</label>
            <input value="{{old('description')}}" class="form-control @error('description')
is-invalid
            @enderror text-light" name="description" type="text">
            @error('description')
<span class="text-danger"> {{$message}}</span>
            @enderror
        </div>

          <div class="d-grid gap-2">
            <button class="btn btn-success my-4 " >create</button>

          </div>
    </form>

</div>
</div>


</x-app-layout>
