<template>
    <div class="row">
        <div class="col-xs-6">
            <div class="box no-margin">
                <div class="box-header">
                    <h3 class="box-title">{{ titlePage }}</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding no-margin">
                    <table class="table table-bordered table-striped table-hover">
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
                        <tr v-else v-for="service in list">
                            <view-service :service="service"></view-service>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-xs-6">
            <create-service></create-service>
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
                list: []
            }
        },

        components: {
            'create-service': CreateService,
            'view-service': ViewService
        }
    }
</script>
