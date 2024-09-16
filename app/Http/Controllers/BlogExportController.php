<?php

namespace App\Http\Controllers;

use App\Exports\BlogsExport;
use Illuminate\Http\Request;

class BlogExportController extends Controller
{
    /**
     * Handle the export request and return the spreadsheet.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportBlogs()
    {
        $export = new BlogsExport();
        return $export->download();
    }
}
