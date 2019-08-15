<template>
  <div class="pull-left image">
    <img
      :src="'/images/userImg/'+data.img"
      class="img-circle"
    >
  </div>
</template>

<script>
export default {
  mounted() {
    this.getUserData();
  },
  props: ["id"],

  data() {
    return { data: [] };
  },

  methods: {
    getUserData() {
      axios.get("/api/userProfile/" + this.id).then(res => {
        this.data = res.data.user;
      });
    }
  }
};
</script>
