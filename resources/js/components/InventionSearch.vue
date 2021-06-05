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
input[type=text] {
    width: 130px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-position: 10px 10px;
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    transition: width 0.4s ease-in-out;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
input[type=text]:focus {
    width: 100%;
}
.label.label{
    font-size:25px;
    border: 2px solid powderblue;
    padding: 30px;
    font-family: "Arial Black", sans-serif;
    width: 225px;
}
</style>
