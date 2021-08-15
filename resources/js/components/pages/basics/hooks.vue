<template>
    <div class="container">
        <h1 ref="myref">hook tutuorila</h1>
<h1>my name is: {{name}}</h1>
    </div>
</template>
<script>
export default {
    data(){
        return{
name:'saava'
        }
    },

    beforeCreate() {
        console.log(this.name)
    },

    created() {
        console.log('data ', this.name)
    },

    mounted() {
        console.log(this.$refs.myref)
    },
}
</script>
