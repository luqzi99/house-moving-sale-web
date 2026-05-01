<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $categories = ['Semua', 'Perabot', 'Elektronik', 'Dapur', 'Lain-lain'];
        $activeCategory = $request->input('category', 'Semua');
        $search = $request->input('search', '');

        $query = Item::where('status', 'available')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc');

        if ($activeCategory && $activeCategory !== 'Semua') {
            $query->where('category', $activeCategory);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $items = $query->get();
        $whatsappNumber = env('WHATSAPP_NUMBER', '601116185660');

        $firstWithImage = Item::whereNotNull('images')->where('images', '!=', '[]')->first();
        $images = $firstWithImage ? array_values((array) $firstWithImage->images) : [];
        $ogImage = $images[0] ?? null;

        return view('public.index', compact('items', 'categories', 'activeCategory', 'search', 'whatsappNumber', 'ogImage'));
    }
}
