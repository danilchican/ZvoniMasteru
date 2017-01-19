<template>
    <tr>
        <td>{{ speciality.id }}.</td>
        <td>{{ speciality.title }}</td>
        <td>{{ speciality.slug }}</td>
        <td>
            <div class="btn-group">
                <button type="button" @click="editSpeciality(speciality)" class="btn btn-info btn-xs" data-toggle="modal" data-target="#editSpecialityModal">Edit</button>
                <button type="button" @click="removeSpeciality(speciality)" class="btn btn-danger btn-xs">Delete</button>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['speciality'],

        methods: {
            editSpeciality(speciality) {
                this.$emit('specialityEdited', speciality);
            },

            /**
             * Remove speciality from DB.
             *
             * @param speciality
             */
            removeSpeciality(speciality) {
                this.$http.delete('/dashboard/specialities/' + speciality.id).then((data) => {
                    // success callback
                    if(data.body.success === true) {
                        var messages = data.body.messages;

                        $.each( messages, function( key, value ) {
                            toastr.success(value, 'Success')
                        });
                    } else {
                        toastr.error('Что-то пошло не так...', 'Error')
                    }

                    this.$emit('specialityRemoved');
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