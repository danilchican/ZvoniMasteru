<div class="row company-reviews">
    <div class="col-md-12">
        <div class="row">
            <div class="thumbnail">
                <h4 class="reviews-title">
                    <img src="/assets/images/company/rate.jpg" alt=""/>
                    Отзывы
                    <img src="/assets/images/company/rate.jpg" alt=""/>
                </h4>
                <div class="clear"></div>
                @if(count($reviews) > 0)
                    <ul class="reviews-list">
                        @foreach($reviews as $review)
                            @include('companies.reviews.show', ['review' => $review])
                        @endforeach
                    </ul>
                    <div class="clear"></div>
                    <div class="add-review">
                        <button>Написать отзыв</button>
                    </div>
                @else
                    <div class="alert alert-info">Отзывов пока еще нет.
                        <strong><a href="#create-review-form">Станьте первым!</a></strong>
                    </div>
                @endif
                @include('companies.reviews.create')
            </div>
        </div>
    </div>
</div>