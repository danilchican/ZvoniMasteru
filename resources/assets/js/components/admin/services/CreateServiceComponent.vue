<template>
    <div class="box box-default create-category">
        <div class="box-header with-border">
            <i class="fa fa-edit"></i>
            <h3 class="box-title">Add Service</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="POST" @submit.prevent="createService()">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Введите название услуги">
                </div>
                <button type="submit" class="btn btn-success save-button">Сохранить</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },

        methods: {
            createService() {
                console.log('clicked new');
            }
        }
    }
</script>