<template>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="input-group form-group phone-item">
                <input type="hidden" name="phone-id" v-model="id" :value="phone.id">
                <input type="text" class="form-control" v-model="number" placeholder="+375(29)1234567" name="number" :value="phone.number">
                <div class="input-group-btn">
                    <button type="button" @click="updatePhone()" class="btn btn-default update-phone-item"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                    <button type="button" @click="deletePhone()" class="btn btn-default del-phone-item"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div><!-- /btn-group -->
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
</template>

<script>
    export default {
        props: ['phone'],

        data: function() {
            return {
                id: this.phone.id,
                number: this.phone.number,
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

            updatePhone() {
                if(this.disable)
                    return;

                this.disableInputs();

                this.$http.post('/account/phones/update', {id: this.id, number: this.number})
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
                        this.$emit('phoneUpdated');
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

            deletePhone() {
                if(this.disable)
                    return;

                this.disableInputs();

                this.$http.delete('/account/phones/' + this.id)
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
                        this.$emit('phoneRemoved');
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
            }
        }
    }
</script>