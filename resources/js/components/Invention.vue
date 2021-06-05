<template>
  <div class="container">
    <div class="card">
      <div class="card-content">
        <div class="media">
          <div class="media-content">
            <p id="invention-name">{{ invention.name }}</p>
            <p id="domain-name">{{ domainName }}</p>
          </div>
        </div>

        <div class="content">
          <p id="invention-description">{{ invention.description }}</p>
          <p class="timestamps">
            <i class="fas fa-plus"></i> {{ formatDate(invention.created_at) }}
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
      const months = [
          'January',
          'February',
          'March',
          'April',
          'May',
          'June',
          'July',
          'August',
          'September',
          'October',
          'November',
          'December'
      ];
      const days = [
          'Sunday',
          'Monday',
          'Tuesday',
          'Wednesday',
          'Thursday',
          'Friday',
          'Saturday'
      ]
    return {
      domainName: "",
        months,
        days
    };
  },
  methods: {
    dateFormat(timestamp) {
      const date = new Date(timestamp);
      return date.toLocaleString("de-AT");
    },
      formatDate(dateStr){
          const timestamp = Date.parse(dateStr);
          if (isNaN(timestamp) == false) {
              const date = new Date(timestamp);
              return this.days[date.getDay()] + ", " + date.getDate() + ". " + this.months[date.getMonth()] + " " + date.getFullYear();
          }
          return dateStr;
      }
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

.container{
    font-family: Calibri;
}

#invention-name{
    font-size: x-large;
    font-weight: bolder;
    padding-left: .2em;
    background-color: #213d3d;
    color: white;
}

#domain-name{
    color: #213d3d;
    font-size: large;
    text-decoration-color: #213d3d;
    text-decoration: underline;
    animation: blink-animation 1s steps(5, start) infinite;
    -webkit-animation: blink-animation 1s steps(5, start) infinite;
}

.card-footer{
    width: 10%;
    background-color: #213d3d;
    margin: auto;
}
.card-footer:hover{
    background-color: #386565;
}

a:link {
    color:white;
}
#invention-description{
    font-family: "Comic Sans MS";
}
@keyframes blink-animation {
    to {
        visibility: hidden;
    }
}
@-webkit-keyframes blink-animation {
    to {
        visibility: hidden;
    }
}
</style>
