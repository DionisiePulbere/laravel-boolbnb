@extends('layouts.app')

@section('content')
<div class="container">

    <table class="table table-striped table-hover">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Visibility</th>
            <th>Price</th>
            <th>Rooms</th>
            <th>Beds</th>
            <th>Baths</th>
            <th>Square meters</th>
            <th>Address</th>
            <th>Actions</th>
            
            
        </tr>
        
        @foreach ($apartments as $apartment)
        <tr>
            <td>{{$apartment->id}}</td>
            <td>{{$apartment->title}}</td>
            <td>{{$apartment->visibility}}</td>
            <td>{{$apartment->price}}</td>
            <td>{{$apartment->rooms}}</td>
            <td>{{$apartment->number_of_bed}}</td>
            <td>{{$apartment->number_of_bath}}</td>
            <td>{{$apartment->square_meters}}</td>
            <td>{{$apartment->address}}</td>
            <td>
                <div class="row justify-content-around">
                    <div class="col-4">
                        <a class="btn btn-primary" href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                    </div>
                    <div class="col-4">
                        <a class="btn btn-primary" href="#"><i class="fa-solid fa-newspaper"></i></a>
                    </div>
                    <div class="col-4">

                        <form action="" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </div>
                
            </td>
        </tr>
        @endforeach
    </table>
    
</div>

@endsection