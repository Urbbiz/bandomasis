
@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header"><h4>Edit Restaurant</h4></div>

               <div class="card-body">
                 <form method="POST" action="{{route('restaurant.update',$restaurant)}}">

                  <div class="form-group">
                        <label>Title: </label>
                        <input type="text" class="form-control" name="restaurant_title" value="{{$restaurant->title}}" value="{{old('restaurant_title', $restaurant->title)}}">
                        <small class="form-text text-muted">Please enter new restaurant name.</small>
                    </div>
                    
                    <div class="form-group">
                        <label>Customers: </label>
                        <input type="text" class="form-control" name="restaurant_customers" value="{{$restaurant->customers}}" value="{{old('restaurant_customers',$restaurant->customers)}}" >
                        <small class="form-text text-muted">Please enter customers.</small>
                    </div>

                    <div class="form-group">
                        <label>Employees: </label>
                        <input type="text" class="form-control" name="restaurant_employees" value="{{$restaurant->employees}}" value="{{old('restaurant_employees', $restaurant->employees)}}" >
                        <small class="form-text text-muted">Please enter employees.</small>
                    </div>

                     <div class="form-group">
                        <label>Menu: </label>
                        <select name="menu_id">
                            @foreach ($menus as $menu)
                                <option value="{{$menu->id}}" @if($menu->id == $restaurant->menu_id) selected @endif>
                                {{$menu->title}} {{$menu->price}}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Please select menu.</small>
                    </div>


                     @csrf
                     <button class="btn btn-primary" type="submit">EDIT</button>
                  </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
