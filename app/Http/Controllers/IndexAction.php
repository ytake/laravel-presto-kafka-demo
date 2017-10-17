<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;

/**
 * Class IndexAction
 */
final class IndexAction extends Controller
{
    /** @var ViewFactory */
    private $view;

    /**
     * AnalyzeAction constructor.
     *
     * @param ViewFactory $view
     */
    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }

    /**
     * @param Request $request
     *
     * @return View
     */
    public function __invoke(Request $request): View
    {
        return $this->view->make('welcome');
    }
}
