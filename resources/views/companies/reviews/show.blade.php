<li class="reviews-item col-md-12">
    <div class="review-item-head">
        <span class="review-author">{{ $review->getAuthorName() }}</span>
        <span class="review-date">{{ $review->created_at->diffForHumans() }}</span>
    </div>
    <div class="clear"></div>
    <div class="review-content col-md-12">
        <div class="row">
            <div class="advantages">
                <p class="review-adv-title">Плюсы:</p>
                <p>{{ $review->getAdvantages() }}</p>
            </div>
            <div class="disadvantages">
                <p class="review-adv-title">Минусы:</p>
                <p>{{ $review->getDisadvantages() }}</p>
            </div>
        </div>
    </div>
</li>