<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Block;
use Illuminate\Http\Request;
use ZanySoft\Zip\Zip;
use ZipArchive;

class DownloadController extends Controller
{



    public function downloads(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        $path = $request->server->all();
        /*dd($path['QUERY_STRING']);*/

        return response()->download($path['QUERY_STRING']);
    }

    /*public function zipDownload(Request $request)
    {
        $project_id = $request->server('QUERY_STRING');
        $blocks = Block::where('project_id', $project_id)->get();
        dd($blocks);
        $zip = new ZipArchive(); // Создаем объект для работы с ZIP-архивами
        $zip->open( 'archive.zip' , ZIPARCHIVE::CREATE ); // Открываем (создаем) архив archive.zip
        foreach ($request as $block){
            dd($block);
        }
        $zip->addFile( 'index.php' ); // Добавляем в архив файл index.php
        $zip->close(  );

    }*/

}
