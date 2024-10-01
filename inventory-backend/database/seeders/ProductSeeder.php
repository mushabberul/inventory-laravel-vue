<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\User as Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(){
        $products = array(
            array('id' => '1','category_id' => '4','brand_id' => '6','supplier_id' => '5','name' => 'Hilsha (700-799 gm)','slug' => 'hilsha-700-799-gm','original_price' => '1250.00','sell_price' => '1200.00','stock' => '20','description' => 'Natural Hilsha Fish','file' => '/storage/product/1.webp','code' => '001','barcode' => '/storage/product/barcode/1.png','qrcode' => '/storage/product/qrcode/1.svg','status' => '1','created_at' => '2024-09-28 02:59:25','updated_at' => '2024-09-28 02:59:25','deleted_at' => NULL),
            array('id' => '2','category_id' => '4','brand_id' => '6','supplier_id' => '4','name' => 'Miniket Rice 1kg','slug' => 'miniket-rice-1kg','original_price' => '72.00','sell_price' => '70.00','stock' => '40','description' => 'Miniket Rice Loose(P) (Jirashail)','file' => '/storage/product/2.webp','code' => '002','barcode' => '/storage/product/barcode/2.png','qrcode' => '/storage/product/qrcode/2.svg','status' => '1','created_at' => '2024-09-28 03:01:36','updated_at' => '2024-09-28 03:01:36','deleted_at' => NULL)
          );

          Product::insert($products);
    }
}

