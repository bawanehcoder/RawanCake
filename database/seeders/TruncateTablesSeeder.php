<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TruncateTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            'order_details',
            'orders',
            'option_detils',
            'items',
            'sub_options',
            'item_options',
            'categories',
            'offers',
            'discounts',
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::table('media')->whereIn('collection_name', ['categories', 'attached_products', 'products', 'product_sub_options', 'attached_product_sub_options'])->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
