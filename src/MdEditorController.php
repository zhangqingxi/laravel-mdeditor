<?php
namespace Qasim\LaravelMdEditor;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MdEditorController extends Controller
{

    public function upload(Request $request)
    {

        $config = config('mdeditor.upload');

        if ($request->hasFile($config['imageFieldName'])) {

            return $this->json(0, 'NO_FILE_UPLOAD_ERROR');

        }

        $file = $request->file($config['imageFieldName']);

        if (!$file->isValid()) {

            return $this->json(0, $file->getError());

        } elseif ($file->getSize() > $config['imageMaxSize']) {

            return $this->json(0, 'MAX_FILE_SIZE_ERROR');

        } elseif (!empty($config['allow_files']) &&  !in_array('.'.$file->getClientOriginalExtension(), $config['imageAllowFiles'])) {

            return $this->json(0, 'FILE_TYPE_NOT_ALLOWED_ERROR');

        }

        $filename = $this->getFilename($file, $config);
        echo $filename;
        exit;
        return $this->json(1, 'UPLOAD_ERR_NO_FILE');
        $file = $request->file('editormd-image-file');

        $data = $request->all();

        return [];

    }


    /**
     * 返回数据
     * @param int $status
     * @param string $message
     * @param string $url
     * @return \Illuminate\Http\JsonResponse
     */
    protected function json(int $status, string $message, string $url = '')
    {
        return response()->json(['success' => $status, 'message' => trans("mdeditor::mdeditor.{$message}"), 'url' => $url]);
    }

    /**
     * Get the new filename of file.
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @param string                                               $path
     *
     * @return string
     */
    protected function getFilename(UploadedFile $file, string $path)
    {
        $ext = '.'.$file->getClientOriginalExtension();

        $filename = md5($file->getFilename()).$ext;

        echo $file->getClientOriginalName();

        return $this->formatPath($paht, $filename);
    }

    /**
     * Format the storage path.
     *
     * @param string $path
     * @param string $filename
     *
     * @return mixed
     */
    protected function formatPath($path, $filename)
    {
        $replacement = array_merge(explode('-', date('Y-y-m-d-H-i-s')), [$filename, time()]);
        $placeholders = ['{yyyy}', '{yy}', '{mm}', '{dd}', '{hh}', '{ii}', '{ss}', '{filename}', '{time}'];
        $path = str_replace($placeholders, $replacement, $path);

        //替换随机字符串
        if (preg_match('/\{rand\:([\d]*)\}/i', $path, $matches)) {
            $length = min($matches[1], strlen(PHP_INT_MAX));
            $path = preg_replace('/\{rand\:[\d]*\}/i', str_pad(mt_rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT), $path);
        }

        if (!str_contains($path, $filename)) {
            $path = str_finish($path, '/').$filename;
        }

        return $path;
    }


}
