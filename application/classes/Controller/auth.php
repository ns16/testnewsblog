<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Body {

    public function action_login()
    {
        // Check that user is logged
        if($this->user)
        {
            throw new HTTP_Exception_403;
        }

        $message = '';
        $errors = array();

        $view = View::factory('auth/login');

        // Get values of POST array
        $post = $this->request->post();
        // Get username from post
        $username = Arr::get($post, 'username');

        // Check that HTTP method is POST
        if(HTTP_Request::POST == $this->request->method())
        {
            // Create object of Validation class
            $validation = Validation::factory($this->request->post());

            // Set labels for fields
            $validation
                ->label('username', 'Имя')
                ->label('password', 'Пароль');

            // Create validation rules
            $validation
                ->rule('username', 'not_empty')
                ->rule('password', 'not_empty');

            // Check that validation rules are made
            if($validation->check())
            {
                //
                $remember = isset($post['remember'])
                    ? (bool)$post['remember']
                    : FALSE;

                // Check that username and password are valid
                $success = Auth::instance()->login(
                    $post['username'],
                    $post['password'],
                    $remember
                );

                if($success)
                {
                    // Redirect to view articles page
                    $this->redirect(URL::site('/articles'));
                }
                else
                {
                    //
                    $message = 'Ошибка входа!';
                }
            }
            else
            {
                // Get messages about errors
                $errors = $validation->errors('validation');
            }
        }

        $view
            ->set('message', $message)
            ->set('errors', $errors)
            ->set('username', $username);

        $links = array(
            'media/css/style.css',
            'media/css/login.css',
        );

        $this->template->title = 'Вход';
        $this->template->links = $links;
        $this->body->container = $view;
    }

    public function action_logout()
    {
        // Check that user is not logged
        if(!$this->user)
        {
            throw new HTTP_Exception_403;
        }

        // User logout
        Auth::instance()->logout();

        // Redirect to view articles page
        $this->redirect(URL::site('articles'));
    }

} // End Autn