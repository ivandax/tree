<template>
  <div class="user-info">
    <h2>Last Registered User</h2>
    <div class="user-details">
      <img :src="userData.profile_picture" alt="Profile Picture" />
      <div class="details">
        <p><strong>Name:</strong> {{ userData.name }}</p>
        <p><strong>Registered At:</strong> {{ userData.registered_at }}</p>
      </div>
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
  width: 100%;
}

.user-details {
  display: flex;
  align-items: center;

  img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
  }

  .details {
    width: 100%;
  }
}
</style>
