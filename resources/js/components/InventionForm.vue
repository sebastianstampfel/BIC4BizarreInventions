<template>
  <div class="container">
    <query-message :success="form.isSuccess()" :fail="form.isFail()"
                                       :message="form.failMessage || form.successMessage"></query-message>
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

      <div class="field">
        <label class="label" for="domain">Domain</label>
        <div class="control">
          <div class="select is-fullwidth" :class="loading ? 'is-loading' : ''">
            <select id="domain" :disabled="loading" v-model="form.domain_id">
              <option v-if="loading" :value="this.form.domain_id">
                Loading...
              </option>
              <option
                v-for="domain in domains"
                v-else
                v-text="domain.name"
                :value="domain.id"
                :key="domain.id"
              />
            </select>
          </div>
        </div>
        <p
          class="help is-danger"
          v-if="form.errors.has('domain_id')"
          v-text="form.errors.get('domain_id')"
        />
        <p v-if="noDomains" class="help is-warning">
          Add some domains to create inventions!
        </p>
      </div>

      <!-- <div class="field">
                                <label class="label" for="body">Body</label>
                                <div class="control">
                                    <textarea id="body" v-model="form.body" class="textarea"></textarea>
                                </div>
                                <p class="help is-danger" v-if="form.errors.has('body')"
                                   v-text="form.errors.get('body')"/>
                                <p class="help">
                                    You can use <a target="_blank"
                                                   href="https://daringfireball.net/projects/markdown/syntax">
                                    Markdown</a> syntax here.
                                </p>
                            </div> -->

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
  invention_id: "",
  name: "",
  description: "",
  domain_id: "1",
  noReset: ["domain_id"],
});

export default {
  components: {},
  name: "InventionForm",
  data() {
    return {
      edit: undefined,
      form: form,
      url: "",
      domains: [],
      noDomains: false,
    };
  },
  props: {
    isEditable: {
      required: false,
      type: Boolean,
      default: false,
    },
    currentInvention: {
      required: false,
      type: Object,
    },
  },
  computed: {
    loading() {
      return !this.domains.length;
    },
  },
  watch: {
    domains() {
      if (!this.loading && this.form.domain_id === "") {
        this.form.domain_id = _.first(this.domains).id;
      }
    },
  },
  methods: {
    submit() {
      if (this.edit) this.form.put(this.url);
      else
        this.form.post(this.url).then((response) => {
          this.url = "/invention/" + response.slug;

          this.form.invention_id = response.invention_id;
          this.form.name = response.name;
          this.form.domain_id = response.domain_id;

          this.form.noReset = ["invention_id", "name", "domain_id"];

          this.edit = true;

          window.history.pushState("", "", this.url);
        });
    },
  },
  created() {
    axios.get("/list/domain").then((response) => {
      this.domains = response.data;

      if (this.loading) this.noDomains = true;
    });

    this.edit = this.isEditable;

    if (this.edit) {
      this.url = "/invention/" + this.currentInvention.slug;
      this.form.invention_id = this.currentInvention.id;
      this.form.name = this.currentInvention.name;
      this.form.description = this.currentInvention.description;
      this.form.domain_id = this.currentInvention.domain_id;

      this.form.noReset = ["invention_id", "name", "description", "domain_id"];
    } else {
      this.url = "/invention";
    }
  },
};
</script>

<style scoped>
</style>
