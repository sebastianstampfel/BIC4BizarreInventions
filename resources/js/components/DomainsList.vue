<template>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="domain in domains" :key="domain.id">
                    <td>{{ domain.id }}</td>
                    <td><a :href="'domain/' + domain.slug">{{ domain.name }}</a></td>
                    <td>{{ domain.description }}</td>
                    <td>{{ domain.created_at }}</td>
                    <td>{{ domain.updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    components: {
    },
    name: "DomainsList",
    data() {
        return {

        }
    },
    props: {
        domains: Array
    }
}
</script>

<style scoped>

</style>
