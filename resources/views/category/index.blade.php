<x-app-layout>
    <x-slot name="header">
        <h2 class=" bg-dark font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            List All categoreis
        </h2>
    </x-slot>



<div class="container text-center col-md-6">
    <div class="card">
        <a href="{{route('category.create')}}" type="button" class="btn btn-info my-3 ">Create New </a>
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
                <th scope="col" colspan="2" class="px-6 py-3">
                    Action
                </th>

            </tr>
        </thead>
        <tbody>
            @foreach ( $categoreis as $items )
            <tr class="bg-dark border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$items->id}}
                </th>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$items->title}}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$items->description}}
                </td>
               
        <th><a href="{{route("category.edit",$items->id)}}"><i class="text-warning fa-solid fa-pen-to-square"></i></a> </th>
        <th><a href="{{route("category.destroy",$items->id)}}"><i class="text-danger fa-solid fa-trash"></i></a> </th>

            </tr>
            @endforeach
        </tbody>
    </table>
{{-- </div> --}}
</div>
</div>
</div>


</x-app-layout>
