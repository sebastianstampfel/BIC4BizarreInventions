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
        <a :href="domain.slug + '/edit'" class="card-footer-item">Edit</a>
        <!-- <a :href="#" class="card-footer-item">Delete</a> -->
      </footer>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  name: "DomainInventions",
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
</style>
