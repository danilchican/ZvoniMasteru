<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12 alert alert-danger">
                <div class="col-md-12">
                    <div class="row">
                        Чтобы добиться лучшего результата, мы рекомендуем выбрать один из тарифов для <strong>продвижения</strong> в каталоге.
                    </div>
                </div>
            </div>
            <div class="col-md-12" v-if="tariffs.length > 0">
                <div class="row">
                     <ul id="tariffs-list">
                         <view-tariff v-for="item in tariffs" :tariff="item"></view-tariff>
                     </ul>
                </div>
            </div>
            <p v-else>Тарифов пока нет.</p>
        </div>
    </div>
</template>

<style>
    #tariffs-list {
        padding-left: 0;
        list-style: none;
    }
</style>

<script>

    import ViewTariff from './ViewTariff.vue'

    export default {
        mounted() {
            this.getTariffs();
        },

        data : function() {
            return {
                tariffs: []
            }
        },

        components: {
            'view-tariff': ViewTariff
        },

        methods : {

            /**
             * Get all services from server.
             */
            getTariffs() {
                this.$http.get('/account/tariffs/get')
                    .then((data) => {
                        // success callback
                        this.tariffs = data.body.tariffs;

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

        }
    }

</script>