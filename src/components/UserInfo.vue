<template>
  <div class="user-info">
    <div class="graph-details">
      <div>Registrations per Hour</div>
      <div class="bar-chart">
        <BarChart :chartData="chartData" :chartOptions="chartOptions" />
      </div>
    </div>

    <div class="last-user-details">
      <div class="user-name-and-avatar">
        <div><strong>Last registered user:</strong> {{ userData.name }}</div>
        <img :src="userData.profile_picture" alt="Profile Picture" />
      </div>

      <div><strong>Registered At:</strong> {{ userData.registered_at }}</div>
    </div>

    <div>
      <div>{{ counter }}</div>
      <button @click="incrementCounter">Increment</button>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, watch } from "vue";
import BarChart from "@/components/BarChart.vue";

export default {
  name: "UserInfo",
  components: {
    BarChart,
  },
  props: {},
  setup() {
    const userData = ref({
      name: "",
      profile_picture: "",
      registered_at: "",
    });

    const counter = ref(0);

    const incrementCounter = () => {
      counter.value++;
    };

    const registrationsPerHour = ref([]);

    const chartData = ref({
      labels: [],
      datasets: [
        {
          label: "Registrations per Hour",
          backgroundColor: "blue",
          data: [],
        },
      ],
    });

    const fetchData = () => {
      import("@/data/data.json")
        .then((data) => {
          userData.value = data.default.lastRegisteredUser;
          registrationsPerHour.value = data.default.registrations_per_hour;
        })
        .catch((error) => {
          console.error("Error fetching data:", error);
        });
    };

    onMounted(() => {
      fetchData();
    });

    watch(
      registrationsPerHour,
      () => {
        chartData.value = {
          labels: registrationsPerHour.value.map(
            (entry) => Object.keys(entry)[0]
          ),
          datasets: [
            {
              label: "Registrations",
              data: registrationsPerHour.value.map((entry) =>
                parseInt(Object.values(entry)[0])
              ),
              backgroundColor: "blue",
            },
          ],
        };
      },
      { immediate: true }
    );

    return {
      userData,
      registrationsPerHour,
      chartData,
      counter,
      incrementCounter,
    };
  },
};
</script>

<style  lang="scss">
@mixin box-mixin {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  padding: 20px;
  border-radius: 8px;
  border: 2px solid black;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
  background-color: white;
  margin: 12px;
}

.user-info {
  display: flex;
  flex-direction: column;

  .graph-details {
    @include box-mixin;
  }

  .last-user-details {
    @include box-mixin;
    width: 50%;

    .user-name-and-avatar {
      display: flex;
      align-items: center;

      img {
        margin-left: 12px;
        width: 20px;
        height: 20px;
        border-radius: 100%;
        margin-right: 20px;
        border: 1px solid black;
      }
    }
  }
}
</style>
