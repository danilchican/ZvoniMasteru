<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12 alert alert-danger">
                <div class="col-md-12">
                    <div class="row">
                        <strong>Укажите</strong> все услуги, которые вы оказываете. Это необходимо, что бы клиенты смогли вас найти. Профиль без услуг не будет участвовать в поиске!
                    </div>
                </div>
            </div>
            <div class="col-md-12" v-if="services.length > 0">
                <div class="row">
                    <ul style="padding: 0;list-style: none;">
                        <li v-for="item in services" class="category">
                            <i v-if="hasChildren(item)" class="fa fa-plus left-ico spoiler" @click="changeSpoiler($event)" v-bind:data-spoiler-link="item.id" aria-hidden="true"></i>
                            {{ item.name }}

                            <div v-if="hasChildren(item)" class="spoiler-content" v-bind:data-spoiler-link="item.id">
                                <view-service v-for="child in getChildren(item)" :service="child"></view-service>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <p v-else>Услуг пока нет.</p>
        </div>
    </div>
</template>

<style>
    .spoiler-content {
        display: none;
    }
    .spoiler-content-visible {
        display: block;
        overflow: hidden;
    }
    .category {
        padding: 5px 12px;
        margin: 3px 0;
        border-radius: 2px;
        border: 1px solid #d2d6de;
    }
    .category i {
        cursor: pointer;
    }
</style>

<script>

    import ViewService from './ViewService.vue'

    export default {
        mounted() {
            console.log('Services Component ready.');
            this.getServices();
        },

        data : function() {
            return {
                services: [],
                attached: []
            }
        },

        components: {
            'view-service': ViewService
        },

        methods : {

            getChildren(service) {
                return service.children;
            },

            hasChildren(service) {
                return (service.children.length > 0);
            },

            changeSpoiler(event) {
                var spoilerId = event.target.getAttribute('data-spoiler-link');
                var block = $( "div[data-spoiler-link=" + spoilerId + "]" );

                if($(event.target).hasClass('spoiler-active')) {
                    $(event.target).removeClass('spoiler-active');
                    $(event.target).removeClass('fa-minus');
                    $(event.target).addClass('fa-plus');
                    block.removeClass('spoiler-content-visible');
                } else {
                    $(event.target).addClass('spoiler-active');
                    $(event.target).addClass('fa-minus');
                    $(event.target).removeClass('fa-plus');
                    block.addClass('spoiler-content-visible');
                }
            },

            setAttachedServices() {
                this.attached.forEach(function(id, index) {
                    var checkbox = $( "input[type=checkbox][value=" + id + "]" );
                    checkbox.prop('checked', 'checked');
                });
            },

            getAttachedServices() {
                this.$http.get('/account/categories/attached')
                    .then((data) => {
                        // success callback
                        this.attached = data.body.services;
                        this.setAttachedServices();

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
             * Get all services from server.
             */
            getServices() {
                this.$http.get('/account/categories/list')
                    .then((data) => {
                        // success callback
                        this.services = data.body.services;
                        this.getAttachedServices();

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
            }
        }
    }

</script>