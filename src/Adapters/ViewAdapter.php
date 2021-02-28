<?php
namespace App\Adapters;

use Psr\Http\Message\ResponseInterface;

class ViewAdapter
{
    /**
     * @var \Smarty
     */
    private $smarty;

    public function __construct(\Smarty $smarty)
    {
        $this->smarty = $smarty;
    }

    public function render(ResponseInterface $response, string $template, array $data = []): ResponseInterface
    {
        $this->smarty->assign($data);
        $response->getBody()->write($this->smarty->fetch($template));
        return $response;
    }
}