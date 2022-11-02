<?php

namespace App\Http\Controllers;

// Models
use App\Models\{Media, Uploader};

use Illuminate\Http\Request;
use App\Traits\MediaTrait;

use App\Http\Requests\ImageRequest;

class UploaderController extends Controller
{
    use MediaTrait;

    /**
     * Display a listing of the Images.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // List the Images Data
            $data = Uploader::select('id','title','description')->get();
            
            return response()->json([
                'success' => true,
                'message' => (
                               (count($data) > 0)
                               ? 'Images data loaded successfully!!'
                               : 'No Data Available'
                            ),
                'data'    => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save Images!! Please try again.',
                'data'    => []
            ], 500);
        }

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store Multiple Images.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageRequest $request)
    {
        try {
            // Save the Images Data
            $data = Uploader::create($request->except('images'));
            
            // Save the Multiple Images
            $input = $request->all();
            $media = $this->saveImages($input);
            
            foreach ($media as $item) {
                $item['uploader_id'] = $data->id;
                Media::create($item);
            }

            return response()->json([
                'success' => true,
                'message' => 'Images data saved successfully!!',
                'data'    => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save Images!! Please try again.',
                'data'    => []
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // Find the Specific Images Data
            $data = Uploader::find($id);
            $media = Media::where('uploader_id', $id)->get();
            
            return response()->json([
                'success' => true,
                'message' => 'Images data loaded successfully!!',
                'data'    => [
                    'data'  => $data,
                    'media' => $media
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found',
                'data'    => []
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
}
