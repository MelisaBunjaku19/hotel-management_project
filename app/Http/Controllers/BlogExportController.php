<?php

namespace App\Http\Controllers;

use App\Exports\BlogsExport;
use Illuminate\Http\Request;

class BlogExportController extends Controller
{
    /**
     * Export blogs as Excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportBlogs()
    {
        $export = new BlogsExport();
        return $export->downloadExcel();
    }

    /**
     * Export blogs as CSV.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportBlogsCsv()
    {
        $export = new BlogsExport();
        return $export->downloadCsv();
    }

    /**
     * Export blogs as JSON.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportBlogsJson()
    {
        $export = new BlogsExport();
        return $export->downloadJson();
    }
}
