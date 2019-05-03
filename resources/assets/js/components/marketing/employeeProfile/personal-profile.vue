<template>

  <div>
    <div class="col-xs-12 col-sm-8">
      <h2>{{ user.firstname }} &emsp; {{ user.lastname }}</h2>
      <h5><strong>เบอร์โทร: </strong> {{ user.phone_number }} </h5>
      <h5><strong>อีเมล์: </strong> {{ user.email }} </h5>
      <h5><strong>ที่อยู่: </strong> {{ user.address }} </h5>
      <h5><strong>ตำแหน่ง: </strong>
        <span class="tags">{{ position[user.role] }}</span>
      </h5>
    </div>
    <div class="col-xs-12 col-sm-4 text-center">
      <figure>
        <img
          :src="'/images/userImg/'+user.img"
          class="img-circle img-responsive"
        >
      </figure>
    </div>
  </div>

</template>

<script>
export default {
  props: ["id"],

  mounted() {
    this.getUserData();
  },

  data() {
    return {
      user: [],
      position: ["", "แอดมิน", "หัวหน้าฝ่ายการตลาด", "พนักงานฝ่ายการตลาด"]
    };
  },

  methods: {
    getUserData() {
      axios.get("/api/userProfile/" + this.id).then(res => {
        this.user = res.data.user;
      });
    }
  }
};
</script>

