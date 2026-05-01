<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    private const CATEGORIES = ['Perabot', 'Elektronik', 'Dapur', 'Lain-lain'];

    public function index()
    {
        $items = Item::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        $categories = self::CATEGORIES;
        return view('admin.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'nullable|numeric|min:0',
            'category'    => 'required|in:' . implode(',', self::CATEGORIES),
            'condition'   => 'required|string|max:20',
            'emoji'       => 'required|string|max:10',
            'status'      => 'required|in:available,sold',
            'sort_order'  => 'integer|min:0',
            'images.*'    => 'nullable|image|max:20480',
        ]);

        $data['price'] = $request->filled('price') ? $data['price'] : null;
        $data['images'] = $this->uploadImages($request);

        Item::create($data);
        return redirect()->route('admin.items.index')->with('success', 'Item berjaya ditambah!');
    }

    public function edit(Item $item)
    {
        $categories = self::CATEGORIES;
        return view('admin.items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'nullable|numeric|min:0',
            'category'    => 'required|in:' . implode(',', self::CATEGORIES),
            'condition'   => 'required|string|max:20',
            'emoji'       => 'required|string|max:10',
            'status'      => 'required|in:available,sold',
            'sort_order'  => 'integer|min:0',
            'images.*'    => 'nullable|image|max:20480',
        ]);

        $data['price'] = $request->filled('price') ? $data['price'] : null;

        $existingImages = $item->images ?? [];

        // Remove images marked for deletion
        $toDelete = $request->input('delete_images', []);
        foreach ($toDelete as $url) {
            $path = str_replace(env('R2_PUBLIC_URL') . '/', '', $url);
            Storage::disk('r2')->delete($path);
            $existingImages = array_filter($existingImages, fn($u) => $u !== $url);
        }

        $newImages = $this->uploadImages($request);
        $data['images'] = array_values(array_merge($existingImages, $newImages));

        $item->update($data);
        return redirect()->route('admin.items.index')->with('success', 'Item berjaya dikemaskini!');
    }

    public function destroy(Item $item)
    {
        foreach ($item->images ?? [] as $url) {
            $path = str_replace(env('R2_PUBLIC_URL') . '/', '', $url);
            Storage::disk('r2')->delete($path);
        }
        $item->delete();
        return redirect()->route('admin.items.index')->with('success', 'Item berjaya dipadam!');
    }

    private function uploadImages(Request $request): array
    {
        $urls = [];
        foreach ($request->file('images', []) as $file) {
            $resized = $this->resizeImage($file->getRealPath(), $file->getMimeType());
            $filename = 'items/' . date('Y/m') . '/' . uniqid() . '.jpg';
            Storage::disk('r2')->put($filename, $resized);
            $urls[] = env('R2_PUBLIC_URL') . '/' . $filename;
        }
        return $urls;
    }

    private function resizeImage(string $path, string $mime): string
    {
        $src = match ($mime) {
            'image/jpeg' => imagecreatefromjpeg($path),
            'image/png'  => imagecreatefrompng($path),
            'image/webp' => imagecreatefromwebp($path),
            default      => imagecreatefromjpeg($path),
        };

        $origW = imagesx($src);
        $origH = imagesy($src);
        $maxW  = 1200;

        if ($origW <= $maxW) {
            $dst = $src;
        } else {
            $ratio = $maxW / $origW;
            $newW  = $maxW;
            $newH  = (int) round($origH * $ratio);
            $dst   = imagecreatetruecolor($newW, $newH);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
            imagedestroy($src);
        }

        ob_start();
        imagejpeg($dst, null, 85);
        $data = ob_get_clean();
        imagedestroy($dst);

        return $data;
    }
}
