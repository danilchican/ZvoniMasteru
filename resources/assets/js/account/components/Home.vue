<template>
    <div class="panel panel-default">
        <div class="panel-body">

            <!-- Nav tabs -->
            <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#settings" data-toggle="tab">Общие настройки</a></li>
                <li><a href="#contacts" data-toggle="tab">Контактные данные</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="settings">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="panel panel-default main-settings">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Основные</h3>
                                </div>
                                <div class="panel-body">
                                    <form method="POST" id="main">
                                        <div class="form-group">
                                            <label for="username">Контактное лицо *</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Введите контактное лицо">
                                        </div>
                                        <div class="form-group">
                                            <label for="company-name">Название компании *</label>
                                            <input type="text" class="form-control" id="company-name" name="company-name" placeholder="Введите название компании">
                                        </div>
                                        <div class="form-group">
                                            <label for="unp-number">УНП *</label>
                                            <input type="text" class="form-control" id="unp-number" name="unp-number" placeholder="Введите номер УНП">
                                        </div>
                                        <div class="form-group">
                                            <label for="company-description">Описание компании *</label>
                                            <textarea class="form-control" rows="5" name="company-description"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary save-button">Сохранить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="panel panel-default socials-settings">
                            <div class="panel-heading">
                                <h3 class="panel-title">Социальные сети</h3>
                            </div>
                            <div class="panel-body">
                                <form method="POST" id="socials">
                                    <div class="form-group">
                                        <label for="company-vk-group">Группа Вконтакте</label>
                                        <input type="text" class="form-control" name="vk_url" id="vk-group" placeholder="http://vk.com/">
                                    </div>
                                    <div class="form-group">
                                        <label for="company-fb-group">Группа Facebook</label>
                                        <input type="text" class="form-control" name="fb_url" id="fb-group" placeholder="http://facebook.com/">
                                    </div>
                                    <div class="form-group">
                                        <label for="company-ok-group">Группа Одноклассники</label>
                                        <input type="text" class="form-control" name="ok-group" id="ok-group" placeholder="http://odnoklassniki.ru/">
                                    </div>
                                    <button type="submit" class="btn btn-primary save-button">Сохранить</button>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade in" id="contacts">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="panel panel-default contacts-settings">
                            <div class="panel-heading">
                                <h3 class="panel-title">Контактные данные</h3>
                            </div>
                            <div class="panel-body">
                                <form method="POST">
                                    <div class="form-group">
                                        <label for="company-address">Адрес</label>
                                        <input type="text" class="form-control" name="address" placeholder="Адрес вашей компании">
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Сайт: </label>
                                        <input type="text" class="form-control" name="website" placeholder="Название вашего сайта">
                                    </div>
                                    <div class="form-group">
                                        <label for="company-email">Email компании</label>
                                        <input type="text" class="form-control" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="company-skype">Skype</label>
                                        <input type="text" class="form-control" name="company-skype">
                                    </div>
                                    <div class="form-group">
                                        <label for="company-viber">Viber</label>
                                        <input type="text" class="form-control" name="company-viber">
                                    </div>
                                    <div class="form-group">
                                        <label for="company-icq">ICQ</label>
                                        <input type="text" class="form-control" name="company-icq">
                                    </div>
                                    <button type="submit" class="btn btn-primary save-button">Сохранить</button>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="panel panel-default contacts-phones">
                            <div class="panel-heading">
                                <h3 class="panel-title">Телефоны</h3>
                            </div>
                            <div class="panel-body">
                                <div id="phones">
                                    телефоны
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary add-phone-btn">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Добавить
                                    </button>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<style>
    #myTab {
        margin-bottom: 15px;
    }
</style>

<script>
    export default {
        mounted() {
            console.log('Home Component ready.')
        },
        data : function() {
            return {}
        },
    }

</script>