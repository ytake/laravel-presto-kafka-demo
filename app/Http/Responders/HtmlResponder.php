<?php
declare(strict_types=1);

namespace App\Http\Responders;

use Illuminate\Http\Response;
use Illuminate\View\Factory as ViewFactory;

/**
 * Class HtmlResponder
 */
class HtmlResponder implements Respondable
{
    /** @var ViewFactory */
    protected $factory;

    /** @var string */
    protected $template = '';

    /** @var Response */
    protected $response;

    /**
     * HtmlResponder constructor.
     *
     * @param ViewFactory $factory
     * @param Response    $response
     */
    public function __construct(ViewFactory $factory, Response $response)
    {
        $this->factory = $factory;
        $this->response = $response;
    }

    /**
     * @param array $parameters
     *
     * @return Response
     */
    public function emit(array $parameters = [])
    {
        return $this->response->setContent(
            $this->factory->make($this->template, $parameters)
        );
    }

    /**
     * @param string $template
     *
     * @return void
     */
    public function template(string $template)
    {
        $this->template = $template;
    }
}
