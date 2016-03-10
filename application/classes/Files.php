<?php defined('SYSPATH') or die('No direct script access.');

class Files  {

    private static function uploads_dir()
    {
        return DOCROOT.str_replace('/', DIRECTORY_SEPARATOR, 'media/images/avatars').DIRECTORY_SEPARATOR;
    }

    public static function display($id)
    {
        return '<a href="'.URL::site('user/profile/index/'.$id).'"><img src="/media/images/avatars/avatar-'.$id.'.png" alt=""></a>';
    }

    public static function upload($id)
    {
        $result = array(
            'path' => FALSE,
            'errors' => array(),
        );

        if ( ! Arr::path($_FILES, 'image.size'))
        {
            $result['path'] = TRUE;
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
                $filename = 'avatar-'.$id.'.png';
                $directory = Files::uploads_dir();

                // Set full path to new file or FALSE
                $result['path'] = Upload::save($validation['image'], $filename, $directory);
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