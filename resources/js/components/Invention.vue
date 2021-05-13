<template>
  <div class="container">
    <div class="card">
      <div class="card-content">
        <div class="media">
          <div class="media-content">
            <p class="title is-4">{{ invention.name }}</p>
            <p class="subtitle is-6">{{ domainName }}</p>
          </div>
        </div>

        <div class="content">
          {{ invention.description }}
          <p class="timestamps">
            <i class="fas fa-plus"></i> {{ dateFormat(invention.created_at) }}
          </p>
        </div>
      </div>

      <footer class="card-footer">
        <a :href="invention.slug + '/edit'" class="card-footer-item">Edit</a>
        <!-- <a :href="#" class="card-footer-item">Delete</a> -->
      </footer>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  name: "Invention",
  data() {
    return {
      domainName: "",
    };
  },
  methods: {
    dateFormat(timestamp) {
      const date = new Date(timestamp);
      return date.toLocaleString("de-AT");
    },
  },
  created() {
    // Backend provides no way to lookup a domain by id,
    // so here we are with this "hacky" approach
    axios.get("/list/domain").then((res) => {
      res.data.forEach((d) => {
        if (d.id == this.invention.domain_id) {
          this.domainName = d.name;
        }
      });
    });
  },
  props: {
    invention: Object,
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
