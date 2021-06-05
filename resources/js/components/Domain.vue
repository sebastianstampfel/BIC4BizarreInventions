<template>
  <div class="container">
    <div class="card">
      <div class="card-content">
        <div class="media">
          <div class="media-content">
            <h3 id="domain-name">{{ domain.name }}</h3>
            <h4 id="domain-slug">{{ domain.slug }}</h4>
          </div>
        </div>

        <div class="content">
            <p id="domain-description">{{ domain.description }}</p>
          <p class="timestamps">
            <i class="fas fa-plus"></i> {{ formatDate(domain.created_at) }}
          </p>
        </div>
      </div>

      <footer class="card-footer">
        <a :href="domain.slug + '/edit'" class="card-footer-item">Edit</a>
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
      inventions: [],
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
    }
    .container{
        font-family: Calibri;
    }

    #domain-name{
        font-size: x-large;
        font-weight: bolder;
        padding-left: .2em;
        background-color: #213d3d;
        color: white;
    }

    #domain-slug{
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
        background-color: dimgray;
    }

    a:link {
        color:white;
    }
    a:hover {
        color: darkred;
    }
    #domain-description{
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
