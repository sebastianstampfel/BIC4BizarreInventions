<template>
  <div class="container">
    <div class="container button-bar">
      <a href="/domain/create" class="button is-primary"
        ><i class="fas fa-plus"></i>Add new domain</a
      >
    </div>
    <table class="table">
      <thead>
        <tr>
          <th class="table-head">ID</th>
          <th class="table-head">Name</th>
          <th class="table-head">Description</th>
          <th class="table-head">Created</th>
          <th class="table-head">Updated</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="domain in domains"
          :key="domain.id"
          class="list-table-entry"
          @click="domainClickHandler(domain.slug)"
        >
          <td>{{ domain.id }}</td>
          <td>
            <a :href="'domain/' + domain.slug">{{ domain.name }}</a>
          </td>
          <td>{{ domain.description }}</td>
          <td>{{ formatDate(domain.created_at) }}</td>
          <td>{{ formatDate(domain.updated_at) }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  components: {},
  name: "DomainsList",
  data() {
    const months = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];
    const days = [
      "Sunday",
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
    ];
    return {
      months,
      days,
    };
  },
  props: {
    domains: Array,
  },
  methods: {
    formatDate(dateStr) {
      const timestamp = Date.parse(dateStr);
      if (isNaN(timestamp) == false) {
        const date = new Date(timestamp);
        return (
          this.days[date.getDay()] +
          ", " +
          date.getDate() +
          ". " +
          this.months[date.getMonth()] +
          " " +
          date.getFullYear()
        );
      }
      return dateStr;
    },
    domainClickHandler(slug) {
      window.location.href = `/domain/${slug}`;
    },
  },
};
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
.container {
  font-family: Calibri;
}
.table-head {
  background-color: #213d3d;
  color: white;
}
</style>
