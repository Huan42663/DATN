<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Products;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('client.event', compact('events'));
    }
    public function show(string $slug)
    {
        $event = Event::where('slug', $slug)->first();
        $products = Products::query()
            ->where('slug', $slug)
            ->join('product_event', 'product_event.product_id', '=', 'products.product_id')
            ->join('events', 'events.event_id', '=', 'product_event.event_id')
            ->join('product_variant', 'product_variant.product_id', '=', 'products.product_id')
            ->selectRaw(
                'products.product_id,products.product_name, products.product_image,product_slug, Max(product_variant.price) as maxPrice , Min(product_variant.price) as minPrice'
            )
            ->groupBy('products.product_id', 'products.product_name', 'products.product_image', 'product_slug')
            ->paginate(4);
        if (empty($event)) {
            return view('error-404')->with('error', "không tìm thấy sự kiện");
        }
        return view('client.event', compact('event', 'products'));
    }
}
