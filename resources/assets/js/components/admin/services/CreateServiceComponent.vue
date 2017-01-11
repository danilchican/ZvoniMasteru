<template>
    <div class="box box-default" id="create-service">
        <div class="box-header with-border">
            <i class="fa fa-edit"></i>
            <h3 class="box-title">Add Service</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="POST" @submit.prevent="createService()">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" :value="title" v-model="title" placeholder="Введите название услуги" :disabled="disable == 1 ? true : false">
                </div>
                <button type="submit" class="btn btn-success save-button">Сохранить</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
</template>

<script>

    var loading_box = '<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>';

    export default {
        data() {
            return {
                title: '',
                disable: false,
            }
        },

        methods: {

            setDisable() {
                this.disable = true;
                $('#create-service').append(loading_box);
            },

            unsetDisable() {
                this.disable = false;
                $('#create-service').find('.overlay').remove();
            },

            /**
             * Check if the request sended.
             */
            isDisabled() {
                return this.disable;
            },

            /**
             * Create new service.
             */
            createService() {
                if(this.isDisabled())
                    return;

                this.setDisable();

                this.$http.post('/admin/services', {title: this.title})
                    .then((data) => {
                        // success callback
                        var savedService = data.body.service;

                        if(data.body.success === true) {
                            var messages = data.body.messages;

                            $.each( messages, function( key, value ) {
                                toastr.success(value, 'Success')
                            });
                        } else {
                            toastr.error('Что-то пошло не так...', 'Error')
                        }

                        this.$emit('serviceCreated', savedService);
                        this.title = '';

                        this.unsetDisable();
                    }, (data) => {
                        this.unsetDisable();
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