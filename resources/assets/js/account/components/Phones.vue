<template>
    <div class="row">
        <div class="panel panel-default contacts-phones">
            <div class="panel-heading">
                <h3 class="panel-title">Телефоны</h3>
            </div>
            <div class="panel-body">
                <p v-if="phones.length == 0">Телефонов пока нет.</p>
                <view-phone v-else v-for="phone in phones" :phone="phone" @phoneRemoved="removeFromList()"></view-phone>

                <div class="form-group" v-if="phones.length < 3">
                    <button type="submit" class="btn btn-primary add-phone-btn" data-toggle="modal" data-target="#addPhoneModal">
                        <i class="fa fa-plus" aria-hidden="true"></i> Добавить
                    </button>
                </div>
            </div>
        </div>

        <!-- Add Phone Modal -->
        <div class="modal fade" v-if="phones.length < 3" id="addPhoneModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="addPhoneModalLabel">Добавление телефона</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" @submit.prevent="addPhone()">
                            <div class="form-group">
                                <label for="phone-number">Номер телефона:</label>
                                <input type="text" id="phone-number" class="form-control" v-model="newPhoneNumber" :value="newPhoneNumber" placeholder="+375(29)1234567">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="button" @click="addPhone()" class="btn btn-primary">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import ViewPhone from './ViewPhone.vue'

    export default {
        mounted() {
            this.updatePhonesList();
        },

        data : function() {
            return {
                disable: false,
                newPhoneNumber: '',
                phones: []
            }
        },

        components: {
            'view-phone': ViewPhone
        },

        methods : {

            disableInputs() {
                $('#addPhoneModal input').attr('disabled', 'disabled');
                $('#addPhoneModal button').addClass('disabled');
                this.disable = true;
            },

            undisableInputs() {
                $('#addPhoneModal input').attr('disabled', false);
                $('#addPhoneModal button').removeClass('disabled');
                this.disable = false;
            },

            addPhone() {
                if(this.disable)
                    return;

                this.disableInputs();

                this.$http.post('/account/phones/store', {number: this.newPhoneNumber})
                    .then((response) => {
                        if(response.body.success === true) {
                            var messages = response.body.messages;

                            $.each( messages, function( key, value ) {
                                toastr.success(value, 'Success')
                            });

                            var phone = response.body.phone;

                            //..
                        } else {
                            toastr.error('Что-то пошло не так...', 'Error')
                        }

                        this.updatePhonesList();
                        this.undisableInputs();

                        $('#addPhoneModal').modal('hide');
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

            /**
             * Get all company phones from server.
             */
            updatePhonesList() {
                this.$http.get('/account/phones/list')
                    .then((data) => {
                        // success callback
                        this.phones = data.body.phones;

                        if(data.body.success !== true) {
                            toastr.error('Что-то пошло не так...', 'Error')
                        }
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
            },

            /**
             * Remove phone from list.
             *
             */
            removeFromList() {
                this.updatePhonesList();
            }
        }
    }

</script>