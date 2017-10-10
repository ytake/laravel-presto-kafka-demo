<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class IndexAction
 */
final class IndexAction extends Controller
{
    /**
     * @param Request $request
     *
     * @return View
     */
    public function __invoke(Request $request): View
    {
        return view('welcome');
    }
}
