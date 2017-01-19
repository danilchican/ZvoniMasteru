<template>
    <div class="box box-default" id="create-speciality">
        <div class="box-header with-border">
            <i class="fa fa-edit"></i>
            <h3 class="box-title">Add Speciality</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="POST" @submit.prevent="createSpeciality()">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" class="form-control" :value="title" v-model="title" placeholder="Введите название услуги" :disabled="disable == 1 ? true : false">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" id="slug" class="form-control" :value="slug" v-model="slug" :disabled="disable == 1 ? true : false">
                </div>
                <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea name="desc" class="form-control" id="desc" rows="5" :value="desc" v-model="desc" :disabled="disable == 1 ? true : false"></textarea>
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
                slug: '',
                desc: '',
                disable: false,
            }
        },

        methods: {
            setDisable() {
                this.disable = true;
                $('#create-speciality').append(loading_box);
            },

            unsetDisable() {
                this.disable = false;
                $('#create-speciality').find('.overlay').remove();
            },

            /**
             * Check if the request sended.
             */
            isDisabled() {
                return this.disable;
            },

            /**
             * Create new speciality.
             */
            createSpeciality() {
                if(this.isDisabled())
                    return;

                this.setDisable();

                var dataSend = {
                    title: this.title,
                    slug: this.slug,
                    desc: this.desc
                }

                this.$http.post('/dashboard/specialities', dataSend)
                    .then((data) => {
                        // success callback
                        var savedSpeciality = data.body.speciality;

                        if(data.body.success === true) {
                            var messages = data.body.messages;

                            $.each( messages, function( key, value ) {
                                toastr.success(value, 'Success')
                            });
                        } else {
                            toastr.error('Что-то пошло не так...', 'Error')
                        }

                        this.$emit('specialityCreated', savedSpeciality);
                        this.title = '';
                        this.slug = '';
                        this.desc = '';

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