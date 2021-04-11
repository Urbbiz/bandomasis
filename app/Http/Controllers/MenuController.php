<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Validator;

class MenuController extends Controller
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
       
        if ('title' == $request->sort) {
            $menus = Menu::orderBy('title')->get();
        }
        elseif ('price' == $request->sort) {
            $menus = Menu::orderBy('price')->get();
        }
       
        else {
            $menus = Menu::all();
        }
           
        return view('menu.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.create');
 
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
           'menu_title' => ['required', 'min:3', 'max:64'],
           'menu_price' => ['required','numeric', 'max:64'],
           'menu_weight' => ['required','numeric','gt:menu_meat'],
           'menu_meat' => ['required','numeric'],
           'menu_about' => ['required', 'min:3', 'max:200'],
      
            ],
            [
            'menu_title.required' => 'Menu title cannot be empty!',
            'menu_price.required' => 'ISBN title cannot be empty!',
            'menu_weight.gt'  => 'Meat weight cannot be grather than menu wight!',
           
            ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }


        $menu = new Menu;
        $menu->title = $request->menu_title;
        $menu->price = $request->menu_price;
        $menu->weight = $request->menu_weight;
        $menu->meat = $request->menu_meat;
        $menu->about = $request->menu_about;
        $menu->save();
        return redirect()->route('menu.index')->with('success_message', 'Sekmingai įrašytas.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menu.edit', ['menu' => $menu]);
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {

        $validator = Validator::make(
            $request->all(),
             [
           'menu_title' => ['required', 'min:3', 'max:64'],
           'menu_price' => ['required','numeric', 'max:64'],
           'menu_weight' => ['required','numeric','gt:menu_meat'],
           'menu_meat' => ['required','numeric'],
           'menu_about' => ['required', 'min:3', 'max:200'],
      
            ],
            [
            'menu_title.required' => 'Menu title cannot be empty!',
            'menu_price.required' => 'ISBN title cannot be empty!',
            'menu_weight.gt'  => 'Meat weight cannot be grather than menu wight!',
           
            ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }


        $menu->title = $request->menu_title;
        $menu->price = $request->menu_price;
        $menu->weight = $request->menu_weight;
        $menu->meat = $request->menu_meat;
        $menu->about = $request->menu_about;
        $menu->save();
        return redirect()->route('menu.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {

        if($menu->restaurantMenu->count()){
            return 'Trinti negalima, nes turi knygų';
        }
        $menu->delete();
       return redirect()->route('menu.index')->with('success_message', 'Sėkmingai ištrintas.');

    }
}
