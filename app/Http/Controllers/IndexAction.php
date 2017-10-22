<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Responders\HtmlResponder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class IndexAction
 */
final class IndexAction extends Controller
{
    /**
     * @param Request       $request
     * @param HtmlResponder $responder
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, HtmlResponder $responder): Response
    {
        $responder->template('welcome');

        return $responder->emit();
    }
}
