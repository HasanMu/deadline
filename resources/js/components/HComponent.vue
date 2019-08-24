<template>
    <div class="container">
        <div>Props : {{ stats }}</div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted');
        },
        props: ['stats']
     }
</script>
