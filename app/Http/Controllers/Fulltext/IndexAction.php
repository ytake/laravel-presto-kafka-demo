<?php
declare(strict_types=1);

namespace App\Http\Controllers\Fulltext;

use App\DataAccess\FulltextIndex;
use App\Http\Controllers\Controller;

class IndexAction extends Controller
{
    public function __invoke(FulltextIndex $fulltextIndex)
    {
        dd($fulltextIndex->all());
    }
}
