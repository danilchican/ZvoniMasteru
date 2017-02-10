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
                                    <form method="POST" @submit.prevent="updateMainSettings()">
                                        <div class="form-group">
                                            <label for="username">Контактное лицо *</label>
                                            <input type="text" v-model="main.username" class="form-control" id="username" name="username" placeholder="Введите контактное лицо">
                                        </div>
                                        <div class="form-group">
                                            <label for="company-name">Название компании *</label>
                                            <input type="text" v-model="main.companyName" class="form-control" id="company-name" name="company-name" placeholder="Введите название компании">
                                        </div>
                                        <div class="form-group">
                                            <label for="unp-number">УНП *</label>
                                            <input type="text" v-model="main.unpNumber" class="form-control" id="unp-number" name="unp-number" placeholder="Введите номер УНП">
                                        </div>
                                        <div class="form-group">
                                            <label for="company-description">Описание компании *</label>
                                            <textarea class="form-control" v-model="main.companyDescription" rows="5" id="company-description"></textarea>
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
                                <form method="POST" @submit.prevent="updateSocialAccounts()">
                                    <div class="form-group">
                                        <label for="vk-group">Группа Вконтакте</label>
                                        <input type="text" class="form-control" v-model="socials.vkontakte" id="vk-group" placeholder="http://vk.com/">
                                    </div>
                                    <div class="form-group">
                                        <label for="fb-group">Группа Facebook</label>
                                        <input type="text" class="form-control" v-model="socials.facebook" id="fb-group" placeholder="http://facebook.com/">
                                    </div>
                                    <div class="form-group">
                                        <label for="ok-group">Группа Одноклассники</label>
                                        <input type="text" class="form-control" v-model="socials.odnoklassniki" id="ok-group" placeholder="http://odnoklassniki.ru/">
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
                                <form method="POST" @submit.prevent="updateContacts()">
                                    <div class="form-group">
                                        <label for="company-address">Адрес</label>
                                        <input type="text" v-model="contacts.address" id="company-address" class="form-control" placeholder="Адрес вашей компании">
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Сайт: </label>
                                        <input type="text" v-model="contacts.websiteUrl" class="form-control" id="website" placeholder="Название вашего сайта">
                                    </div>
                                    <div class="form-group">
                                        <label for="company-email">Email компании</label>
                                        <input type="text" v-model="contacts.email" class="form-control" id="company-email">
                                    </div>
                                    <div class="form-group">
                                        <label for="company-skype">Skype</label>
                                        <input type="text" v-model="contacts.skype" class="form-control" id="company-skype">
                                    </div>
                                    <div class="form-group">
                                        <label for="company-viber">Viber</label>
                                        <input type="text" v-model="contacts.viber" class="form-control" id="company-viber">
                                    </div>
                                    <div class="form-group">
                                        <label for="company-icq">ICQ</label>
                                        <input type="text" v-model="contacts.icq" class="form-control" id="company-icq">
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
            this.retrieveSettings();
        },

        data : function() {
            return {
                disable: false,
                main: {
                    username: '',
                    companyName: '',
                    unpNumber: 0,
                    companyDescription: '',
                },
                socials: {
                    vkontakte: '',
                    facebook: '',
                    odnoklassniki: '',
                },
                contacts: {
                    address: '',
                    websiteUrl: '',
                    email: '',
                    skype: '',
                    viber: '',
                    icq: '',
                },
            }
        },

        methods : {
            disableInputs() {
                $('input').attr('disabled', 'disabled');
                $('textarea').attr('disabled', 'disabled');
                $('button').addClass('disabled');
                this.disable = true;
            },

            undisableInputs() {
                $('input').attr('disabled', false);
                $('textarea').attr('disabled', false);
                $('button').removeClass('disabled');
                this.disable = false;
            },

            updateMainSettings() {
                if(this.disable)
                    return;

                this.disableInputs();

                var _main = {
                    username: this.main.username,
                    name: this.main.companyName,
                    unp_number: this.main.unpNumber,
                    description: this.main.companyDescription,
                };

                this.$http.post('/account/info/update', _main)
                    .then((data) => {
                        // success callback

                        if(data.body.success === true) {
                            var messages = data.body.messages;

                            $.each( messages, function( key, value ) {
                                toastr.success(value, 'Success')
                            });
                        } else {
                            toastr.error('Что-то пошло не так...', 'Error')
                        }

                        this.undisableInputs();
                    }, (data) => {
                        this.undisableInputs();
                        // error callback
                        var errors = data.body;
                        $.each( errors, function( key, value ) {
                            if(data.status === 422) {
                                toastr.error(value[0], 'Error')
                            } else {
                                toastr.error(value, 'Error')
                            }
                        });
                    });
            },

            updateSocialAccounts() {
                if(this.disable)
                    return;

                this.disableInputs();

                var _socials = {
                    vk_url: this.socials.vkontakte,
                    ok_url: this.socials.odnoklassniki,
                    fb_url: this.socials.facebook,
                };

                this.$http.post('/account/socials/update', _socials)
                    .then((data) => {
                        // success callback

                        if(data.body.success === true) {
                            var messages = data.body.messages;

                            $.each( messages, function( key, value ) {
                                toastr.success(value, 'Success')
                            });
                        } else {
                            toastr.error('Что-то пошло не так...', 'Error')
                        }

                        this.undisableInputs();
                    }, (data) => {
                        this.undisableInputs();
                        // error callback
                        var errors = data.body;
                        $.each( errors, function( key, value ) {
                            if(data.status === 422) {
                                toastr.error(value[0], 'Error')
                            } else {
                                toastr.error(value, 'Error')
                            }
                        });
                    });
            },

            updateContacts() {
                if(this.disable)
                    return;

                console.log("update contacts")
            },

            setMainSettings(username, company) {
                this.main.username = username;
                this.main.companyName = company.name;
                this.main.unpNumber = company.unp_number;
                this.main.companyDescription = company.description;
            },

            setContacts(contacts) {
                /**
                 * Social groups.
                 */
                this.socials.vkontakte = contacts.groups.vk;
                this.socials.odnoklassniki = contacts.groups.ok;
                this.socials.facebook = contacts.groups.fb;

                /**
                 * Company contacts.
                 */
                this.contacts.address = contacts.address;
                this.contacts.websiteUrl = contacts.website_url;
                this.contacts.email = contacts.email;
                this.contacts.skype = contacts.skype;
                this.contacts.viber = contacts.viber;
                this.contacts.icq = contacts.icq;
            },

            retrieveSettings() {
                this.disableInputs();

                this.$http.get('/account/info')
                    .then((data) => {
                        // success callback

                        if(data.body.success !== true) {
                            toastr.error('Что-то пошло не так...', 'Error')
                            return;
                        }

                        this.setMainSettings(data.body.username, data.body.company);
                        this.setContacts(data.body.contacts);

                        this.undisableInputs();
                    }, (data) => {
                        // error callback
                        var errors = data.body;
                        $.each( errors, function( key, value ) {
                            if(data.status === 422) {
                                toastr.error(value[0], 'Error')
                            } else {
                                toastr.error(value, 'Error')
                            }
                        });
                    });
            }
        }
    }

</script>