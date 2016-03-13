<div id="container-personal" class="col-md-6">
    <h3>Личные данные</h3>
    <form action="" method="post" class="form-horizontal">
        <div class="form-group">
            <label for="name" class="col-md-4 control-label">Имя:</label>
            <div class="col-md-8">
                <input id="name" class="form-control" type="text" value="<?= $settings['name']; ?>" name="name">
            </div>
            <div class="col-md-12 text-danger">
                <?= Arr::get($errors, 'name'); ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Дата рождения:</label>
            <div id="container-personal-birthdate" class="col-md-8">
                <select class="form-control" name="year">
                    <option value="0">--</option>
                    <? foreach ($years as $year): ?>
                        <option value="<?= $year; ?>"
                            <? if (Arr::get($settings, 'year') == $year): ?>
                                selected="selected"
                            <? endif; ?>
                        ><?= $year; ?></option>
                    <? endforeach; ?>
                </select>
                <select class="form-control" name="month">
                    <option value="0">--</option>
                    <? foreach ($months as $month => $month_name): ?>
                        <option value="<?= $month; ?>"
                            <? if (Arr::get($settings, 'month') == $month): ?>
                                selected="selected"
                            <? endif; ?>
                        ><?= $month_name; ?></option>
                    <? endforeach; ?>
                </select>
                <select class="form-control" name="day">
                    <option value="0">--</option>
                    <? foreach ($days as $day): ?>
                        <option value="<?= $day; ?>"
                            <? if (Arr::get($settings, 'day') == $day): ?>
                                selected="selected"
                            <? endif; ?>
                        ><?= $day; ?></option>
                    <? endforeach; ?>
                </select>
            </div>
            <div class="col-md-12 text-danger">
                <?= Arr::get($errors, 'birthdate'); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="sex" class="col-md-4 control-label">Пол:</label>
            <div class="col-md-8">
                <select id="sex" class="form-control" name="sex">
                    <option value="0">--</option>
                    <? foreach ($sexes as $sex => $sex_name): ?>
                        <option value="<?= $sex; ?>"
                            <? if ($settings['sex'] == $sex): ?>
                                selected="selected"
                            <? endif; ?>
                        ><?= $sex_name; ?></option>
                    <? endforeach; ?>
                </select>
            </div>
            <div class="col-md-12 text-danger">
                <?= Arr::get($errors, 'sex'); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="city" class="col-md-4 control-label">Город:</label>
            <div class="col-md-8">
                <input id="city" class="form-control" type="text" value="<?= $settings['city']; ?>" name="city">
            </div>
            <div class="col-md-12 text-danger">
                <?= Arr::get($errors, 'city'); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="activity" class="col-md-4 control-label">Деятельность:</label>
            <div class="col-md-8">
                <input id="activity" class="form-control" type="text" value="<?= $settings['activity']; ?>" name="activity">
            </div>
            <div class="col-md-12 text-danger">
                <?= Arr::get($errors, 'activity'); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="about_me" class="col-md-4 control-label">О себе:</label>
            <div class="col-md-8">
                <textarea id="about_me" class="form-control" rows="3" name="about_me"><?= $settings['about_me']; ?></textarea>
            </div>
            <div class="col-md-12 text-danger">
                <?= Arr::get($errors, 'about_me'); ?>
            </div>
        </div>

        <div id="container-personal-buttons"  class="form-group">
            <a href="<?= URL::get_user_default_url('profile', 'index', $user_id); ?>" class="btn btn-default">Отменить</a>
            <input class="btn btn-default" type="submit" value="Сохранить" name="">
        </div>
    </form>
</div>