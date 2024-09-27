<?php

namespace App\Http\Controllers;

use App\Exports\BlogsExport;
use Illuminate\Http\Request;

class BlogExportController extends Controller
{
    /**
     * Export blogs as Excel.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function exportBlogs(Request $request)
    {
        $sortField = $request->query('sort', 'id'); // Default sort field
        $sortDirection = $request->query('direction', 'asc'); // Default sort direction

        $export = new BlogsExport();
        return $export->downloadExcel($sortField, $sortDirection);
    }

    /**
     * Export blogs as CSV.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function exportBlogsCsv(Request $request)
    {
        $sortField = $request->query('sort', 'id'); // Default sort field
        $sortDirection = $request->query('direction', 'asc'); // Default sort direction

        $export = new BlogsExport();
        return $export->downloadCsv($sortField, $sortDirection);
    }

    /**
     * Export blogs as JSON.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function exportBlogsJson(Request $request)
    {
        $sortField = $request->query('sort', 'id'); // Default sort field
        $sortDirection = $request->query('direction', 'asc'); // Default sort direction

        $export = new BlogsExport();
        return $export->downloadJson($sortField, $sortDirection);
    }
}
