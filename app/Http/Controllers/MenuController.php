<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //show all items
    public function index(Cafe $cafe)
    {
        // Retrieve all menus associated with the cafe
        $menus = $cafe->menus;

        // Return the view with the cafe and menu data
        return view('menus.index', compact('cafe', 'menus'));
    }

    //show single item
    public function show(Menu $menu)
    {
        return view('menus.show', [
            'menu' => $menu
        ]);
    }

    //show single item for owner
    public function manage_single($cafe_id, $menu_id)
    {
        // Retrieve the cafe and menu item using the IDs
        $cafe = Cafe::findOrFail($cafe_id);
        $menu = Menu::where('menu_id', $menu_id)->where('cafe_id', $cafe_id)->firstOrFail();
    
        // Pass the data to the view
        return view('menus.manage_single', compact('cafe', 'menu'));
    }

    //show all items
    public function manage(Cafe $cafe)
    {
        // Retrieve all menus associated with the cafe
        $menus = $cafe->menus;

        // Return the view with the cafe and menu data
        return view('menus.manage', compact('cafe', 'menus'));
    }
    

    //show create form
    public function create(Cafe $cafe)
    {
        return view('menus.create', compact('cafe'));
    }

    //edit menu
    public function edit(Cafe $cafe, Menu $menu)
    {
        return view('menus.edit', [
            'cafe' => $cafe,
            'menu' => $menu
        ]);
    }

    //store menu
    public function store(Request $request, $cafe_id)
    {
        $formfields = $request->validate([
            'cafe_id' => 'required|exists:cafes,cafe_id',
            'item_name' => 'required|string|max:255',
            'item_description' => 'nullable|string',
            'price' => 'required|numeric|min:0'
        ]);
    
        if($request->hasFile('item_image'))
        {
            $formfields['item_image'] = $request->file('item_image')->store('item_image', 'public');
        }
    
        // Add cafe_id to form fields
        $formfields['cafe_id'] = $cafe_id;
    
        Menu::create($formfields);
    
        return redirect()->route('menus.manage', ['cafe' => $cafe_id])->with('message', 'Item successfully created');
    }    

    //update Item data
    public function update(Request $request, Menu $menu)
    {
        $formfields = $request->validate([
            'item_name' => 'required|string|max:255',
            'item_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'item_image' => 'nullable|image|max:2048'
        ]);
    
        if ($request->hasFile('item_image')) {
            $formfields['item_image'] = $request->file('item_image')->store('item_images', 'public');
        }
    
        $menu->update($formfields);
    
        // Assuming you need to redirect to the manage page for the cafe associated with the menu
        return redirect()->route('menus.manage', ['cafe' => $menu->cafe_id])->with('message', 'Item updated successfully.');
    }
    

    //delete item
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect('/')->with('message', 'Item deleted successfully');
    }
    
}
