<template>
    <div class="container">
        <table class="table" v-if="inventions.length != 0">
            <thead>
                <tr>
                    <th class="table-head">ID</th>
                    <th class="table-head">Name</th>
                    <th class="table-head">Description</th>
                    <th class="table-head">Domain</th>
                    <th class="table-head">Created</th>
                    <th class="table-head">Updated</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="invention in inventions" :key="invention.id">
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
        }
    }
}
</script>

<style scoped>
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
    tr:nth-child(even){
        background-color: #C3FCE693;
    }
    tr:nth-child(odd){
        background-color: #6F9786D0;
    }


</style>
