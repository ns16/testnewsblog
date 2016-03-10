<?php defined('SYSPATH') OR die('No direct access allowed.');

class Auth_ORM extends Kohana_Auth_ORM {

    /**
     * Logs a user in.
     * In this version, you cannot used username instead email to login.
     *
     * @param   string   $username
     * @param   string   $password
     * @param   boolean  $remember  enable autologin
     * @return  boolean
     */
    protected function _login($user, $password, $remember)
    {
        if ( ! is_object($user))
        {
            $username = $user;

            // Load the user
            $user = ORM::factory('User');
            // $user->where($user->unique_key($username), '=', $username)->find();
            $user->where('username', '=', $username)->find();
        }

        if (is_string($password))
        {
            // Create a hashed password
            $password = $this->hash($password);
        }

        // If the passwords match, perform a login
        if ($user->has('roles', ORM::factory('Role', array('name' => 'login'))) AND $user->password === $password)
        {
            if ($remember === TRUE)
            {
                // Token data
                $data = array(
                    'user_id'    => $user->pk(),
                    'expires'    => time() + $this->_config['lifetime'],
                    'user_agent' => sha1(Request::$user_agent),
                );

                // Create a new autologin token
                $token = ORM::factory('User_Token')
                    ->values($data)
                    ->create();

                // Set the autologin cookie
                Cookie::set('authautologin', $token->token, $this->_config['lifetime']);
            }

            // Finish the login
            $this->complete_login($user);

            return TRUE;
        }

        // Login failed
        return FALSE;
    }

    /**
     * Get the stored password for a username.
     *
     * @param   mixed   $user  username string, or user ORM object
     * @return  string
     */
    public function password($user)
    {
        if ( ! is_object($user))
        {
            $username = $user;

            // Load the user
            $user = ORM::factory('User');
            $user->where($user->unique_key($username), '=', $username)->find();
        }

        return $user->password;
    }

    /**
     * Compare password with original (hashed). Works for current (logged in) user
     *
     * @param   string  $password
     * @return  boolean
     */
    public function check_password($password)
    {
        $user = $this->get_user();

        if ( ! $user)
            return FALSE;

        return ($this->hash($password) === $user->password);
    }
}