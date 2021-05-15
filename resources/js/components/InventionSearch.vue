<template>
  <div class="container">
    <!-- <table class="table" v-if="inventions.length != 0">
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
          <td>
            <a :href="'/invention/' + invention.slug">{{ invention.name }}</a>
          </td>
          <td>{{ invention.description }}</td>
          <td>{{ invention.domain.name }}</td>
          <td>{{ invention.created_at }}</td>
          <td>{{ invention.updated_at }}</td>
        </tr>
      </tbody>
    </table>
    <h3 v-else>No inventions found. Add some!</h3> -->

    <form @submit.prevent="submit">
      <div class="field">
        <label class="label" for="q">Searchterm</label>
        <div class="control">
          <input
            id="q"
            v-model="form.q"
            class="input"
            v-bind:class="{ 'is-danger': form.errors.has('title') }"
            type="text"
            autofocus
          />
        </div>
        <p
          class="help is-danger"
          v-if="form.errors.has('title')"
          v-text="form.errors.get('title')"
        />
      </div>

      <button
        type="submit"
        class="button is-primary is-outlined is-fullwidth"
        v-text="edit ? 'Save' : 'Search'"
        :disabled="loading"
      />
    </form>

    <InventionsList :inventions="inventions" />
  </div>
</template>

<script>
import InventionsList from "./InventionsList";
let form = new Form({
  q: "",
});

export default {
  components: {
    InventionsList,
  },
  name: "InventionSearch",
  data() {
    return {
      form: form,
      url: "/search/invention",
      inventions: [],
    };
  },
  created() {},
  methods: {
    submit() {
      this.form.post(this.url).then((response) => {
        console.log(response);
        this.inventions = response;
      });
    },
  },
  props: {
    //inventions: Array,
  },
};
</script>

<style scoped>
</style>
