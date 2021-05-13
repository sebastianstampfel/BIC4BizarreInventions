<template>
    <div class="container">
        <h1>Cool inventions list</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Domain</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="invention in inventions" :key="invention.id">
                    <td>{{ invention.id }}</td>
                    <td><a :href="'invention/' + invention.slug">{{ invention.name }}</a></td>
                    <td>{{ invention.description }}</td>
                    <td>{{ invention.domain.name }}</td>
                    <td>{{ invention.created_at }}</td>
                    <td>{{ invention.updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    components: {
    },
    name: "InventionsList",
    data() {
        return {

        }
    },
    props: {
        inventions: Array
    }
}
</script>

<style scoped>

</style>
