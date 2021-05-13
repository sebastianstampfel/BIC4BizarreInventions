<template>
  <div class="container">
    <h1>Cool invention</h1>
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
        <tr>
          <td>{{ invention.id }}</td>
          <td>
            <a :href="'invention/' + invention.slug">{{ invention.name }}</a>
          </td>
          <td>{{ invention.description }}</td>
          <td>{{ domainName }}</td>
          <td>{{ invention.created_at }}</td>
          <td>{{ invention.updated_at }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  components: {},
  name: "Invention",
  data() {
    return {
      domainName: ""
    };
  },
  methods: {
    domainLookupById(domain) {
      axios.get('/list/domain').then(function (response) {
        console.log(response);
        response.data.forEach(d => {
          if (d.id == domain) {
            domainName = d.name
          }
        })
        console.log(domainName)
        return domainName
      })
    },
  },
  created() {
    axios.get('/list/domain').then(res => {
      res.data.forEach(d => {
        if (d.id == this.invention.domain_id) {
          this.domainName = d.name
        }
      })
    })
  },
  props: {
    invention: Object,
  },
};
</script>

<style scoped>
</style>
