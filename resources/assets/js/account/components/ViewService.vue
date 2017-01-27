<template>
    <ul v-if="hasChildren(service)" class="col-md-6">
        <input type="checkbox"> {{ service.name }}
        <ul>
            <li v-for="item in getChildren(service)">
                <input type="checkbox"> {{ service.name }}
            </li>
        </ul>
    </ul>
    <li v-else>
        <input type="checkbox"> {{ service.name }}
    </li>
</template>


<script>
    export default {
        props: ['service'],

        methods : {

            getChildren(service) {
                return service.children;
            },

            hasChildren(service) {
                return service.children !== undefined;
            },
        }
    }
</script>