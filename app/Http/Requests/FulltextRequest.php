<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class FulltextRequest
 */
final class FulltextRequest extends FormRequest
{
    /** @var string  */
    protected $redirectRoute = 'fulltext.form';

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'fulltext' => 'required'
        ];
    }
}
