<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Models\Team;
use App\Models\Context;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ImagelibraryController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['images'] = \DB::table('pagebuilder__uploads')->get();
        return view('admin.Image_Library.index', $data);
    }

    public function updateFiles(Request $request)
    {
        try {
            if (isset($request->images)) {
                $curr_time = strtotime(date('Y-m-d H:i:s')) . rand(111111, 999999);
                $image = $request->file('images');
                $filename = $image->getClientOriginalName();
                $image->storeAs('pagebuilder/uploads/' . $curr_time . '/', $filename);
                $destinationPath = 'pagebuilder/uploads/' . $curr_time . '/' . $filename; // local storage
                $destiny = $curr_time . '/' . $filename; // local storage
                $image->move(public_path('pagebuilder/uploads/') . $curr_time . '/', $filename);
                $extension = explode('.', $filename);

                \DB::table('pagebuilder__uploads')->where('server_file', 'like', '%' . $request->old_serverFile . '%')->update(['public_id' => $curr_time, 'original_file' => $filename, 'mime_type' => "image/" . end($extension), 'server_file' => $destiny, 'title_image' => $request->title, 'alt_image' => $request->alt]);
                \DB::table('product_images')->where('url', 'like', '%' . $request->old_serverFile . '%')->update(['url' => $destinationPath, 'title_image' => $request->title, 'alt_image' => $request->alt]);
                \DB::table('teams')->where('image', 'like', '%' . $request->old_serverFile . '%')->update(['image' => $destinationPath, 'title_image' => $request->title, 'alt_image' => $request->alt]);
                \DB::table('categories')->where('image', 'like', '%' . $request->old_serverFile . '%')->update(['image' => $destinationPath, 'title_image' => $request->title, 'alt_image' => $request->alt]);
            } else {
                \DB::table('pagebuilder__uploads')->where('server_file', 'like', '%' . $request->old_serverFile . '%')->update(['title_image' => $request->title, 'alt_image' => $request->alt]);
                \DB::table('product_images')->where('url', 'like', '%' . $request->old_serverFile . '%')->update(['title_image' => $request->title, 'alt_image' => $request->alt]);
                \DB::table('teams')->where('image', 'like', '%' . $request->old_serverFile . '%')->update(['title_image' => $request->title, 'alt_image' => $request->alt]);
                \DB::table('categories')->where('image', 'like', '%' . $request->old_serverFile . '%')->update(['title_image' => $request->title, 'alt_image' => $request->alt]);
            }
            return redirect()->back();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteImageLib(Request $request, $id)
    {
        try {
            $fileDetails = \DB::table('pagebuilder__uploads')->where('id', $id)->first();
            $old_serverFile = $fileDetails->server_file;
            \DB::table('pagebuilder__uploads')->where('server_file', 'like', '%' . $old_serverFile . '%')->delete();
            \DB::table('product_images')->where('url', 'like', '%' . $old_serverFile . '%')->delete();
            \DB::table('teams')->where('image', 'like', '%' . $old_serverFile . '%')->delete();
            \DB::table('categories')->where('image', 'like', '%' . $old_serverFile . '%')->delete();

            $baseUrl = "pagebuilder/uploads/" . $old_serverFile;
            $public = 'public/' . $baseUrl;
            $storage = storage_path('app/' . $baseUrl);
            removeFile($public);
            removeFile($storage);
            return redirect()->back();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function uploadNewFile(Request $request)
    {
        try {
            $curr_time = strtotime(date('Y-m-d H:i:s')) . rand(111111, 999999);
            $image = $request->file('images');
            $filename = $image->getClientOriginalName();
            $image->storeAs('pagebuilder/uploads/' . $curr_time . '/', $filename);
            $destinationPath = 'pagebuilder/uploads/' . $curr_time . '/' . $filename; // local storage
            $destiny = $curr_time . '/' . $filename; // local storage
            $image->move(public_path('pagebuilder/uploads/') . $curr_time . '/', $filename);
            $extension = explode('.', $filename);
            \DB::table('pagebuilder__uploads')->insert(['public_id' => $curr_time, 'original_file' => $filename, 'mime_type' => "image/" . end($extension), 'server_file' => $destiny, 'title_image' => $request->title, 'alt_image' => $request->alt]);
            return redirect()->back();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    public function fileSearch(Request $request)
    {
        return \DB::table('pagebuilder__uploads')->where('original_file', 'LIKE', '%' . $request->name . '%')->get();
    }

    public function getAllImg(Request $request)
    {
        return \DB::table('pagebuilder__uploads')->get();
    }

}
