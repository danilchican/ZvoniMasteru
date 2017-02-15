@if(count($reviews) > 0)
    @include('companies.reviews.create')
    <div class="col-md-12">
        <h3>Отзывы о компании:</h3>
        @foreach($reviews as $review)
            @include('companies.reviews.show', ['review' => $review])
        @endforeach
    </div>
@else
    <div class="alert alert-info">Отзывов пока еще нет.
        <strong><a href="#create-review-form">Станьте первым!</a></strong>
    </div>

    @include('companies.reviews.create')
@endif