<template>
    <ul v-if="hasChildren(service)" :id="getMenuId(service)" style="list-style:none;" class="col-md-6 parent-bl level-1">
        <li>
            <input type="checkbox" :value="service.id" class="parent" @click="updateServices($event, 'parent')"> {{ service.name }}

            <ul class="parent-bl last-level">
                <li v-for="item in getChildren(service)">
                    <input type="checkbox" :value="item.id" @click="updateServices($event, 'child')"> {{ item.name }}
                </li>
            </ul>
        </li>
    </ul>
    <div v-else>
        <input type="checkbox" :value="service.id" class="parent" @click="updateServices($event, 'parent')">
        {{ service.name }}
    </div>
</template>

<script>
    export default {
        props: ['service'],

        methods : {

            getMenuId(service) {
                return 'service-menu-' + service.id
            },

            getChildren(service) {
                return service.children;
            },

            hasChildren(service) {
                return service.children !== undefined;
            },

            attachServices() {
                var values = [];

                $.each($('#category-list input:checked'), function(){
                    values.push(Number(this.value));
                });

                this.$http.post('/account/categories/attach', {ids: values})
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

            updateServices(event, type) {
                var checked = event.target.checked;
                var parents = $(event.target).parents('ul.parent-bl');

                parents.each(function(index) {
                    var block = $(this);
                    console.log(block);

                    if(type == 'child') {
                        var checkboxes = block.find('input:checked:not(.parent)');

                        var cb = block.find('input[class=parent]:first');

                        if(checkboxes.length > 0) {
                            cb.prop('checked', 'checked');
                        } else {
                            cb.prop('checked', false);
                        }
                    } else if(type == 'parent') {
                        if(index == 0) {
                            var checkboxes = block.find('input');

                            if(checkboxes.length > 0) {
                                if(checked) {
                                    checkboxes.prop('checked', 'checked');
                                } else {
                                    checkboxes.prop('checked', false);
                                }
                            }
                        } else if(index == 1) {
                            var checkboxes = block.find('li > .spoiler-content input[class=parent]:checked:first');

                            var cb = block.find('input[class=parent]:first');

                            console.log(checkboxes);

                            if(checkboxes.length > 0) {
                                cb.prop('checked', 'checked');
                            } else {
                                console.log('Not founded');
                                cb.prop('checked', false);
                            }
                        }
                    }
                });

                this.attachServices();
            }
        }
    }
</script>