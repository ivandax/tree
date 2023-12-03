<template>
  <div class="user-info">
    <div class="details">
      <div class="user-name-and-avatar">
        <p><strong>Last registered user:</strong> {{ userData.name }}</p>
        <img :src="userData.profile_picture" alt="Profile Picture" />
      </div>

      <p><strong>Registered At:</strong> {{ userData.registered_at }}</p>
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

    const fetchData = () => {
      import("@/data/data.json")
        .then((data) => {
          userData.value = data.default.lastRegisteredUser;
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
    };
  },
};
</script>

<style  lang="scss">
.user-info {
  display: flex;

  .details {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 20px;
    border-radius: 8px;
    border: 2px solid black;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    background-color: white;
    margin: 12px;

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
