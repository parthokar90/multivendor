<?php

namespace App\Observers\product;

use App\Models\vendor\Product;
use App\Models\vendor\Shop;

class ProductObserver
{
        /**

     * Handle the Product "created" event.

     *

     * @param  \App\Models\Product  $product

     * @return void

     */

    public function creating(Product $product)

    {

        // $product->product_slug = \Str::slug($product->product_name);
        // $product->quantity = $product->quantity;

    }

  

    /**

     * Handle the Product "created" event.

     *

     * @param  \App\Models\Product  $product

     * @return void

     */

    public function created(Product $product)

    {

        // $product->unique_id = 'PR-'.$product->id;



    }

  

    /**

     * Handle the Product "updated" event.

     *

     * @param  \App\Models\Product  $product

     * @return void

     */

    public function updated(Product $product)

    {

          

    }

  

    /**

     * Handle the Product "deleted" event.

     *

     * @param  \App\Models\Product  $product

     * @return void

     */

    public function deleted(Product $product)

    {

          

    }

  

    /**

     * Handle the Product "restored" event.

     *

     * @param  \App\Models\Product  $product

     * @return void

     */

    public function restored(Product $product)

    {

          

    }

  

    /**

     * Handle the Product "force deleted" event.

     *

     * @param  \App\Models\Product  $product

     * @return void

     */

    public function forceDeleted(Product $product)

    {

          

    }
}
