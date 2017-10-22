<?php
declare(strict_types=1);

namespace App\Http\Controllers\Fulltext;

use App\Http\Controllers\Controller;
use App\Http\Responders\HtmlResponder;
use Illuminate\Http\Response;

/**
 * Class FormAction
 */
final class FormAction extends Controller
{
    /**
     * @param HtmlResponder $responder
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(HtmlResponder $responder): Response
    {
        $responder->template('fulltext.form');

        return $responder->emit();
    }
}
