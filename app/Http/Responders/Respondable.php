<?php
declare(strict_types=1);

namespace App\Http\Responders;

/**
 * Interface Respondable
 */
interface Respondable
{
    /**
     * @param array $parameters
     *
     * @return mixed
     */
    public function emit(array $parameters = []);
}
