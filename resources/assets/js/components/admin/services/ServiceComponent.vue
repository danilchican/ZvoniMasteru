<template>
    <div class="row">
        <div class="col-xs-6">
            <div class="box no-margin">
                <div class="box-header">
                    <h3 class="box-title">{{ titlePage }}</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding no-margin">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <td v-if="list.length == 0">
                                <h5 style="padding-left: 15px;">Haven't any services.</h5>
                            </td>
                            <view-service v-else v-for="service in list" :service="service" @serviceRemoved="removeFromList()" ></view-service>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <div class="col-xs-12" style="margin-top: 15px;">
                <div class="row" style="text-align: center" v-if="canShowMore">
                    <button class="btn btn-default" @click="showMore()" style="display: inline-block">Show More</button>
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-6">
            <create-service @serviceCreated="updateList(count)"></create-service>
        </div>
    </div>
</template>

<script>
    import CreateService from './CreateServiceComponent.vue'
    import ViewService from './ViewServiceComponent.vue'

    export default {
        props: ['titlePage'],

        data() {
            return {
                list: [],
                canShowMore: false,
                count: 0,
                step: 5
            }
        },

        created: function () {
            this.getServicesList();
        },

        methods: {

            /**
             * Set count of retrieved data.
             *
             * @param count
             */
            setCount (count){
                this.count = count;
            },
            /**
             * Handle showing ShowMore button.
             *
             * @param count
             */
            handleShowMoreBtn (count) {
                this.canShowMore = (this.count < count) ? false : true;
            },

            /**
             * Process data for request.
             */
            processRequest(services, count) {
                this.list = services.data;
                this.setCount(this.list.length);
                this.handleShowMoreBtn(count);
            },

            /**
             * Get services from storage.
             */
            getServicesList(update) {
                var count = this.count + this.step;


                this.$http.get('/admin/services/get').then((services) => {
                    this.processRequest(services, count);
                });
            },

            /**
             * Show more orders by step = 5.
             */
            showMore () {
                var count = this.count + this.step;

                this.$http.get('/admin/services/get/' + count).then((services) => {
                    this.processRequest(services, count);
                });
            },

            /**
             * Get services from storage.
             */
            updateList(count) {
                this.$http.get('/admin/services/get/' + count).then((services) => {
                    this.processRequest(services, count);
                });
            },

            /**
             * Remove service from list.
             *
             * @param service
             */
            removeFromList() {
                var count = this.list.length;
                this.updateList(count);
            }
        },

        components: {
            'create-service': CreateService,
            'view-service': ViewService
        }
    }
</script>
