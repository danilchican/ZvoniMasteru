<template>
    <div class="row">
        <div class="col-xs-7">
            <div class="box no-margin" id="box-table-specialities">
                <div class="box-header">
                    <h3 class="box-title">{{ titlePage }}</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" :value="keywords" v-model="keywords" @keyup.enter="search()" name="table_search" class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" @click="search()" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding no-margin">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <td v-if="list.length == 0">
                            <h5 style="padding-left: 15px;">Haven't any specialities.</h5>
                        </td>
                        <view-speciality v-else v-for="speciality in list" :speciality="speciality" @specialityRemoved="removeFromList()" @specialityEdited="getSpecialityInfo($event)"></view-speciality>
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
            <create-speciality @specialityCreated="updateList(getCount())"></create-speciality>
        </div>
        <!-- Edit Speciality Modal -->
        <div class="modal fade" id="editSpecialityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="editSpecialityModalLabel">Редактировать "{{ editSpeciality.title }}"</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title-edit">Title</label>
                            <input type="text" id="title-edit" class="form-control" v-model="editSpeciality.title" :value="editSpeciality.title" placeholder="Введите название специальности">
                        </div>
                        <div class="form-group">
                            <label for="slug-edit">Slug</label>
                            <input type="text" id="slug-edit" class="form-control" :value="editSpeciality.slug" v-model="editSpeciality.slug">
                        </div>
                        <div class="form-group">
                            <label for="desc-edit">Description</label>
                            <textarea name="desc" id="desc-edit" class="form-control" rows="5" :value="editSpeciality.desc" v-model="editSpeciality.desc"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateSpeciality()" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var loading_box = '<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>';

    import ViewSpeciality from './ViewSpecialityComponent.vue'
    import CreateSpeciality from './CreateSpecialityComponent.vue'

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
                keywords: '',
                editSpeciality: {
                    id: 0,
                    title: '',
                    slug: '',
                    desc: ''
                }
            }
        },

        created: function () {
            this.getSpecialitiesList();
        },

        methods: {

            /**
             * Search speciality by keywords.
             */
            search() {
                if(this.isDisabled())
                    return;

                this.setDisable();

                this.$http.post('/dashboard/specialities/search', {keywords: this.keywords}).then((response) => {
                    if(response.body.success === true) {
                        this.list = response.data.specialities;
                        var messages = response.body.messages;

                        $.each( messages, function( key, value ) {
                            toastr.success(value, 'Success')
                        });
                    } else {
                        toastr.error('Что-то пошло не так...', 'Error')
                    }
                    this.unsetDisable();
                }, (data) => {
                    this.unsetDisable();
                    // error callback
                    var errors = data.body.messages;
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
             * Set disable for boxes.
             */
            setDisable() {
                this.disable = true;
                $('#box-table-specialities').append(loading_box);
            },

            /**
             * Unset disable from box.
             */
            unsetDisable() {
                this.disable = false;
                $('#box-table-specialities').find('.overlay').remove();
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
             * Get the count of specialities.
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
            processRequest(specialities, count) {
                this.list = specialities.data;
                this.setCount(this.list.length);
                this.handleShowMoreBtn(count);

                this.unsetDisable();
            },

            /**
             * Set editing speciality for modal.
             *
             * @param speciality
             */
            setEditingSpeciality(speciality) {
                this.editSpeciality.id = speciality.id;
                this.editSpeciality.title = speciality.title;
                this.editSpeciality.slug = speciality.slug;
                this.editSpeciality.desc = speciality.desc;
            },

            /**
             * Unset editing speciality for modal.
             */
            unsetEditingSpeciality() {
                this.editSpeciality.id = 0;
                this.editSpeciality.title = '';
                this.editSpeciality.slug = '';
                this.editSpeciality.desc = '';
            },

            /**
             * Get speciality info form modal.
             *
             * @param speciality
             */
            getSpecialityInfo(speciality) {
                this.setEditingSpeciality(speciality);
            },

            /**
             * Update speciality model.
             */
            updateSpeciality() {
                this.$http.put('/dashboard/specialities/' + this.editSpeciality.id, this.editSpeciality).then((data) => {
                    this.updateList(this.getCount());

                    if(data.body.success === true) {
                        var messages = data.body.messages;

                        $('#editSpecialityModal').modal('hide');
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
             * Get specialities from storage.
             */
            getSpecialitiesList() {
                if(this.isDisabled())
                    return;

                var count = this.getCount() + this.step;

                this.setDisable();

                this.$http.get('/dashboard/specialities/get').then((specialities) => {
                    this.processRequest(specialities, count);
                });
            },

            /**
             * Show more specialities by step = 5.
             */
            showMore () {
                if(this.isDisabled())
                    return;

                var count = this.getCount() + this.step;

                this.setDisable();

                this.$http.get('/dashboard/specialities/get/' + count).then((specialities) => {
                    this.processRequest(specialities, count);
                });
            },

            /**
             * Count services per page.
             */
            getCountPerPage() {
                return this.countPerPage;
            },

            /**
             * Get specialities from storage.
             */
            updateList(count) {
                if(this.isDisabled())
                    return;

                this.setDisable();

                count = (count < this.getCountPerPage()) ? this.getCountPerPage() : count;

                this.$http.get('/dashboard/specialities/get/' + count).then((specialities) => {
                    this.processRequest(specialities, count);
                });
            },

            /**
             * Remove speciality from list.
             *
             * @param service
             */
            removeFromList() {
                this.setCount(this.list.length);
                this.updateList(this.getCount());
            }
        },

        components: {
            'create-speciality': CreateSpeciality,
            'view-speciality': ViewSpeciality
        }
    }
</script>
