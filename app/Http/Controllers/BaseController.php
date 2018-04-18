<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as LumenController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BaseController extends LumenController
{
	/**
	 * @var Request
	 */
	protected $request;

	/**
	 * @param Request $request
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

    /**
     * Escape input
     * @param string $name
     * @return string
     */
	protected function readInput($name)
    {
    	return preg_replace('`[^a-zA-Z0-9_\.;\- ]`', '', $this->request->input($name));
    }

    /**
     * @param array $data
     * @return Response
     */
    protected function apiResponseSuccess($data = array())
    {
    	$data = array(
    		'status' => 'ok',
    		'data' => $data
    	);
    	return (new Response($this->jsonEncode($data), 200))
    		->header('Content-Type', 'application/json');
    }

    /**
     * @param array $data
     * @return Response
     */
    protected function apiResponseFailure($data = array())
    {
    	$data = array(
   			'status' => 'fail',
   			'data' => $data
    	);
    	return (new Response($this->jsonEncode($data), 500))
    		->header('Content-Type', 'application/json');
    }

    /**
     * @param array $data
     * @return string
     */
    private function jsonEncode($data)
    {
    	return json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    }
}
