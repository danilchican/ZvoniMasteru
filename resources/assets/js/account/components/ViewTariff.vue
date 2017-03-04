<template>
    <li class="col-sm-6 col-md-6">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">{{ tariff.title }}</div>
            <div class="panel-body">
                <p><strong>ТОП:</strong> {{ tariff.top }}</p>
                <p><strong>Для кого:</strong> {{ tariff.whom }}</p>
                <p><strong>Доп. услуга:</strong> {{ tariff.additional_service }}</p>
            </div>

            <!-- List group -->
            <ul v-for="service in tariff.services" class="list-group">
                <li class="list-group-item">{{ service.title }}</li>
            </ul>
            <br>
            <!-- Prices -->
            <table class="table">
                <thead>
                <tr>
                    <th>Период</th>
                    <th>Цена</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="price in tariff.prices">
                    <td>{{ price.range }}</td>
                    <td>{{ price.price }}</td>
                </tr>
                </tbody>
            </table>

            <div class="panel-body">
                <p><a href="#" class="btn btn-primary" role="button">Заказать</a></p>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        props: ['tariff']
    }
</script>