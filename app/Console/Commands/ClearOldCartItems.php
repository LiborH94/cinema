<?php

namespace App\Console\Commands;

use App\Models\CartItem;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:clear-old-cart-items')]
#[Description('Command description')]
class ClearOldCartItems extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $limit = now()->subMinutes(20);

        $deletedCount = CartItem::where('updated_at', '<', $limit)->delete();

        $this->info("Smazáno {$deletedCount} starých položek z košíku.");
    }
}
