<template>
    <div class="row">
        <div class="col-xs-7">
            <div class="box no-margin" id="box-table-services">
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
                            <view-service v-else v-for="service in list" :service="service" @serviceRemoved="removeFromList()" @serviceEdited="getServiceInfo($event)"></view-service>
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
        <div class="col-xs-5">
            <create-service @serviceCreated="updateList(getCount())"></create-service>
        </div>
        <!-- Edit Service Modal -->
        <div class="modal fade" id="editServiceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="editServiceModalLabel">Редактировать "{{ editService.title }}"</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title-edit">Title</label>
                            <input type="text" id="title-edit" @keyup.enter="updateService()" v-model="editService.title" :value="editService.title" placeholder="Введите название услуги" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateService()" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var loading_box = '<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>';

    import CreateService from './CreateServiceComponent.vue'
    import ViewService from './ViewServiceComponent.vue'

    export default {
        props: ['titlePage'],

        data() {
            return {
                list: [],
                canShowMore: false,
                count: 0,
                step: 5,
                disable: false,
                countPerPage: 5,
                editService: {
                    id: 0,
                    title: ''
                }
            }
        },

        created: function () {
            this.getServicesList();
        },

        methods: {

            /**
             * Set disable for boxes.
             */
            setDisable() {
                this.disable = true;
                $('#box-table-services').append(loading_box);
            },

            /**
             * Unset disable from box.
             */
            unsetDisable() {
                this.disable = false;
                $('#box-table-services').find('.overlay').remove();
            },

            /**
             * Check if the request sended.
             */
            isDisabled() {
                return this.disable;
            },

            /**
             * Set count of retrieved data.
             *
             * @param count
             */
            setCount (count){
                this.count = count;
            },

            /**
             * Get the count of services.
             */
            getCount() {
                return this.count;
            },

            /**
             * Handle showing ShowMore button.
             *
             * @param count
             */
            handleShowMoreBtn (count) {
                this.canShowMore = (this.getCount() < count) ? false : true;
            },

            /**
             * Process data for request.
             */
            processRequest(services, count) {
                this.list = services.data;
                this.setCount(this.list.length);
                this.handleShowMoreBtn(count);

                this.unsetDisable();
            },

            /**
             * Set editing service for modal.
             *
             * @param service
             */
            setEditingService(service) {
                this.editService.id = service.id;
                this.editService.title = service.title;
            },

            /**
             * Unset editing service for modal.
             */
            unsetEditingService() {
                this.editService.id = 0;
                this.editService.title = '';
            },

            /**
             * Get service info form modal.
             *
             * @param service
             */
            getServiceInfo(service) {
              this.setEditingService(service);
            },

            /**
             * Update service model.
             */
            updateService() {
                this.$http.put('/admin/services/' + this.editService.id, this.editService).then((data) => {
                    this.updateList(this.getCount());

                    if(data.body.success === true) {
                        var messages = data.body.messages;

                        $('#editServiceModal').modal('hide');
                        $.each( messages, function( key, value ) {
                            toastr.success(value, 'Success')
                        });
                    } else {
                        toastr.error('Что-то пошло не так...', 'Error')
                    }

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
            },

            /**
             * Get services from storage.
             */
            getServicesList() {
                if(this.isDisabled())
                    return;

                var count = this.getCount() + this.step;

                this.setDisable();

                this.$http.get('/admin/services/get').then((services) => {
                    this.processRequest(services, count);
                });
            },

            /**
             * Show more orders by step = 5.
             */
            showMore () {
                if(this.isDisabled())
                    return;

                var count = this.getCount() + this.step;

                this.setDisable();

                this.$http.get('/admin/services/get/' + count).then((services) => {
                    this.processRequest(services, count);
                });
            },

            /**
             * Count services per page.
             */
            getCountPerPage() {
              return this.countPerPage;
            },

            /**
             * Get services from storage.
             */
            updateList(count) {
                if(this.isDisabled())
                    return;

                console.log(count);

                this.setDisable();

                count = (count < this.getCountPerPage()) ? this.getCountPerPage() : count;

                this.$http.get('/admin/services/get/' + count).then((services) => {
                    this.processRequest(services, count);
                });
            },

            /**
             * Remove service from list.
             */
            removeFromList() {
                this.setCount(this.list.length);
                this.updateList(this.getCount());
            }
        },

        components: {
            'create-service': CreateService,
            'view-service': ViewService
        }
    }
</script>
