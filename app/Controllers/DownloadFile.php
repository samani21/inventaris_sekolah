<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DownloadFile extends BaseController
{
    public function download($filename)
    {
        // Path lengkap ke file yang akan diunduh
        $filePath =  'public/file/' . $filename;
        return $this->response->download($filePath, null);
    }
}
