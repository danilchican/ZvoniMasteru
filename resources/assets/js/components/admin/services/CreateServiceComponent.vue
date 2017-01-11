<template>
    <div class="box box-default create-category">
        <div class="box-header with-border">
            <i class="fa fa-edit"></i>
            <h3 class="box-title">Add Service</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="POST" @submit.prevent="createService()">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" :value="title" v-model="title" placeholder="Введите название услуги">
                </div>
                <button type="submit" class="btn btn-success save-button">Сохранить</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                title: ''
            }
        },

        methods: {
            createService() {
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

                        //console.log(savedService);

                        this.$emit('serviceCreated', savedService);
                        this.title = '';
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