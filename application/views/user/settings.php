<div id="container">
    <?= Widget::factory('user_settings_nav',
        array(
            'user_id' => $user_id,
        )
    ); ?>
    <?= $content; ?>
</div>