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
          <div class="select" :class="loading ? 'is-loading' : ''">
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

          window.location.href = this.url;
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
.label.label{
    font-size:25px;
}

body {
    margin: 0;
    padding: 0;
    background-color: #004882;
}

.select {
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.select select {
    background-color: dodgerblue;
    color: white;
    padding: 12px;
    width: 250px;
    border: none;
    font-size: 20px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
    -webkit-appearance: button;
    outline: none;
}

.select::before {
    content: "\f13a";
    font-family: FontAwesome;
    position: absolute;
    top: 0;
    right: 0;
    width: 20%;
    height: 100%;
    text-align: center;
    font-size: 28px;
    line-height: 45px;
    color: rgba(255, 255, 255, 0.5);
    background-color: rgba(255, 255, 255, 0.1);
    pointer-events: none;
}

.select:hover::before {
    color: rgba(255, 255, 255, 0.6);
    background-color: rgba(255, 255, 255, 0.2);
}

.select select option {
    padding: 30px;
}
.input{
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.textarea{
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
input[type=text] {
    border: 2px solid deepskyblue;
    border-radius: 4px;
}
textarea[type=text]{
    border: 2px solid deepskyblue;
    border-radius: 4px;
}
</style>
