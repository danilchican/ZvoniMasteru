<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12" v-if="reviews.length > 0">
                <div class="row">
                    <ul style="padding: 0;list-style: none;">
                        <li v-for="review in reviews" class="review-item">
                            <view-review :review="review"></view-review>
                        </li>
                    </ul>
                </div>
            </div>
            <p v-else>Отзывов пока нет.</p>
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

    import ViewReview from './ViewReview.vue'

    export default {
        mounted() {
            this.getReviews();
        },

        data : function() {
            return {
                reviews: []
            }
        },

        components: {
            'view-review': ViewReview
        },

        methods : {

            /**
             * Get all reviews from server.
             */
            getReviews() {
                this.$http.get('/account/reviews/get')
                    .then((data) => {
                        // success callback
                        this.reviews = data.body.reviews;

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