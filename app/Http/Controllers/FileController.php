<?php

namespace App\Http\Controllers;


use App\Http\Service\FileService;
use DB;

class FileController extends Controller
{
    /**
     * @var FileService
     */
    private $fileService;


    function __construct()
    {
        $this->fileService = new FileService();
    }


    public function download($request)
    {

    }

    /**
     * @param $request
     * @return mixed
     */
    public function upload($request)
    {
        return $this->fileService->upload($request);
    }
}
