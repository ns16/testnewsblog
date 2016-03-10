<div id="container-social" class="col-md-6">
    <h3>Профили в соц. сетях</h3>
    <form action="" method="post" class="form-horizontal">
        <div class="form-group">
            <label for="profile-vk" class="col-md-4 control-label">ВКОНТАКТЕ:</label>
            <div class="col-md-8">
                <input id="profile-vk" class="form-control" type="text" value="<?= $settings['profile_vk']; ?>" name="profile_vk">
            </div>
            <div class="col-md-12 text-danger">
                <?= Arr::get($errors, 'profile_vk'); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="profile-fb" class="col-md-4 control-label">FACEBOOK:</label>
            <div class="col-md-8">
                <input id="profile-fb" class="form-control" type="text" value="<?= $settings['profile_fb']; ?>" name="profile_fb">
            </div>
            <div class="col-md-12 text-danger">
                <?= Arr::get($errors, 'profile_fb'); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="profile-gp" class="col-md-4 control-label">GOOGLE+:</label>
            <div class="col-md-8">
                <input id="profile-gp" class="form-control" type="text" value="<?= $settings['profile_gp']; ?>" name="profile_gp">
            </div>
            <div class="col-md-12 text-danger">
                <?= Arr::get($errors, 'profile_gp'); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="profile-tw" class="col-md-4 control-label">TWITTER:</label>
            <div class="col-md-8">
                <input id="profile-tw" class="form-control" type="text" value="<?= $settings['profile_tw']; ?>" name="profile_tw">
            </div>
            <div class="col-md-12 text-danger">
                <?= Arr::get($errors, 'profile_tw'); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="profile-ok" class="col-md-4 control-label">ОДНОКЛАССНИКИ:</label>
            <div class="col-md-8">
                <input id="profile-ok" class="form-control" type="text" value="<?= $settings['profile_ok']; ?>" name="profile_ok">
            </div>
            <div class="col-md-12 text-danger">
                <?= Arr::get($errors, 'profile_ok'); ?>
            </div>
        </div>

        <div id="container-social-buttons"  class="form-group">
            <a href="<?= URL::site('user/profile/index/'.$user_id); ?>" class="btn btn-default">Отменить</a>
            <input class="btn btn-default" type="submit" value="Сохранить" name="">
        </div>
    </form>
</div>