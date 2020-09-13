<?php
namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Table;
use App\Category;
use App\Menu;
use App\Sale;
use App\SaleDetail;

use Illuminate\Support\Facades\Auth; //get the user currentlly logged in



class CashierController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('cashier.index')->with('categories', $categories);
    }
    
    public function getTables(){
        $tables = Table::all();
        $html = '';
        foreach($tables as $table){
            $html .= '<div class="col-md-2 mb-4">';
            $html .= 
            '<button class="btn btn-primary btn-table" data-id="'.$table->id.'" data-name="'.$table->name.'">
            <img class="img-fluid" src="'.url('/img/table.svg').'"/>
            <br>';
            if($table->status == "available"){
                //table available
                $html .= '<span class="badge badge-success">'.$table->name.'</span>';
            }else{ 
                //reserved
                $html .= '<span class="badge badge-danger">'.$table->name.'</span>';
            }
            $html .='</button>';
            $html .= '</div>';
        }
        return $html;

    }

    public function getMenuByCategory($category_id){
        $menus = Menu::where('category_id', $category_id)->get();
        $html = '';
        foreach($menus as $menu){
            $html .= '
            <div class="col-md-3 text-center">
                <a class="btn btn-outline-secondary btn-menu" data-id="'.$menu->id.'">
                    <img class="img-fluid" src="'.url('/img/menuImages/'.$menu->image).'">
                    <br>
                    '.$menu->name.'
                    <br>
                    $'.number_format($menu->price).'
                </a>
            </div>
            
            ';
        }
        return $html;

    }

        public function orderFood(Request $request){
            $menu = Menu::find($request->menu_id);
            $table_id = $request->table_id;
            $table_name = $request->table_name;
            $sale = Sale::where('table_id', $table_id)->where('sale_status','unpaid')->first();
            //if there is no sale create sale record
            
            if(!$sale){
                $sale = new Sale();
                $user=Auth::user();
                $sale->table_id = $table_id;
                $sale->table_name = $table_name;
                $sale->user_id = $user->id;
                $sale->user_name = $user->name;
                $sale->save();
                $sale_id = $sale->id;
                // update table status to reserved
                $table = Table::find($table_id);
                $table->status = "reserved";
                $table->save();
            }else{ 
                $sale_id = $sale->id;
            }
    
            // Add teh ordered menu to the sale_details table
            $saleDetail = new SaleDetail();
            $saleDetail->sale_id = $sale_id;
            $saleDetail->menu_id = $menu->id;
            $saleDetail->menu_name = $menu->name;
            $saleDetail->menu_price = $menu->price;
            $saleDetail->quantity = $request->quantity;
            $saleDetail->save();
            //update total price in the sales table
            $sale->total_price = $sale->total_price + ($request->quantity * $menu->price);
            $sale->save();

            return $sale->total_price;//displa the total price on order-detail(temporary)
    
        }
    
       
}