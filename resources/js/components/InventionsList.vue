<template>
    <div class="container">
        <div class="container button-bar">
            <a href="/search/inventions" class="button is-info"><i class="fas fa-search"></i>Search</a>
            <a href="/invention/create" class="button is-success"><i class="fas fa-plus"></i>Add new invention</a>
        </div>

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
                <tr v-for="invention in inventions" :key="invention.id" @click="inventionClickHandler(invention.slug)">
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

tr:nth-child(even){
    background-color: #C3FCE693;
}

tr:nth-child(even):hover{
    background-color: rgb(184, 201, 194);
    cursor: pointer;
}

tr:nth-child(odd){
    background-color: #6F9786D0;
}

tr:nth-child(odd):hover{
    background-color: #a3b9b0fb;
    cursor: pointer;
}


.button-bar {
    a {
        color: white;
        i {
            margin-right: .25em;
        }
    }

    margin-bottom: 1em;
}
</style>
