<template>
  <div class="user-info">
    <div class="graph-details">
      <div>Registrations per Hour</div>
      <ul>
        <li v-for="(registration, index) in registrationsPerHour" :key="index">
          {{ Object.keys(registration)[0] }}:
          {{ Object.values(registration)[0] }}
        </li>
      </ul>
    </div>

    <div class="last-user-details">
      <div class="user-name-and-avatar">
        <div><strong>Last registered user:</strong> {{ userData.name }}</div>
        <img :src="userData.profile_picture" alt="Profile Picture" />
      </div>

      <div><strong>Registered At:</strong> {{ userData.registered_at }}</div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";

export default {
  name: "UserInfo",
  props: {},
  setup() {
    const userData = ref({
      name: "",
      profile_picture: "",
      registered_at: "",
    });

    const registrationsPerHour = ref([]);

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

    return {
      userData,
      registrationsPerHour,
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
    @include box-mixin; // Include the mixin here
  }

  .last-user-details {
    @include box-mixin; // Include the mixin here
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
