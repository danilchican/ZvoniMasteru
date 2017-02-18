<template>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="form-group review-item media" style="margin: 10px 0;">
                <a class="pull-left" href="#">
                    <img class="media-object" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjZWVlIi8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzIiIHk9IjMyIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9zdmc+" alt="...">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">
                        Автор: <a :href="email(review)">{{ review.author }}</a>
                    </h4>
                    <strong>Достоинства:</strong> {{ review.advantages }}
                    <br/>
                    <strong>Недостатки:</strong> {{ review.disadvantages }}
                </div>
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
</template>

<script>
    export default {
        props: ['review'],

        data: function() {
            return {}
        },

        methods : {
            email(review) {
                return 'mailto:' + review.email;
            }
        }
    }
</script>