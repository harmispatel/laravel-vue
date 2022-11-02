<?php

namespace App\Traits;

use Illuminate\Http\Request;

// Models
use App\Models\{ Media };

trait MediaTrait {
    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function saveImages($request)
    {
        $media = [];
        
        $files = $request['images'];
        
        for ($i=0; $i < count($files); $i++) { 
            $original_file_name = $files[$i]->getClientOriginalName();
            $image_mimetype = $files[$i]->getClientMimeType();
            $image_name = time().'_'.$files[$i]->getClientOriginalName();
            $image_path = public_path(). Media::FILE_PATH;
            $files[$i]->move($image_path, $image_name);
        
            $media[$i]['name'] = $image_name;
            $media[$i]['path'] = Media::FILE_PATH . '/' . $image_name;
            $media[$i]['original_name'] = $original_file_name;
            $media[$i]['mime_type'] = $image_mimetype;
        }
        
        return $media;
    }
}