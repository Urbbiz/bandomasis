<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Validator;


class RestaurantController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Request $request)
    {
       //FILTRAVIMAS
        $menus = Menu::all();

        if($request->menu_id) {
            $restaurants = Restaurant::where('menu_id',$request->menu_id) ->get();
            $filterBy = $request->menu_id;
        }
        else {
            $restaurants = Restaurant::all();
        }

        // Rusiavimas SORT
        if($request->sort && 'asc' == $request->sort) {
            $restaurants = $restaurants ->sortBy('title');
            $sortBy = 'asc';
        }
        elseif($request->sort && 'desc' == $request->sort) {
            $restaurants = $restaurants ->sortByDesc('title');
            $sortBy = 'desc';
        }

    return view('restaurant.index', [
        'restaurants' => $restaurants, 
        'menus' => $menus,
        'filterBy'=>$filterBy ?? 0,
        'sortBy' => $sortBy ?? ''
        ]);
    }

    // public function index()
    // { 

    //     $restaurants = Restaurant::all();
    //     return view('restaurant.index', ['restaurants' => $restaurants]);
 
    // }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $menus = Menu::all();
        $menus = Menu::orderBy('title')->get();
        return view('restaurant.create', ['menus' => $menus]);

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator = Validator::make(
            $request->all(),
             [
           'restaurant_title' => ['required', 'min:3', 'max:64'],
           'restaurant_customers' => ['required','numeric'],
           'restaurant_employees' => ['required','numeric'],
           'menu_id' => ['required',],
           
      
            ],
            [
            'restaurant_title.required' => 'Restaurant title cannot be empty!',
           
           
            ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }


        $restaurant = new restaurant;
        $restaurant->title = $request->restaurant_title;
        $restaurant->customers = $request->restaurant_customers;
        $restaurant->employees = $request->restaurant_employees;
        $restaurant->menu_id = $request->menu_id;
        $restaurant->save();
        return redirect()->route('restaurant.index')->with('success_message', 'Sekmingai įrašytas.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $menus = Menu::orderBy('title')->get();
        return view('restaurant.edit', ['restaurant' => $restaurant, 'menus' => $menus ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {

        $validator = Validator::make(
            $request->all(),
             [
           'restaurant_title' => ['required', 'min:3', 'max:64'],
           'restaurant_customers' => ['required','numeric'],
           'restaurant_employees' => ['required','numeric'],
           'menu_id' => ['required',],
           
      
            ],
            [
            'restaurant_title.required' => 'Restaurant title cannot be empty!',
           
           
            ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

       

        $restaurant->title = $request->restaurant_title;
        $restaurant->customers = $request->restaurant_customers;
        $restaurant->employees = $request->restaurant_employees;
        $restaurant->menu_id = $request->menu_id;
        $restaurant->save();
        return redirect()->route('restaurant.index')->with('success_message', 'Sėkmingai pakeistas.');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {


        $restaurant->delete();
       return redirect()->route('restaurant.index')->with('success_message', 'Sėkmingai ištrintas.');
       


       

    }
}





