<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller {

    protected $answer = array(
        'status' => 0,
        'error'  => '',
        'body'   => '',
    );

    public function before()
    {
        parent::before();

        if ( ! $this->request->is_ajax())
        {
            throw new HTTP_Exception_404;
        }
    }

    public function after()
    {
        parent::after();

        echo json_encode($this->answer);
    }

    protected function answer(array $array = array())
    {
        $this->answer = Arr::merge($this->answer, $array);
    }

} // End Ajax