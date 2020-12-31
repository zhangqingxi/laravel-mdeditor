<?php

namespace Qasim\LaravelMdEditor;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class MdEditorController extends Controller
{
    /**
     * 图片上传
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {

        $config = config('mdeditor.upload');

        if (!$request->hasFile($config['imageFieldName'])) {

            return $this->json(0, 'NO_FILE_UPLOAD_ERROR', '22');

        }

        $file = $request->file($config['imageFieldName']);

        if (!$file->isValid()) {

            return $this->json(0, $file->getError());

        } elseif ($file->getSize() > $config['imageMaxSize']) {

            return $this->json(0, 'MAX_FILE_SIZE_ERROR');

        } elseif (!empty($config['allow_files']) && !in_array('.' . $file->getClientOriginalExtension(), $config['imageAllowFiles'])) {

            return $this->json(0, 'FILE_TYPE_NOT_ALLOWED_ERROR');

        }

        $filename = $this->getFilename($file, $config['imagePathFormat']);

        //TODO 对图片进行处理逻辑
        $fileurl = $this->store($file, config('mdeditor.disk'), $filename);

        if($fileurl){

            return $this->json(1, 'FILE_UPLOAD_SUCCESS', $fileurl);

        }

        return $this->json(0, 'FILE_UPLOAD_FAIL');

    }


    /**
     * 保存文件
     * @param UploadedFile $file
     * @param string  $filename
     * @param string  $disk
     * @return string
     */
    protected function store(UploadedFile $file, string $disk, string $filename):string
    {

        $bool = Storage::disk($disk)->put($filename, file_get_contents($file->getRealPath()));

        //判断是否上传成功
        if($bool){

            return Storage::url($filename);

        }

        return '';

    }

    /**
     * 返回数据
     * @param int $status
     * @param string $message
     * @param string $url
     * @return JsonResponse
     */
    protected function json(int $status, string $message, string $url = ''): JsonResponse
    {
        return response()->json(['success' => $status, 'message' => trans("mdeditor::mdeditor.{$message}"), 'url' => $url]);
    }

    /**
     * 获取文件名称
     * @param UploadedFile $file
     * @param string $path
     * @return string
     */
    protected function getFilename(UploadedFile $file, string $path): string
    {

        $ext = '.' . $file->getClientOriginalExtension();

        $filename = md5($file->getFilename()) . $ext;

        return $this->formatPath($path, $filename);

    }

    /**
     * 格式化文件路径
     * @param string $path
     * @param string $filename
     * @return mixed
     */
    protected function formatPath(string $path, string $filename): string
    {

        $replacement = array_merge(explode('-', date('Y-y-m-d-H-i-s')), [$filename, time()]);

        $placeholders = ['{yyyy}', '{yy}', '{mm}', '{dd}', '{hh}', '{ii}', '{ss}', '{filename}', '{time}'];

        $path = str_replace($placeholders, $replacement, $path);

        if (!str_contains($path, $filename)) {

            $path = rtrim($path, '/') . '/' . $filename;

        }

        return $path;

    }


}
