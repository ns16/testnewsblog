<?php defined('SYSPATH') or die('No direct script access.');

class Files  {

    private static $filename  = 'avatar-{$id}.png';
    private static $directory = 'media/images/avatars';

    private static function get_filename($id)
    {
        return str_replace('{$id}', $id, self::$filename);
    }

    private static function get_directory()
    {
        return realpath(self::$directory).DIRECTORY_SEPARATOR;
    }

    public static function display($id)
    {
        return '<a href="'.URL::get_user_default_url('profile', 'index', $id).'"><img src="/'.self::$directory.'/'.self::get_filename($id).'" alt=""></a>';
    }

    public static function upload($id)
    {
        $result = array(
            'check'  => FALSE,
            'errors' => array(),
        );

        if ( ! Arr::path($_FILES, 'image.size'))
        {
            $result['check'] = TRUE;
        }
        else
        {
            // Create object of Validation class
            $validation = Validation::factory($_FILES);

            // Set label and create validation rules
            $validation
                ->label('image', 'Изображение')
                ->rules('image',
                    array(
                        array('Upload::not_empty'),
                        array('Upload::size', array(':value', '5120KiB')),
                        array('Upload::image', array(':value', 1080, 1920)),
                    )
                );

            // Check that validation rules are made
            if ($validation->check())
            {
                // Set filename and directory
                $filename  = Files::get_filename($id);
                $directory = Files::get_directory();

                // Set full path to new file or FALSE
                $result['check'] = Upload::save($validation['image'], $filename, $directory);
            }
            else
            {
                // Get messages about errors
                $result['errors'] = $validation->errors('validation');
            }
        }

        return $result;
    }

} // End Files