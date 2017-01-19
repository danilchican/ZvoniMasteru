<template>

</template>

<script>
    var loading_box = '<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>';

    export default {
        data() {
            return {
                list: [],
                canShowMore: false,
                count: 0,
                step: 5,
                disable: false,
                countPerPage: 5
            }
        },

        created: function () {
            this.getTariffsList();
        },

        methods: {

            /**
             * Set disable for boxes.
             */
            setDisable() {
                this.disable = true;
                $('#box-table-tariffs').append(loading_box);
            },

            /**
             * Unset disable from box.
             */
            unsetDisable() {
                this.disable = false;
                $('#box-table-tariffs').find('.overlay').remove();
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
             * Get the count of tariffs.
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
            processRequest(tariffs, count) {
                this.list = tariffs.data;
                this.setCount(this.list.length);
                this.handleShowMoreBtn(count);

                this.unsetDisable();
            },

            /**
             * Get tariffs from storage.
             */
            getTariffsList() {
                if(this.isDisabled())
                    return;

                var count = this.getCount() + this.step;

                this.setDisable();

                this.$http.get('/dashboard/tariffs/get').then((tariffs) => {
                    this.processRequest(tariffs, count);
                });
            },
        },

        components: {
            //..
        }
    }
</script>