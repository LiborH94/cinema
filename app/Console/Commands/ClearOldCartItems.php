<?php

namespace App\Console\Commands;

use App\Models\CartItem;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('clear-old-cart-items')]
#[Description('deletes items from cart while is inactive for 10 minutes')]
class ClearOldCartItems extends Command
{
    /**
     * deletes seat items from cart after 20 minutes while cart is inactive (no new items)
     */
    public function handle()
    {
        $limit = now()->subMinutes(10);
        CartItem::where('updated_at', '<', $limit)->delete();
    }
}
