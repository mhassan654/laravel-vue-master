<template>
    <div class="">
        <h1>the number is : {{views}}</h1>
        <button @click="updateCounter(1)">Increase</button>
        <button @click="updateCounter(-1)">Decrease</button>
<br>
<br><br>


<div v-for="(blog, i) in blogs" :key="i">
<h1>{{blog.title}}</h1>
    <p>{{blog.post}}</p>
</div>
    </div>
</template>
<script>
export default {
  data() {
    return {
      views: 0,
      blogs: [],
    };
  },
  methods: {
    updateCounter(number) {
      this.views += number;
    },
  },

  created() {
    this.views = 100;
    let posts = [
      { title: "this is blog post one", post: "this is  post one", id: 1 },
      { title: "this is blog post two", post: "this is  post two", id: 2 },
      { title: "this is blog post three", post: "this is  post three", id: 3 },
      { title: "this is blog post four", post: "this is  post four", id: 4 },
      { title: "this is blog post five", post: "this is  post five", id: 5 },
    ];

    this.blogs = posts;
  },
};
</script>
