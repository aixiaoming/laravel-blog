<?php
/**
 * Created by PhpStorm.
 * User: MrCong <i@cong5.net>
 * Date: 2017/2/12
 * Time: 16:28
 */

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Persimmon\Storage\QiniuUploads;

class FileController extends Controller
{
    
    public function index(QiniuUploads $qiniuUploads, Request $request)
    {
        $files = $qiniuUploads->localFiles($request);
        return response()->json($files);
    }

    public function store(QiniuUploads $qiniuUploads, Request $request)
    {
        $data = $qiniuUploads->uploads($request);
        if ($data['status'] == 200) {
          $data['filename'] = str_replace('https', 'http', $data['filename']);
          $data['url'] = str_replace('https', 'http', $data['url']);
            return $data;
        }
        return ['status' => 400, 'filename' => '', 'url' => ''];
    }


}