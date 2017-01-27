<template>
    <ul v-if="hasChildren(service)" class="col-md-6">
        <input type="checkbox" :value="service.id" @click="updateService($event, service)"> {{ service.name }}
        <ul>
            <li v-for="item in getChildren(service)">
                <input type="checkbox" :value="item.id" @click="updateService($event, item)"> {{ item.name }}
            </li>
        </ul>
    </ul>
    <li v-else>
        <input type="checkbox" :value="service.id" @click="updateService($event, service)"> {{ service.name }}
    </li>
</template>

<script>
    export default {
        props: ['service'],

        methods : {

            getChildren(service) {
                return service.children;
            },

            hasChildren(service) {
                return service.children !== undefined;
            },

            toggleServiceFromList(service, checked) {
                this.$http.post('/account/categories/toggle', {id: service.id, status: checked})
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

            updateService(event, service) {
                var checked = event.target.checked;
                console.log(checked);
                this.toggleServiceFromList(service, checked);
            }
        }
    }
</script>