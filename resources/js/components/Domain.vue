<template>
  <div class="container">
    <div class="card">
      <div class="card-content">
        <div class="media">
          <div class="media-content">
            <p class="title is-4">{{ domain.name }}</p>
            <p class="subtitle is-6">{{ domain.slug }}</p>
          </div>
        </div>

        <div class="content">
          {{ domain.description }}
          <p class="timestamps">
            <i class="fas fa-plus"></i> {{ dateFormat(domain.created_at) }}
          </p>
        </div>
      </div>

      <footer class="card-footer">
        <a :href="domain.slug + '/edit'" class="button is-link">Edit</a>
        <!-- <a :href="#" class="card-footer-item">Delete</a> -->
      </footer>
    </div>

    <InventionsList class="inventionslist" :inventions="inventions"></InventionsList>
  </div>
</template>

<script>
import InventionsList from './InventionsList'

export default {
  components: {
    InventionsList
  },
  name: "Domain",
  data() {
    return {
      domainName: "",
      inventions: []
    };
  },
  methods: {
    dateFormat(timestamp) {
      const date = new Date(timestamp);
      return date.toLocaleString("de-AT");
    },
  },
  created() {
    // Fetch all inventions and keep the ones belonging to current domain
    // for display
    axios.get("/list/invention").then((res) => {
      res.data.forEach((inv) => {
        if (inv.domain_id == this.domain.id) {
          this.inventions.push(inv);
        }
      });
    });
  },
  props: {
    domain: Object,
  },
};
</script>

<style scoped>
.timestamps {
  font-size: 85%;
  color: rgb(156, 156, 156);
  margin-top: 1em;
}

.inventionslist {
    margin-top: 2em;
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
a.button{
    font-size:16px;
    display: block;
    width: 113px;
    margin: auto;
}
</style>
