<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{

        public function loaditems()
        {
        // we can pass resopnose in three way in laravel

        // **--------------------------- [1]----------------------------------------------**
            // yat apan items array la adhi json madhe convert kel ani mg data variable la json method madhe pathval karan apan direct item json madhe pathval ast tr tyane item madhe jo arry ahe tyana nast json kel tyane fakt baher cha jo array ahe like ['message' => 'Item fetch successfully','data'=>$data] yach converionsin json madhe kel asat pn item item madhe array as it is asta pn normal apan all data json madhe convert karto mhnun apan adhi tya item arry la json madhe convert kel ani mg json function madhe pass kel ata jo main array bhetnar like ['message' => 'Item fetch successfully','data'=>$data] yat json asnar tyat message ani data ashe 2 elemet astnar ani data madhe parat ek json array asnar to item cha  mhnje ata apla jo main data ahe to json of json jhalela ahe  like 'data'=>$data .. apala main data ya madhe ahe aplyala ha data milvanyasathi view la yavr work karava lagnar tevha he lakshat thevaych ah data madhe json of json ahe data. 

            // jr aplyala multiple data json madhe pathvaycha asel tr hi mehtod used karaychi 

            // e.g
            // $items = Item::all();
            // $data = json_encode($items);
            //  return response()->json(['message' => 'Item fetch successfully','data'=>$data]);

        // **---------------------------- end [1] --------------------------------------------------**



        // **----------------------------[2] --------------------------------------------------**
            // ata ya madhe apan kay kel ahe jo array ahe itemcha to direct json madhe pass kela ahe .. tya mule jo array ahe to json houn view la janar pn yat smaja aplyala ekach varibale n pass karta ajun message vagere pass karaycha to pass krta nahi yenar tya sathi aplyala json madhe aray banvav lagel ani to pass karava lagael mhnun apan tevha varachi 1 no chi method used karto jevha multiple data pass karaycha ahe 

            // jr aplyala single data json madhe pathvaycha asel tr hi mehtod used karaychi 

            // e.g
            // $items = Item::all();
            // return response()->json($items);

        // **----------------------------end [2] --------------------------------------------------**


        
        // **---------------------------- [3]--------------------------------------------------**
            // ya method madhe pn apan same 2 no sarkh jo array ahe tyala json karun return karto fakt yat farak evada ahe adhi apan json madhe convert kel ani g response la data pass kela 

            // jr aplyala single data json madhe pathvaycha asel tr hi mehtod used karaychi 

            $items = Item::all();
            $data = json_encode($items);  
            return response($data);
        // **----------------------------end [3] --------------------------------------------------**
        
           
        }


        public function store(Request $request)
        {
            $item = new Item();
            $item->name = $request->input('name');
            $item->save();
            return response()->json(['message' => 'Item added successfully']);
        }

        public function update(Request $request, $id)
        {
            $item = Item::find($id);
            $item->name = $request->input('name');
            $item->save();
            return response()->json(['message' => 'Item updated successfully']);
        }

        public function destroy($id)
        {
            $item = Item::find($id);
            $item->delete();
            return response()->json(['message' => 'Item deleted successfully']);
        }

}
