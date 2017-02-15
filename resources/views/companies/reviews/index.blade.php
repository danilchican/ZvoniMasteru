@include('companies.reviews.create')

@if(count($reviews) > 0)
    <h3>Отзывы о компании:</h3>
    @foreach($reviews as $review)
        @include('companies.reviews.show', ['review' => $review])
    @endforeach
@else
    <div class="alert alert-info">Отзывов пока еще нет.
        <strong><a href="#create-review-form">Станьте первым!</a></strong>
    </div>
@endif