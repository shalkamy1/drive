<x-app-layout>
    <x-slot name="header">
        <h2 class=" bg-dark font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            List All users
        </h2>
        <div class="container col-md-6">
            <div class="relative overflow-x-auto">
                @if (Session::has("done"))
                    <div class="alert alert-success">
                        <h1>{{Session::get("done")}}</h1>
                    </div>
        @endif
    </x-slot>



<div class="container text-center col-md-6">
    <div class="card">
        <a href="{{route('register')}}" type="button" class="btn btn-info my-3 ">Create new user </a>
     <div class="card-body">
{{-- <div class="relative overflow-x-auto"> --}}
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                <th scope="col" class="px-6 py-3">
                    id
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>

                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" colspan="3" class="px-6 py-3">
                    Action
                </th>

            </tr>
        </thead>
        <tbody>
            @foreach ( $users as $items )
            <tr class="bg-dark border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$items->id}}
                </th>

                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$items->name}}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$items->email}}
                </td>
                <th><a href="{{route("drives.show",$items->id)}}" class="text-info ">show</a> </th>
                @if($items->statues=='public')
                    <th><a href="{{route('drive.ChangeStatues',$items->id)}}" class=" text-success"> public</a> </th>
                @else
                    <th><a href="{{route('drive.ChangeStatues',$items->id)}}" class=" text-danger"> private</a> </th>
                @endif

        <th><a class="text-danger " href="{{route("drives.destroy",$items->id)}}"> delete</a> </th>

            </tr>
            @endforeach
        </tbody>
    </table>
{{-- </div> --}}
</div>
</div>
</div>


</x-app-layout>
