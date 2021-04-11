{{-- @foreach ($menus as $menu)
  {{$menu->title}} <a href="{{route('menu.edit',[$menu])}}">[EDIT]</a>
  <form method="POST" action="{{route('menu.destroy', [$menu])}}">
   @csrf
   <button type="submit">DELETE</button>
  </form>
  <br>  
@endforeach --}}


@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
          <div class="card">
            <div class="card-header">
               <h2>Menu List</h2>
               <a href="{{route('menu.index',['sort'=>'title'])}}">Sort by Title</a>
               <a href="{{route('menu.index',['sort'=>'price'])}}">Sort by Price</a>
               <a href="{{route('menu.index')}}">Default</a>
            </div>
               <div class="card-body">
                <ul class="list-group">

                  @foreach ($menus as $menu)
                    <li class="list-group-item list-line">
                      <div>
                        <h4>{{$menu->title}}</h4>
                         Price: {{$menu->price}}
                      </div> 
                      <div class="list-line__buttons">
                        <a href="{{route('menu.edit',[$menu])}}" class="btn btn-info">EDIT</a>
                        <form method="POST" action="{{route('menu.destroy', [$menu])}}">
                        @csrf
                        <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                      </div>
                    </li>
                    @endforeach
                </ul>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
