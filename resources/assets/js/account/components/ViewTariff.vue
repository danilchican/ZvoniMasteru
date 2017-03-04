<template>
    <li>
        <div class="col-sm-6 col-md-6">
            <div class="thumbnail" style="min-height: 475px;">
                <div class="caption">
                    <h3><strong>{{ tariff.title }}</strong></h3>
                    <p><strong>ТОП:</strong> {{ tariff.top }}</p>
                    <p><strong>Для кого:</strong> {{ tariff.whom }}</p>
                    <p><strong>Доп. услуга:</strong> {{ tariff.additional_service }}</p>
                    <p style="margin:0"><strong>Услуги:</strong></p>
                    <ul v-for="service in tariff.services">
                        <li>{{ service.title }}</li>
                    </ul>
                    <p style="margin:0"><strong>Цены:</strong></p>
                    <ul v-for="price in tariff.prices">
                        <li>{{ price.range }}: <strong>{{ price.price }}</strong></li>
                    </ul>
                    <br>
                    <p><a href="#" class="btn btn-primary" role="button">Заказать</a></p>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        props: ['tariff']
    }
</script>