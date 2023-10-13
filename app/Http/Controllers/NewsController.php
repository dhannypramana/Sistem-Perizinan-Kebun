<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function show()
    {
        return view('news.index', [
            'active' => 'news',
            'news' => News::orderBy('created_at')->get(),
        ]);
    }

    public function details($id)
    {
        return view('news.details', [
            'active' => 'news',
            'news' => News::find($id),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:3'],
            'body' => ['required', 'min:3'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 1,
                'errors' => $validator->errors()
            ]);
        }

        $data = News::create([
            'id' => Str::uuid(),
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return response()->json([
            'status' => 0,
            'data' => $data,
        ]);
    }

    public function delete(Request $request)
    {
        $data = News::find($request->id);
        $data->delete();

        return response()->json([
            'success' => 'Sukses menghapus berita!'
        ]);
    }

    public function update(Request $request)
    {
        $data = News::find($request->id);

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:3'],
            'body' => ['required', 'min:3'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 1,
                'errors' => $validator->errors()
            ]);
        }

        $data->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return response()->json([
            'status' => 0,
            'data' => $data,
        ]);
    }
}
