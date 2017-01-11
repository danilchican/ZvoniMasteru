<template>
    <tr>
        <td>{{ service.id }}.</td>
        <td>{{ service.title }}</td>
        <td>
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-xs">Edit</button>
                <button type="button" @click="removeService(service)" class="btn btn-danger btn-xs">Delete</button>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['service'],

        data() {
            return {

            }
        },

        methods: {

            /**
             * Remove service from DB.
             *
             * @param service
             */
            removeService(service) {
                this.$http.delete('/admin/services/' + service.id).then((data) => {
                    // success callback
                    if(data.body.success === true) {
                        var messages = data.body.messages;

                        $.each( messages, function( key, value ) {
                            toastr.success(value, 'Success')
                        });
                    } else {
                        toastr.error('Что-то пошло не так...', 'Error')
                    }

                    this.$emit('serviceRemoved', service);
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