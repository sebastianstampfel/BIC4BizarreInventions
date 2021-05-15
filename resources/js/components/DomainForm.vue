<template>
  <div class="container">
    <query-message
      :success="form.isSuccess()"
      :fail="form.isFail()"
      :message="form.failMessage || form.successMessage"
    ></query-message>
    <form @submit.prevent="submit">
      <div class="field">
        <label class="label" for="name">Name</label>
        <div class="control">
          <input
            id="name"
            v-model="form.name"
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

      <div class="field">
        <label class="label" for="description">Description</label>
        <div class="control">
          <textarea
            id="description"
            v-model="form.description"
            class="textarea"
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
        class="button is-large is-primary is-outlined is-fullwidth"
        v-text="edit ? 'Save' : 'Post'"
        :disabled="loading"
      />
    </form>
  </div>
</template>

<script>
let form = new Form({
  domain_id: "",
  name: "",
  description: "",
});

export default {
  components: {},
  name: "DomainForm",
  data() {
    return {
      edit: undefined,
      form: form,
      url: "",
    };
  },
  props: {
    isEditable: {
      required: false,
      type: Boolean,
      default: false,
    },
    currentDomain: {
      required: false,
      type: Object,
    },
  },
  methods: {
    submit() {
      if (this.edit) {
        // Cannot redirect to show domain because of new slug
        // TODO: find fix
        this.form.put(this.url);
      } else {
        this.form.post(this.url).then((response) => {
          this.url = "/domain/" + response.slug;

          this.form.domain_id = response.id;
          this.form.name = response.name;
          this.form.description = response.description;

          this.form.noReset = ["domain_id", "name"];

          this.edit = true;

          window.location.href = this.url;
        });
      }
    },
  },
  created() {
    this.edit = this.isEditable;

    if (this.edit) {
      this.url = "/domain/" + this.currentDomain.slug;
      this.form.domain_id = this.currentDomain.id;
      this.form.name = this.currentDomain.name;
      this.form.description = this.currentDomain.description;

      this.form.noReset = ["domain_id", "name", "description"];
    } else {
      this.url = "/domain";
    }
  },
};
</script>

<style scoped>
</style>
