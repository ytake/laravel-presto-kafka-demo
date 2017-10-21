<?php
declare(strict_types=1);

namespace App\Http\Controllers\Fulltext;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\View\Factory as ViewFactory;

/**
 * Class FormAction
 */
final class FormAction extends Controller
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
     * @return View
     */
    public function __invoke(): View
    {
        return $this->view->make('fulltext.form', []);
    }
}
