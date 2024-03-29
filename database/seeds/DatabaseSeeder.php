<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use App\Product;
use App\Transaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        $usersQuatity = 1000;
        $categoriesQuatity = 30;
        $productsQuatity = 1000;
        $transactionsQuantity = 1000;

        factory(User::class, $usersQuatity)->create();
        factory(Category::class, $categoriesQuatity)->create();
        factory(Product::class, $productsQuatity)->create()
            ->each(function($product){
                $categories = Category::all()->random(mt_rand(1, 5))->pluck('id');
                $product = $product->categories()->attach($categories);
            });

        factory(Transaction::class, $transactionsQuantity)->create();

        // $this->call(UsersTableSeeder::class);
    }
}
