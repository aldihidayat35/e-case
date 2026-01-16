<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Set page title and breadcrumbs for view
     */
    protected function setPageData($title, $breadcrumbs = [])
    {
        return [
            'pageTitle' => $title,
            'breadcrumbs' => $breadcrumbs
        ];
    }
}
