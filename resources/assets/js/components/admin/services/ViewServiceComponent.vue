<template>
    <tr>
        <td>{{ service.id }}.</td>
        <td>{{ service.title }}</td>
        <td>
            <div class="btn-group">
                <a href="">
                    <button type="button" class="btn btn-info btn-xs">Edit</button>
                </a>
                <input type="hidden" name="service_id" :value="service.id">
                <button type="submit" class="btn btn-danger btn-xs">Delete</button>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['service'],

        data() {
            return {

            }
        },

        methods: {
            createService() {
                console.log('clicked new');
            }
        }
    }
</script>