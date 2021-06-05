<template>
    <div class="container">
        <div class="container button-bar">
            <a href="/search/inventions" class="button is-info"><i class="fas fa-search"></i>Search</a>
            <a href="/invention/create" class="button is-success"><i class="fas fa-plus"></i>Add new invention</a>
        </div>

        <table class="table" v-if="inventions.length != 0">
            <thead>
                <tr class="table-head">
                    <th class="table-head">ID</th>
                    <th class="table-head">Name</th>
                    <th class="table-head">Description</th>
                    <th class="table-head">Domain</th>
                    <th class="table-head">Created</th>
                    <th class="table-head">Updated</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="invention in inventions" :key="invention.id" @click="inventionClickHandler(invention.slug)" class="list-table-entry">
                    <td>{{ invention.id }}</td>
                    <td><a :href="'/invention/' + invention.slug">{{ invention.name }}</a></td>
                    <td>{{ invention.description }}</td>
                    <td>{{ invention.domain.name }}</td>
                    <td>{{ formatDate(invention.created_at) }}</td>
                    <td>{{ formatDate(invention.updated_at) }}</td>
                </tr>
            </tbody>
        </table>
        <h3 v-else>No inventions found. Add some!</h3>
    </div>
</template>

<script>
export default {
    components: {
    },
    name: "InventionsList",
    data() {
        const months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];
        const days = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        ]
        return {
            months,
            days
        }
    },
    props: {
        inventions: Array
    },
    methods:{
        formatDate(dateStr){
            const timestamp = Date.parse(dateStr);
            if (isNaN(timestamp) == false) {
                const date = new Date(timestamp);
                return this.days[date.getDay()] + ", " + date.getDate() + ". " + this.months[date.getMonth()] + " " + date.getFullYear();
            }
            return dateStr;
        },
        inventionClickHandler(slug){
            window.location.href = `/invention/${slug}`;
            console.log(slug);
        }
    }
}
</script>

<style lang="scss" scoped>

a:link {
    color: darkblue;
}

a:visited {
    color: #2463fc;
}

a:hover {
    color: darkred;
}
.container{
    font-family: Calibri;
}

.table-head{
    background-color: #213d3d;
    color: white;
}
</style>

<style lang="scss">

.list-table-entry{
    border-right: 5px solid transparent;
    border-left: 5px solid transparent;
}
.list-table-entry:nth-child(even){
    background-color: #C3FCE693;
}

.list-table-entry:nth-child(odd){
    background-color: #6F9786D0;
}

.list-table-entry:hover{
    background-color: #4e8d8d;
    cursor: pointer;
    border-color: #213d3d;
    //border-right: 5px solid #213d3d;
}

.button-bar {
    a {
        color: white !important;
        i {
            margin-right: .25em;
        }
    }

    margin-bottom: 1em;
}
</style>
